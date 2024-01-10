<?php

namespace App\Exports;

use App\Models\Orderitemmodel;
use App\Models\Ordermodel;
use App\Models\OrderDealer;
use App\Models\Paymentplanmodal;
use DataTables;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class DealerCommission implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping {
    
    use Exportable;
    
    public function __construct($dealer_id, $ordered_from, $ordered_to) {
        $this->dealer_id = $dealer_id;
        $this->ordered_from = $ordered_from;
        $this->ordered_to = $ordered_to;
    }
    
    
    public function collection()
    {
        if($this->ordered_from)
        { 
            $this->ordered_from = date("Y-m-d 00:00:00", strtotime($this->ordered_from)); 
        } else {
            $this->ordered_from = '';
        }
        if($this->ordered_to){ 
            $this->ordered_to = date("Y-m-d 23:59:59", strtotime($this->ordered_to));
        } else {
            $this->ordered_to = '';
        }

        $resultdata = array();
        if($this->dealer_id){
            $token = $this->generatedToken();
            $apidata = Http::withHeaders([
                        'Authorization' => 'Bearer ' . $token,
                    ])->post('https://dsityreshop.com/api/get-completed-dealer-orders?dealer_id=' . $this->dealer_id . '&ordered_from=' . $this->ordered_from. '&ordered_to=' . $this->ordered_to);

            $resultdata = $apidata->json();
        }
        $resultdata = collect($resultdata);
        // dd($resultdata);
        return $resultdata;
    }

    public function headings(): array {
        return ['Order Ref Number',
            'Customer Name',
            'Order Date',
            'Product Name',
            'Product Code',
            'Quantity',
            'Dealer Charge'];
    }

    public function map($query): array {
        $mappedData = [];
        $dealerChargeTotal = 0;
    
        foreach ($query as $data) {
            $mappedData[] = [
                $data['orderRef'] ?? null,
                $data['name'] ?? null,
                $data['orderdate'] ?? null,
                $data['label_name'] ?? null,
                $data['productcode'] ?? null,
                $data['quantity'] ?? null,
                ($data['quantity'] ?? 0) * ($data['dealer_charge'] ?? 0)
            ];
    
            $dealerChargeTotal += ($data['quantity'] ?? 0) * ($data['dealer_charge'] ?? 0);
        }
    
        // Add an empty row between data rows
        $mappedData[] = ['', '', '', '', '', '', ''];

        // Add a row for the dealer charge total
        $mappedData[] = [ // You can adjust this based on your needs
            null, // You can adjust other columns based on your needs
            null,
            null,
            null,
            null,
            'Total Dealer Charge',
            $dealerChargeTotal
        ];
    
        return $mappedData;
    }    

    private function generatedToken() {

        $username = 'admin@tekgeeks.net';
        $password = 'admin123';

        $response = Http::post('https://dsityreshop.com/api/create-access-token?email=' . $username . '&password=' . $password);
        $result = $response->json();
        //dd($result);
        if ($response->successful()) {
            //dd($result);
            $token = $result['token'];
            return $token;
        } else {
            $error = $response->json(); // Assuming the error response is in JSON format
            // Handle the error or log it        
            \LogActivity::addToAPILog('get API token Fail :' . $result['Message']);
            echo "product details API Failed" . '<br>' . 'Error :' . $result['Message'];
        }
    }

}
