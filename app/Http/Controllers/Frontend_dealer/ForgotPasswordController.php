<?php

namespace App\Http\Controllers\Frontend_dealer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Validation\Rules\Password as PasswordRule;
use Illuminate\Validation\Rules;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('frontend_dealer.forgetpassword');
    }
   
    public function resetDealerPassword(Request $request)
    {
        return view('frontend_dealer.resetpassword', ['request' => $request]);
        //return view('auth.reset-password', ['request' => $request]);
    }
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $resetUrl = "#";
        $email = $request->email;
        $user = User::where('email', $email)->first();
        
        if (!$user) {
            return back()->withInput()->withErrors(['email' => 'We could not find a user with that email address.']);
        }

        $token = Str::random(60);
        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => now()
        ]);

        $response = Password::sendResetLink($request->only('email'));

    // if ($response === Password::RESET_LINK_SENT) {
    //     Mail::send('mail.dealer_password_reset_mail', [
    //         'resetLink' => $this->generatePasswordResetLink($request->email, $response),
    //     ], function ($message) use ($request) {
    //         $message->to($request->email)->subject('Your Password Reset Link');
    //     });
    //     return back()->with('status', __($response));
    // }

    //return back()->withErrors(['email' => __($response)]);
 
        Mail::send('mail.dealer_password_reset_mail', ['token' => $token, 'resetUrl' =>  $this->generatePasswordResetLink($request->email, $token) ], function($message) use ($email) {
            $message->to($email);
            $message->subject('Reset Password Notification');
        });

        return back()->with(['status' => 'We have emailed your password reset link!']);
    }
    private function generatePasswordResetLink(string $email, string $token): string
    {
        return \URL::temporarySignedRoute(
            'dealer-password-reset',
            now()->addMinutes(config('auth.passwords.'.config('auth.defaults.passwords').'.expire')),
            ['email' => $email, 'token' => $token]
        );
    }
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => [
                'required',
                'confirmed',
                PasswordRule::min(8)->letters()->mixedCase()->numbers()
            ],
        ]);
       
        // $status = Password::reset(
        //     $request->only('email', 'password', 'password_confirmation', 'token'),
        //     function ($user, $password) {
        //         $user->forceFill([
        //             'password' => bcrypt($password),
        //             'remember_token' => null,
        //         ])->save();
        //     }
        // );
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );
        dd(Password::PASSWORD_RESET);
        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')
                ->with('status', trans($status));
        }
       
        return back()->withErrors(['email' => trans($status)]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $status == Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);
    }
}

?>