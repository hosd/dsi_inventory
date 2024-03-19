<?php

namespace App\Exports;

use App\Models\Orderitemmodel;
use App\Models\Ordermodel;
use App\Models\OrderDealer;
use App\Models\Paymentplanmodal;
use App\Models\Bankmodal;
use App\Models\District;
use App\Models\City;
use App\Models\Address;
use App\Models\Province;
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
use App\Models\Dealers;

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
        $token = $this->generatedToken();
        $apidata = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $token,
                ])->post('https://dsityreshop.com/api/get-completed-dealer-orders?dealer_id=' . $this->dealer_id . '&ordered_from=' . $this->ordered_from. '&ordered_to=' . $this->ordered_to);

        $resultdata = $apidata->json();
        $resultdata = collect($resultdata);
        // dd($resultdata);
        return $resultdata;
    }

    public function headings(): array {
        return [
            'Invoice Date',
            'Dealer Code',
            'Dealer Name',
            'Dealer Address',
            'City',
            'Dealer Phone Number',
            'Customer Name',
            'Invoice Number',
            'Product Name',
            'Product Code',
            'Quantity',
            'Order Value',
            'Dealer Income',
            'To Bank Account',
            'Bank Details'
        ];
    }

    public function map($query): array {
        $mappedData = [];
        $dealerChargeTotal = 0;
    
        foreach ($query as $data) {
            //$dealer1 = Dealers::find($data['dealerID']);
            $dealer1 = Dealers::join('address', 'dealers.addressID', '=', 'address.id')
            ->join('provinces', 'address.provinceID', '=', 'provinces.id')
            ->join('districts', 'address.districtID', '=', 'districts.id')
            ->join('cities', 'address.cityID', '=', 'cities.id')
            ->leftJoin('bank', 'dealers.bankID', '=', 'bank.id')
            ->where('dealers.id',$data['dealerID'])
            ->select('dealers.*','address.vAddressline1','address.vAddressline2','cities.city_name_en as city','provinces.province_name_en as province','districts.district_name_en as state','bank.name as bank')
            ->first();
            $mappedData[] = [
                
                $data['orderdate'] ?? null,
                $dealer1->dealercode,
                $dealer1->name,
                $dealer1->vAddressline1.','.$dealer1->vAddressline2.','.$dealer1->city.','.$dealer1->state.','.$dealer1->province,
                $dealer1->city,
                $dealer1->phone,
                $data['name'] ?? null,
                $data['orderRef'] ?? null,
                $data['label_name'] ?? null,
                $data['productcode'] ?? null,
                $data['quantity'] ?? null,
                $data['invoicetotal'] ?? null,
                ($data['quantity'] ?? 0) * ($data['dealer_charge'] ?? 0),
                $dealer1->vAccountnum,
                $dealer1->bank.'. '.$dealer1->vBranchname.'-'.$dealer1->vBranchcode,
            ];
    
            $dealerChargeTotal += ($data['quantity'] ?? 0) * ($data['dealer_charge'] ?? 0);
        }
    
        // Add an empty row between data rows
        $mappedData[] = ['', '', '', '', '', '', '', '', '', '', '', ''];

        // Add a row for the Dealer Income total
        $mappedData[] = [
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            'Total Dealer Income',
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
