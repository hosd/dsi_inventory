<?php
    
namespace App\Http\Controllers;
    
use App\Models\Productmodel;
use Illuminate\Http\Request;
use Hash;
use App\Models\ProductCategory;
use App\Models\ProductSubcategory;
use App\Models\DesignNamemodel;
use App\Models\Designcodemodel;
// use App\Models\Tyresizemodel;
use App\Models\Vmodel;
use App\Models\Compatible_model;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
    
class ProductController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
          $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','show']]);
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
        //$size = Tyresizemodel::select('*')->where('status','Y')->where('is_delete',  0)->orderBy('width','ASC')->get();
        $designname = DesignNamemodel::select('*')->where('status','Y')->where('is_delete',  0)->orderBy('name','ASC')->get();
        $designcode = Designcodemodel::select('*')->where('status','Y')->where('is_delete',  0)->orderBy('name','ASC')->get();
        return view('adminpanel.product.index')->with('title',$title)->with('savestatus',$savestatus)->with('count',$count)->with('category',$category)->with('designcode',$designcode)->with('designname',$designname)->with('model',$model);
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
            
            $data = Productmodel::leftJoin('product_category', 'product.product_category', '=', 'product_category.id')
                    ->leftJoin('product_subcategory', 'product.product_subcategory', '=', 'product_subcategory.id')
                    ->leftJoin('design_code', 'product.designcode', '=', 'design_code.id')
                    ->leftJoin('design_name', 'product.designname', '=', 'design_name.id')
                    //->join('tyre_size', 'product.tyresize', '=', 'tyre_size.id')
                    ->select('product.*','product_category.name AS category','design_code.name AS dcode','design_name.name as dname','product_subcategory.name AS subcategory')
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
                    if($row->width != '' && $row->profile != '' && $row->rim != ''){
                        $val = $row->width.' / '.$row->profile.' x '.$row->rim;
                    } else if($row->profile != '' && $row->rim != ''){
                        $val = $row->profile.' x '.$row->rim;
                    } else {
                        $val = '';
                    }
                    return $val;
                })
                ->addColumn('isTyreorTube', function ($row) {

                   if($row->isTyreorTube == '1'){$btn ='Tyre';}else{$btn ='Tube';}
                    
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

        return view('adminpanel.product.list')->with(['count'=> $count]);
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
                'label_name' => 'max:50',
                'categoryID' => 'required',
                'subcategoryID' => 'required',
                'productcode' => 'required|max:50|unique:product,productcode',
                // 'tyresizeID' => 'required',
                // 'designnameID' => 'required',
                // 'designcodeID' => 'required',
                'status' => 'required',
                'product_des' => 'max:1000',
                'customer_des' => 'nullable|max:1000',
                'unitprice' => 'required|max:50',
            ]);
        } else {
            $request->validate([
                'name' => 'required|max:50',
                'label_name' => 'max:50',
                'categoryID' => 'required',
                'subcategoryID' => 'required',
                //'productcode' => 'required|max:50',
                // 'tyresizeID' => 'required',
                // 'designnameID' => 'required',
                // 'designcodeID' => 'required',
                'status' => 'required',
                'product_des' => 'max:1000',
                'customer_des' => 'nullable|max:1000',
                'unitprice' => 'required|max:50',
            ]);
        }
        
        $data_arry = array();
        $data_arry['name'] = $request->name;        
        $data_arry['label_name'] = $request->label_name;
        $data_arry['product_category'] = $request->categoryID;
        $data_arry['product_subcategory'] = $request->subcategoryID;
        //$data_arry['productcode'] = $request->productcode;
        $data_arry['tyresize'] = $request->tyresizeID;
        $data_arry['status'] = $request->status;
        $data_arry['designname'] = $request->designnameID;
         $data_arry['designcode'] = $request->designcodeID;
        $data_arry['unitprice'] = $request->unitprice;
        $data_arry['customer_des'] =$request->customer_des;
        $data_arry['product_des'] =$request->product_des;
        $data_arry['width'] = $request->width;
        $data_arry['profile'] =$request->profile;
        $data_arry['rim'] =$request->rim;  
        
        

        
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
        // $size = Tyresizemodel::select('*')->where('status','Y')->where('is_delete',  0)->orderBy('width','ASC')->get();
        $designname = DesignNamemodel::select('*')->where('status','Y')->where('is_delete',  0)->orderBy('name','ASC')->get();
        $designcode = Designcodemodel::select('*')->where('status','Y')->where('is_delete',  0)->orderBy('name','ASC')->get();
        $model = Vmodel::join('make', 'model.makeID', '=', 'make.id')->select('model.*','make.name as make')->where('model.is_delete',  0)->orderBy('make.name','ASC')->orderBy('model.name','ASC')->get();
        $subcategory = ProductSubcategory::select('*')->where('status','Y')->where('is_delete',  0)->orderBy('name','ASC')->where('category_id',$info[0]->product_category)->get();

        return view('adminpanel.product.edit')->with(['info' => $info, 'title' => $title, 'savestatus' => $savestatus, 'count' => $count, 'category' => $category, 'designcode' => $designcode, 'designname' => $designname, 'count' => $count, 'model' => $model,  'subcategory' => $subcategory]);

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

    public function get_subcategory(Request $request)
    {
        $subs = ProductSubcategory::where("category_id", $request->category_id)
                            ->where('status','Y')
                            ->where('is_delete', 0)
                            ->get();
                
        return response()->json($subs);
}
}