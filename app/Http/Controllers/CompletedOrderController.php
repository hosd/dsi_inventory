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
    
class CompletedOrderController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
          $this->middleware('permission:completed-order-list', ['only' => ['datalist']]);
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
            // 'verify' => false // Disable SSL verification
        ])->post('https://dsityreshop.com/api/create-access-token', [
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
            $status = 'completed';

            $apidata = Http::withOptions([
                // 'verify' => false
            ])->withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->post('https://dsityreshop.com/api/get-pickup-orders', [
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
                                $edit_url = route('completed-order-details', $row['orderRef']);
                                $btn = '<a   href="' . $edit_url . '"><i class="fa fa-edit"></i></a>';
                                return $btn;
                            })
                            ->rawColumns(['edit','dealer'])
                            ->make(true);
        }

        return view('adminpanel.order.completed_order_list')->with('count',$count);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       if ($request->savestatus == 'A') {
            $request->validate([
                'name' => 'required|max:50|unique:product,name',
                'categoryID' => 'required',
                'productcode' => 'required|max:50|unique:product,productcode',
                'tyresizeID' => 'required',
                'designnameID' => 'required',
                'designcodeID' => 'required',
                'status' => 'required',
                'product_des' => 'required|max:1000',
                'customer_des' => 'required|max:1000',
                'unitprice' => 'required|max:50',
            ]);
        } else {
            $request->validate([
                'name' => 'required|max:50',
                'categoryID' => 'required',
                'productcode' => 'required|max:50',
                'tyresizeID' => 'required',
                'designnameID' => 'required',
                'designcodeID' => 'required',
                'status' => 'required',
                'product_des' => 'required|max:1000',
                'customer_des' => 'required|max:1000',
                'unitprice' => 'required|max:50',
            ]);
        }
        
        $data_arry = array();
        $data_arry['name'] = $request->name;        
        $data_arry['product_category'] = $request->categoryID;
        $data_arry['productcode'] = $request->productcode;
        $data_arry['tyresize'] = $request->tyresizeID;
        $data_arry['status'] = $request->status;
        $data_arry['designname'] = $request->designnameID;
         $data_arry['designcode'] = $request->designcodeID;
        $data_arry['unitprice'] = $request->unitprice;
        $data_arry['customer_des'] =$request->customer_des;
        $data_arry['product_des'] =$request->product_des;
        
        

        
        if($request->savestatus == 'A'){
            
            $id= Productmodel::create($data_arry);
                if (isset($request->modelID)) {
                    for ($i = 0; $i < count($request->modelID); $i++) {
                    $com_model = array();
                    $com_model['productID'] = $id->id;
                    $com_model['modelID'] = $request->modelID[$i];
                     Compatible_model::create($com_model);
                    }
            }
             \LogActivity::addToLog('New product'.$request->name.' added('.$id->id.').');
            return redirect('new-product')->with('success', 'New product created successfully');
            
        }else{
            
            $recid = $request->id;
            Productmodel::where('id', decrypt($recid))->update($data_arry);
            
            if (isset($request->modelID)) {
                Compatible_model::where('productID', decrypt($recid))->delete();
                for ($i = 0; $i < count($request->modelID); $i++) {
                    $com_model = array();
                    $com_model['productID'] = decrypt($recid);
                    $com_model['modelID'] = $request->modelID[$i];
                     Compatible_model::create($com_model);
                    }
            }else{
                Compatible_model::where('productID', decrypt($recid))->delete();
            }
            
            
            \LogActivity::addToLog('product ' . $request->name . ' updated(' . decrypt($recid) . ').');
            return redirect('/edit-product/'.$recid.'')->with('success', 'product updated successfully');
        }
    }
    
    
    
    public function edit($id)
    {
        $token = $this->generatedToken();

        $apidata = Http::withOptions([
            // 'verify' => false
        ])->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('https://dsityreshop.com/api/get-order-details', [
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
        
        
        
        return view('adminpanel.order.completed_order_details')->with('orderinfo', $orderinfo)->with('productlist', $productlist)->with('customer', $customer)->with('dealerinfo',$dealerinfo);
  
        
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