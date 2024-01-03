<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dealers;
use App\Models\District;
use App\Models\City;
use App\Models\Address;
use App\Models\Province;
use App\Models\Dealeruser;
use App\Models\Dealer_stock;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DealerapiController extends Controller {

    public function getSelectedDealers(Request $request) {
        
        $data = $request->json()->all(); // Assuming the JSON data is sent in the request
//        $data = [
//            "district" => 1,
//            "city" => 1,
//            "ProductList" => [
//                [
//                    "ProductCode" => "S101008012069011",
//                    "Quantity" => 10
//                ],
//                [
//                    "ProductCode" => "S109009012071011",
//                    "Quantity" => 10
//                ],
//                [
//                    "ProductCode" => "M110009017038251",
//                    "Quantity" => 1
//                ]
//            ]
//        ];
        //  Retrieve dealers matching district and city
        $selectedDealers = DB::table('dealers')
                ->join('address', 'dealers.addressID', '=', 'address.id')
                ->where('districtID', $data['district'])
                ->where('cityID', $data['city'])
                ->where('status', '1')
                ->get();

        //  Filter dealers based on dealer stock matching JSON data
        $filteredDealers = $selectedDealers->filter(function ($dealer) use ($data) {
            $productList = collect($data['ProductList']);
            $dealerID = $dealer->id;

            // Check if all products in the JSON list are available in the dealer's stock list
            $hasAllProducts = $productList->every(function ($product) use ($dealerID) {
                return DB::table('dealer_stock')
                        ->where('dealerID', $dealerID)
                        ->where('productcode', $product['ProductCode'])
                        ->where('quantity', '>=', $product['Quantity'])
                         ->where('status', '1')
                        ->exists();
            });

            //var_dump($hasAllProducts);  
            return $hasAllProducts;
        }); //die();
        // Create an array of selected dealers with their details
        $selectedDealersData = $filteredDealers->map(function ($dealer) {
            return [
        'Dealerid' => $dealer->id,
        'name' => $dealer->name,
        'email' => $dealer->email,
        'phone' => $dealer->phone,
        'dealercode' => $dealer->dealercode,        
        'address' => [
            'vNo' => $dealer->vNo,
            'vAddressline1' => $dealer->vAddressline1,
            'vAddressline2' => $dealer->vAddressline2,
            'districtID' => $dealer->districtID,
            'provinceID' => $dealer->provinceID,
            'cityID' => $dealer->cityID,
        ],
        'status' => $dealer->status,
        'Contact_person' => $dealer->Contact_person,
        'opening_hours' => $dealer->opening_hours,
        'vLatitude' => $dealer->vLatitude,
        'vLongitude' => $dealer->vLongitude,        
            ];
        });

        // Create the final JSON response
        $response = [
            'selected_dealers' => $selectedDealersData,
        ];

        return new JsonResponse($response);
    }
    
    public function update_dealerquantity(Request $request) {
        $data = $request->json()->all(); //  the JSON data is sent in the request
        $responses = [];
//        $data = [
//            "orderID" => 1,
//            "orderRef" => "ONL23111700014",
//            "dealerID" => 1,
//            "ProductList" => [
//                [
//                    "ProductCode" => "S101008012069011",
//                    "Quantity" => 1
//                ],
//                [
//                    "ProductCode" => "S109009012071011",
//                    "Quantity" => 1
//                ],
//                [
//                    "ProductCode" => "M110009017038251",
//                    "Quantity" => 1
//                ]
//            ]
//        ];

        // Step 1: Deduct stock
        foreach ($data['ProductList'] as $product) {
            $dealerID = $data['dealerID'];
            $productCode = $product['ProductCode'];
            $quantity = $product['Quantity'];

            // Update dealer stock
            $updatedRows = Dealer_stock::where('dealerID', $dealerID)
                    ->where('productcode', $productCode)
                    ->decrement('quantity', $quantity);
            

        // Check if the update was successful
        if ($updatedRows > 0) {
            $responses[] = [
                'ProductCode' => $productCode,
                'Status' => 'Success',
                'Message' => 'Stock updated successfully.',
            ];
             \LogActivity::addToAPILog('Dealer stock updated - ProductCode: ' . $productCode . ' Status: Success.'. ' dealerID : '.$dealerID);
        } else {
            $responses[] = [
                'ProductCode' => $productCode,
                'Status' => 'Error',
                'Message' => 'Insufficient stock or product not found.',
            ];
            \LogActivity::addToAPILog('Dealer stock update failed - ProductCode: ' . $productCode . ' Status: Error');
        }
        
        
         }

        // Step 3: Return JSON response
        $response = [
            
            'productStatus' => $responses,
        ];

        return response()->json($response);
    }

}
