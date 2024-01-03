<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;



class AccessTokenController 
{
//    public function issueToken(Request $request)
//    {
//        $request->request->add([
//            'grant_type' => 'password',
//            'client_id' => env('DSI_INVENTORY_CLIENT_ID'), // Your DSI_inventory client ID
//            'client_secret' => env('DSI_INVENTORY_CLIENT_SECRET'), // Your DSI_inventory client secret
//            'username' => $request->email, // Assuming the email is the username
//            'password' => $request->password,
//            'scope' => '*',
//        ]);
//
//        // Issue the access token
//        return parent::issueToken($request);
//    }
    
    public function getToken()
{
    $response = Http::post('http://localhost/dsi_invLive/oauth/token', [
        'grant_type' => 'password',
        'client_id' => '10',
        'client_secret' => 'stulNuQM7HldpOMFkZG3bGHjZhir3uOSSE0ddvo3',
        'username' => 'ayodhya@tekgeeks.net',
        'password' => '123456',
        'scope' => '',
    ]);

    // Handle the response as needed
    $token = $response->json();
    //echo( $token['access_token']); die();
    // You can then work with the OAuth token as necessary

    
}
}
