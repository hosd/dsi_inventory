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
use App\Models\Bankmodal;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Dealers;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DealerCommission;
    
class ReportController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
          $this->middleware('permission:report-list|product-create|product-edit|product-delete', ['only' => ['index','show']]);
          $this->middleware('permission:product-create', ['only' => ['create','store']]);
          $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
          $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$products = Product::latest()->paginate(5);
        $savestatus= 'A';
        $title = 'New';
        $count = Productmodel::select('*')->get();
        $model = Vmodel::join('make', 'model.makeID', '=', 'make.id')->select('model.*','make.name as make')->where('model.is_delete',  0)->orderBy('make.name','ASC')->orderBy('model.name','ASC')->get();
        $category = ProductCategory::select('*')->where('status','Y')->where('is_delete',  0)->orderBy('name','ASC')->get();
        $size = Tyresizemodel::select('*')->where('status','Y')->where('is_delete',  0)->orderBy('width','ASC')->get();
        $designname = DesignNamemodel::select('*')->where('status','Y')->where('is_delete',  0)->orderBy('name','ASC')->get();
        $designcode = Designcodemodel::select('*')->where('status','Y')->where('is_delete',  0)->orderBy('name','ASC')->get();
        return view('adminpanel.report.index')->with('title',$title)->with('savestatus',$savestatus)->with('count',$count)->with('category',$category)->with('designcode',$designcode)->with('designname',$designname)->with('size',$size)->with('model',$model);
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
            
            $data = Productmodel::join('product_category', 'product.product_category', '=', 'product_category.id')
                    ->join('design_code', 'product.designcode', '=', 'design_code.id')
                    ->join('design_name', 'product.designname', '=', 'design_name.id')
                    ->join('tyre_size', 'product.tyresize', '=', 'tyre_size.id')
                    ->select('product.*','product_category.name AS category','design_code.name AS dcode','design_name.name as dname','tyre_size.width','tyre_size.profile','tyre_size.rim')
                    ->orderBy('product.name','ASC')
                    ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function($row){
                if($row->status == 1){
                $btn = 'Active';}
                else{  $btn = 'Inactive';}
                 return $btn;
            })  
                    ->addColumn('edit', function ($row) {

                   $edit_url = route('edit-product',encrypt($row->id));
                    $btn = '<a href="' . $edit_url . '"><i class="fa fa-edit"></i></a>';
                    return $btn;
                }) 
                ->addColumn('size', function ($row) {

                   $btn = $row->width.' / '.$row->profile.' x '.$row->rim;
                    return $btn;
                })
                
                ->addColumn('activation', function($row){
                    if ( $row->status == "1" )
                        $status ='fa fa-check';
                    else
                        $status ='fa fa-remove';

                    $status_url = route('status-product',encrypt($row->id));
                    $btn = '<a href="'.$status_url.'"><i class="'.$status.'"></i></a>';

                    return $btn;
                })
                   
                
                //->addColumn('edit', 'product.actionsEdit')
                //->addColumn('activation', 'product.actionsStatus')
                ->rawColumns(['edit', 'activation','users'])
                ->make(true);
        }

        return view('adminpanel.product.list')->with('count',$count);
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
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('product.show',compact('product'));
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
        
        $title = 'Edit';
        $ID = decrypt($id);
        $info = Productmodel::where('id', '=', $ID)->get();
        
        $savestatus = 'E';
        $count = Productmodel::select('*')->get();
        $Comp_model = Compatible_model::select('*')->where('productID',$ID)->pluck('modelID')->toArray();
        $category = ProductCategory::select('*')->where('status','Y')->where('is_delete',  0)->orderBy('name','ASC')->get();
        $size = Tyresizemodel::select('*')->where('status','Y')->where('is_delete',  0)->orderBy('width','ASC')->get();
        $designname = DesignNamemodel::select('*')->where('status','Y')->where('is_delete',  0)->orderBy('name','ASC')->get();
        $designcode = Designcodemodel::select('*')->where('status','Y')->where('is_delete',  0)->orderBy('name','ASC')->get();
        $model = Vmodel::select('*')->where('status','Y')->where('is_delete',  0)->orderBy('name','ASC')->get();
        return view('adminpanel.product.edit')->with('info',$info)->with('title',$title)->with('savestatus',$savestatus)->with('count',$count)->with('category',$category)->with('designcode',$designcode)->with('designname',$designname)->with('size',$size)->with('count',$count)->with('Comp_model',$Comp_model)->with('model',$model);

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

    public function dealer_commission(Request $request)
    {
        $dealers = Dealers::select('dealers.*')->get();

        if ($request->ajax()) {
            if($request->dealer_id)
            {
                $dealer_id = $request->dealer_id;
            } else {
                $dealer_id = '';
            }
            
            if($request->ordered_from)
            { 
                $ordered_from = date("Y-m-d 00:00:00", strtotime($request->ordered_from)); 
            } else {
                $ordered_from = '';
            }
            if($request->ordered_to){ 
                $ordered_to = date("Y-m-d 23:59:59", strtotime($request->ordered_to));
            } else {
                $ordered_to = '';
            }
            
            $resultdata = array();
            $token = $this->generatedToken();
            $apidata = Http::withOptions([
                'verify' => false
            ])->withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->post('https://uat.dsityreshop.com/api/get-completed-dealer-orders', [
                'dealer_id' => $dealer_id,
                'ordered_from' => $ordered_from,
                'ordered_to' => $ordered_to
            ]);

            $resultdata = $apidata->json();
            
            if (empty($resultdata['orderList'])) {
                return Datatables::of([])
                        ->addColumn('error', function () {
                            return 'No data available.';
                        })
                        ->rawColumns(['error'])
                        ->make(true);
            } else {
                return Datatables::of($resultdata['orderList'])
                        ->addIndexColumn()
                        ->addColumn('order_ref_no', function ($row) {
                            return $row['orderRef'];
                        })
                        ->addColumn('name', function ($row) {
                            return $row['name'];
                        })
                        ->addColumn('orderdate', function ($row) {
                            return $row['orderdate'];
                        })
                        ->addColumn('label_name', function ($row) {
                            return $row['label_name'];
                        })
                        ->addColumn('productcode', function ($row) {
                            return $row['productcode'];
                        })
                        ->addColumn('dealer_charge', function ($row) {
                            return $row['quantity'] * $row['dealer_charge'];
                        })
                        ->addColumn('quantity', function ($row) {
                            return $row['quantity'];
                        })
                        ->addColumn('dealer', function ($row) {
                            $dealer1 = Dealers::find($row['dealerID']);
                            if ($dealer1) {
                                return $dealer1->name.' - '.$dealer1->dealercode;
                            } else {
                                return 'Dealer not found';
                            }
                        })
                        // ->rawColumns(['order_ref_no','name'])
                        ->make(true);
            }
        }
        return view('adminpanel.report.dealer_commission')->with(['dealers' => $dealers]);
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

    public function dealer_commission_report_excel(Request $request)
    {       
        $dealer_id = $request->ex_dealer_id;
        $ordered_from = $request->ex_ordered_from;
        $ordered_to = $request->ex_ordered_to;
        $current_date = date('Y_m_d_H_i');
        $filename = 'Report';
        return Excel::download(new DealerCommission($dealer_id, $ordered_from, $ordered_to), "$filename _ $current_date.xlsx");
    }

}