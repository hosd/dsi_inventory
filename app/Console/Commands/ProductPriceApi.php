<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Productmodel;
use Illuminate\Support\Facades\Http;

class ProductPriceApi extends Command
{
    protected $signature = 'productprice:api';
    protected $description = 'Update the latest product price from API';

    public function handle()
    {
        try {
            $this->getDataFromAPI();
        } catch (\Exception $e) {
            $this->logCronJob('An error occurred "productprice:api" : ' . $e->getMessage());
            // Log the error or handle it as needed
        }
    }

    function generatedToken()
    {
        try {
            $username = "DSITUser";
            $password = "123456%23"; 
        
            $response = Http::post('http://203.94.70.165:29099/WebAPI_DSIT/api/WEBAPI01/Authentication?username='.$username.'&password='.$password);
            $result = $response->json();

            if ($response->successful()) {
                $token = $result['Token'];    
                return $token;
            } else {
                $error = $response->json();
                $this->logCronJob('"productprice:api" token fail :' . $result['Message']);
            }
        } catch (\Exception $e) {
            // Log the error or handle it as needed
            $this->logCronJob('Error in "productprice:api" token - '.$e);
        }
    }

    function getDataFromAPI()
    {
        try {
            $this->logCronJob('Cron job "productprice:api" ran successfully.');

            $token = $this->generatedToken(); // generate the access token
            if ($token) {
                $apidata = Http::withHeaders([
                    'Authorization' => $token,
                ])->post('http://203.94.70.165:29099/WebAPI_DSIT/api/WEBAPI01/Price');

                $resultdata = $apidata->json();
                // Group the response data by 'ProductCode'
                $groupedData = collect($resultdata)->groupBy('ProductCode');
                
                // Iterate through each group (each product code)
                $groupedData->each(function ($productRecords, $productCode) 
                {
                    // Find the latest record based on 'UpdateOn'
                    $latestRecord = $productRecords->sortByDesc('DateFrom')->first();

                    // Update the corresponding record in your Productmodel
                    $product = Productmodel::where('productcode', $productCode)->first();

                    if ($product && $latestRecord) {
                        // Update the 'unitprice' field with the latest price from the response
                        $product->update(['unitprice' => $latestRecord['Price']]);
                        $this->logCronJob('"productprice:api" updated :'.$productCode . '/'.$latestRecord['Price']);
                    }
                    
                });
            } else {
                $this->logCronJob('"productprice:api" failed, no token return');
            }
        } catch (\Exception $e) {
            // Log the error or handle it as needed
            $this->logCronJob('Error in "productprice:api" - '.$e);
        }
    }

    function logCronJob($message)
    {
        $data = [
            'message' => $message,
            'created_at' => Carbon::now(),
        ];

        DB::table('cronjob_logs')->insertGetId($data);
    }
}
