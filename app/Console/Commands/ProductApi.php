<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Productmodel;
use App\Models\ProductCategory;
use App\Models\ProductSubcategory;
use Illuminate\Support\Facades\Http;

class ProductApi extends Command
{
    protected $signature = 'product:api';
    protected $description = 'Update the latest product from API';

    public function handle()
    {
        try {
            $this->getDataFromAPI();
        } catch (\Exception $e) {
            $this->logCronJob('An error occurred "product:api" : ' . $e->getMessage());
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
                $this->logCronJob('"product:api" token fail :' . $result['Message']);
            }
        } catch (\Exception $e) {
            // Log the error or handle it as needed
            $this->logCronJob('Error in "product:api" token - '.$e);
        }
    }

    function getDataFromAPI()
    {
        try {
            $this->logCronJob('Cron job "product:api" ran successfully.');

            $token = $this->generatedToken(); // generate the access token
            if ($token) {
                $apidata = Http::withHeaders([
                    'Authorization' => $token,
                ])->post('http://203.94.70.165:29099/WebAPI_DSIT/api/WEBAPI01/Product');
                $resultdata = $apidata->json();

                foreach ($resultdata as $record) {
                    $productCode = $record['ProductCode'];
                    $productName = $record['ProductName'];
                    $status = $record['Status'];
                    $tyreOrTube = substr($productCode, 1, 1);
                    $productModel = Productmodel::where('productcode', $productCode)->first();

                    $category = ProductCategory::where("code", $record["ProductDisplayValues"][0]["MasterGroup"])->first();
                    $subcategory = ProductSubcategory::where("code", $record["ProductDisplayValues"][0]["MasterGroupValue"])->first();

                    $group = $record["ProductClassificationValues"][1]["MasterGroup"];
                    $group_val = $record["ProductClassificationValues"][1]["MasterGroupValue"];

                    if(isset($record["ProductDisplayValues"][1]["MasterGroup"])){
                        $genx = $record["ProductDisplayValues"][1]["MasterGroup"];
                    } else {
                        $genx = null;
                    }

                    if ($productModel) {
                        // Update the existing record if found
                        $productModel->update([
                            'name' => $productName,
                            'status' => $status,
                            'isTyreorTube' => $tyreOrTube,
                            'product_category' => $category->id,
                            'product_subcategory' => $subcategory->id,
                            'product_group' => $group,
                            'product_group_val' => $group_val,
                            'master_group' => $genx
                        ]);
                        $this->logCronJob('"product:api" updated :'.$productCode);
                    } else {
                        // Create a new record if not found
                        Productmodel::create([
                            'name' => $productName,
                            'productcode' => $productCode,
                            'status' => $status,
                            'isTyreorTube' => $tyreOrTube,
                            'product_category' => $category->id,
                            'product_subcategory' => $subcategory->id,
                            'product_group' => $group,
                            'product_group_val' => $group_val,
                            'master_group' => $genx
                        ]);
                        $this->logCronJob('"product:api" created :'.$productCode);
                    }
                }
            } else {
                $this->logCronJob('"product:api" failed, no token return');
            }
        } catch (\Exception $e) {
            // Log the error or handle it as needed
            $this->logCronJob('Error in "product:api" - '.$e);
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
