<?php
    
namespace App\Http\Controllers;
    
use App\Models\Productmodel;
use Illuminate\Http\Request;
use Hash;
use App\Models\ProductCategory;
use App\Models\DesignNamemodel;
use App\Models\Designcodemodel;
use App\Models\Tyresizemodel;
use App\Models\Vmodel;
use App\Models\Compatible_model;
use App\Models\Dealers;
use App\Models\District;
use App\Models\City;
use App\Models\Address;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
    
class CancelledOrderController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
          $this->middleware('permission:cancelled-order-list', ['only' => ['datalist']]);
//          $this->middleware('permission:product-create', ['only' => ['create','store']]);
//          $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
//          $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$products = Product::latest()->paginate(5);
        
        return view('adminpanel.order.pending_order_list');
    }

    private function generatedToken() {

        $username = 'admin@tekgeeks.net';
        $password = 'admin123';

        $response = Http::withOptions([
            'verify' => false // Disable SSL verification
        ])->post('https://uat.dsityreshop.com/api/create-access-token', [
            'email' => $username,
            'password' => $password
        ]);
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
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
         public function datalist(Request $request)
    {
         $count = Productmodel::select('*')->get();
               if ($request->ajax()) {
            $token = $this->generatedToken();
            $dealerID = auth()->user()->dealerID;
            //$dealerID = 1;
            $status = 'cancelled';

            $apidata = Http::withOptions([
                'verify' => false
            ])->withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->post('https://uat.dsityreshop.com/api/get-pickup-orders', [
                'status' => $status,
                'dealerID' => $dealerID
            ]);

            $resultdata = $apidata->json(); 
            if (empty($resultdata['orderList'])) {
                return Datatables::of([])
                                ->addColumn('error', function () {
                                    return 'No data available.';
                                })
                                ->rawColumns(['error'])
                                ->make(true);
            }

            return Datatables::of($resultdata['orderList'])
                            ->addIndexColumn()
                            ->addColumn('dealer', function ($row) {
                                $dealerinfo = Dealers::join('address', 'dealers.addressID', '=', 'address.id')
                    ->join('provinces', 'address.provinceID', '=', 'provinces.id')
                    ->join('districts', 'address.districtID', '=', 'districts.id')
                    ->join('cities', 'address.cityID', '=', 'cities.id')
                    ->select('dealers.*','cities.city_name_en as city','provinces.province_name_en as province','districts.district_name_en as state')
                    ->where('dealers.id',$row['dealerID'])
                    ->get();
                    
                    if (isset($dealerinfo[0])) {
                        return $dealerinfo[0]->name . '-' . $dealerinfo[0]->city . ' (' . $dealerinfo[0]->phone . ')';
                    } else {
                        return 'Dealer information not available';
                    }
                            })
                            ->addColumn('edit', function ($row) {
                                $edit_url = route('cancelled-order-details', $row['orderRef']);
                                $btn = '<a   href="' . $edit_url . '"><i class="fa fa-edit"></i></a>';
                                return $btn;
                            })
                            ->rawColumns(['edit','dealer'])
                            ->make(true);
        }

        return view('adminpanel.order.cancelled_order_list')->with('count',$count);
    }
    

    
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     * 
     */
    
     public function edit($id)
    {
        $token = $this->generatedToken();

        $apidata = Http::withOptions([
            'verify' => false
        ])->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('https://uat.dsityreshop.com/api/get-order-details', [
            'orderID' => $id 
        ]);

        $resultdata = $apidata->json();
        $orderinfo = $resultdata['orderdetails'];
        $productlist = $resultdata['ProductList'];
        $customer = $resultdata['Customer']; 
        $status= $orderinfo['status'];
        $dealerID= $orderinfo['dealerID'];
        $dealerinfo = Dealers::join('address', 'dealers.addressID', '=', 'address.id')
                    ->join('provinces', 'address.provinceID', '=', 'provinces.id')
                    ->join('districts', 'address.districtID', '=', 'districts.id')
                    ->join('cities', 'address.cityID', '=', 'cities.id')
                    ->select('dealers.*','cities.city_name_en as city','provinces.province_name_en as province','districts.district_name_en as state','address.vAddressline1','address.vAddressline2')
                    ->where('dealers.id',$dealerID)
                    ->get();
        
        
        
        return view('adminpanel.order.cancelled_order_details')->with('orderinfo', $orderinfo)->with('productlist', $productlist)->with('customer', $customer)->with('dealerinfo',$dealerinfo);

        //return view('masterdata.complain_category.edit', ['data' => $data]);
        //return view('masterdata.complain_category.edit');
  
        
    }
    
    public function activation(Request $request)
    {
        $idD = decrypt($request->id);

        $data =  Productmodel::find($idD);

        if ( $data->status == "1" ) {

            $data->status = '0';
            $data->save();
            $id = $data->id;

            \LogActivity::addToLog('product record '.$data->name.' deactivated('.$id.')');

            return redirect()->route('product-list')
            ->with('success', 'Record deactivate successfully.');

        } else {

            $data->status = "1";
            $data->save();
            $id = $data->id;

            \LogActivity::addToLog('product record '.$data->name.' activated('.$id.')');

            return redirect()->route('product-list')
            ->with('success', 'Record activate successfully.');
        }

    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
         request()->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
    
        $product->update($request->all());
    
        return redirect()->route('product.index')
                        ->with('success','Product updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
    
        return redirect()->route('product.index')
                        ->with('success','Product deleted successfully');
    }
    
    public function check_existing_productcode(Request $request)
    {
        // echo $request->startTime;
        //   exit();
        // \DB::enableQueryLog();
        $code = $request->code;
        $users = Productmodel::where("productcode", $code)
                        ->get();
                        // $events = \DB::getQueryLog();
                        // print_r($events);
                        // exit();
        if ($users->isEmpty()) {
            return response()->json(true);
        }else{
            return response()->json(false);
        }
        
    }
    
    public function check_existing_productcode_edit(Request $request)
    {
        // echo $request->startTime;
        //   exit();
        // \DB::enableQueryLog();
        $code = $request->code;
        $id = decrypt($request->id);
        $users = Productmodel::where("productcode", $code)->where("id",'!=', $id)
                        ->get();
                        
        if ($users->isEmpty()) {
            return response()->json(true);
        }else{
            return response()->json(false);
        }
        
    }
}