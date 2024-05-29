<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Productmodel;
use Illuminate\Support\Facades\Http;
use App\Models\ProductDiscountHistory;

class ProductDiscountApi extends Command
{
    protected $signature = 'productdiscount:api';
    protected $description = 'Update the latest product discount from API';

    public function handle()
    {
        try {
            $this->getDataFromAPI();
        } catch (\Exception $e) {
            $this->logCronJob('An error occurred "productdiscount:api" : ' . $e->getMessage());
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
                $this->logCronJob('"productdiscount:api" token fail :' . $result['Message']);
            }
        } catch (\Exception $e) {
            // Log the error or handle it as needed
            $this->logCronJob('Error in "productdiscount:api" token - '.$e);
        }
    }

    function getDataFromAPI()
    {
        try {
            $this->logCronJob('Cron job "productdiscount:api" ran successfully.');

            $token = $this->generatedToken(); // generate the access token
            if ($token) {
                $apidata = Http::withHeaders([
                    'Authorization' => $token,
                ])->post('http://203.94.70.165:29099/WebAPI_DSIT/api/WEBAPI01/Discount');

                $resultdata = $apidata->json();

                Productmodel::query()->update(['discount' => null]);
                
                // Loop through each record in the API response
                foreach ($resultdata as $record) {
                    // Extract relevant data from the API response for each record
                    $group = $record['ProductCriteriaLevel'];
                    $group_val = $record['ProductCriteria'];
                    $discount = $record['TradeScheme'];

                    Productmodel::where('product_group', $group)->where('product_group_val', $group_val)->update(['discount' => $discount]);

                    ProductDiscountHistory::create([
                        'product_group' => $group,
                        'product_group_val' => $group_val,
                        'discount' => $discount,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                    $this->logCronJob("'productdiscount:api' updated for product group - $group and group_val - $group_val with value - $discount.");
                }
            } else {
                $this->logCronJob('"productdiscount:api" failed, no token return');
            }
        } catch (\Exception $e) {
            // Log the error or handle it as needed
            $this->logCronJob('Error in "productdiscount:api" - '.$e);
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
