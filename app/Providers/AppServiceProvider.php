<?php

namespace App\Providers;

use App\Models\DynamicMenu;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        if(config('app.env') === 'production') {
            \URL::forceScheme('https');
            \Illuminate\Support\Facades\Response::macro('hsts', function ($value = 'max-age=31536000; includeSubDomains') {
                return \Illuminate\Support\Facades\Response::make('', 200)->header('Strict-Transport-Security', $value);
            });
        }
        View::composer('*', function ($view) {
            if (Auth::check()) {
                // $menuItems = DynamicMenu::join('privilage','privilage.iFormID','=','dynamic_menu.id')->where('privilage.iUserTypeID',1)->where('dynamic_menu.show_menu',1)->where('dynamic_menu.parent_id','0')->get();
                $menuItems = DynamicMenu::where('dynamic_menu.show_menu', 1)->where('dynamic_menu.parent_id', '0')->orderBy('parent_order', 'ASC')->get();
                view()->share('menuItems', $menuItems);

                // $subMenuItems = DynamicMenu::join('privilage','privilage.iFormID','=','dynamic_menu.id')->where('privilage.iUserTypeID',1)->where('dynamic_menu.show_menu',1)->where('dynamic_menu.parent_id','!=','0')->get();
                $subMenuItems = DynamicMenu::where('dynamic_menu.show_menu', 1)->where('dynamic_menu.parent_id', '!=', '0')->get();
                view()->share('subMenuItems', $subMenuItems);

                $userID = Auth::id();
                $user = User::find($userID);
              //  $roles = Role::pluck('name', 'name')->all();
              //  $userRole = $user->roles->pluck('id', 'id')->all();

                $roleID = $user->roles->first()->id;
                //var_dump($roleID); die();
               //
                
                $permissionHave =  DB::table('role_has_permissions')
                    ->select('permissions.dynamic_menu_id', 'dynamic_menu.parent_id')
                    ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
                    ->join('dynamic_menu', 'permissions.dynamic_menu_id', '=', 'dynamic_menu.id')
                    ->where('role_has_permissions.role_id', $roleID)
                    ->groupBy('permissions.dynamic_menu_id')
                    ->groupBy('dynamic_menu.parent_id')
                    //->orderBy('permissions.dynamic_menu_id','ASC')
                    ->get()->toArray();

                $arrPermission = array();
                $arrParentID = array();
                foreach ($permissionHave as $per) {
                    $arrPermission[] = $per->dynamic_menu_id;
                    $arrParentID[] = $per->parent_id;
                }
                view()->share('permissionHave', $arrPermission);
                view()->share('arrParentID', $arrParentID);
            }
        });
    }
}
