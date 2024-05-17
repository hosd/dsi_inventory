<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Hash;
use App\Models\Dealers;
use App\Models\District;
use App\Models\City;
use App\Models\Address;
use App\Models\Province;
use App\Models\Dealeruser;
use Illuminate\Validation\Rule;
use App\Models\User;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Bankmodal;

class DealersContoller extends Controller
{
    function __construct()
    {

        $this->middleware('permission:dealers-list|dealers-create|dealers-edit|dealers-delete', ['only' => ['datalist']]);
        $this->middleware('permission:dealers-create', ['only' => ['index', 'store']]);
        $this->middleware('permission:dealers-edit', ['only' => ['edit', 'update','activation']]);
        $this->middleware('permission:dealers-list', ['only' => ['datalist']]);
        $this->middleware('permission:dealers-list|dealers-create|dealers-edit|dealers-delete', ['only' => ['datalist']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $savestatus= 'A';
        $title = 'New';
        $count = Dealers::select('dealers.*')->get();
        $province =Province::select('*')->where('status','Y')->where('is_delete',  0)->orderBy('province_name_en','ASC')->get();
        $District =District::select('*')->where('status','Y')->where('is_delete',  0)->orderBy('district_name_en','ASC')->get();
        $city =City::select('*')->where('status', 'Y')->where('is_delete',  0)->orderBy('city_name_en','ASC')->get();
        $bank =Bankmodal::select('*')->where('status', 'Y')->where('is_delete',  0)->orderBy('name','ASC')->get();
        return view('adminpanel.dealers.index')->with('title',$title)->with('District',$District)->with('savestatus',$savestatus)->with('city',$city)->with('province',$province)->with('count',$count)->with('bank',$bank);
    }

     public function datalist(Request $request)
    {
         $count = Dealers::select('dealers.*')->get();
        if ($request->ajax()) {
            
            $data = Dealers::join('address', 'dealers.addressID', '=', 'address.id')
                    ->join('provinces', 'address.provinceID', '=', 'provinces.id')
                    ->join('districts', 'address.districtID', '=', 'districts.id')
                    ->join('cities', 'address.cityID', '=', 'cities.id')
                    ->select('dealers.*','cities.city_name_en as city','provinces.province_name_en as province','districts.district_name_en as state')
                    ->orderBy('dealers.name','ASC')
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

                   $edit_url = route('edit-dealers',encrypt($row->id));
                    $btn = '<a href="' . $edit_url . '"><i class="fa fa-edit"></i></a>';
                    return $btn;
                }) 
                
                ->addColumn('activation', function($row){
                    if ( $row->status == "1" )
                        $status ='fa fa-check';
                    else
                        $status ='fa fa-remove';

                    $status_url = route('status-dealers',encrypt($row->id));
                    $btn = '<a href="'.$status_url.'"><i class="'.$status.'"></i></a>';

                    return $btn;
                })
                    ->addColumn('users', function ($row) {
                   $Dusers = User::select('users.*')
                    ->where('dealerID',$row->id)
                    ->orderBy('users.name','ASC')
                    ->get();   
                   $count = count($Dusers);
                   $edit_url = route('dealer-user-list',encrypt($row->id));
                    $btn = '<a href="' . $edit_url . '"><i class=" fa fa-user">&nbsp;'. $count .'</i></a>';
                    return $btn;
                }) 
                
                //->addColumn('edit', 'dealers.actionsEdit')
                //->addColumn('activation', 'dealers.actionsStatus')
                ->rawColumns(['edit', 'activation','users'])
                ->make(true);
        }

        return view('adminpanel.dealers.list')->with('count',$count);
    }

    /**
     * Store a newly created resource in storage.
     * update existing resources 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->savestatus == 'A') {
            $request->validate([
                'dealer_name' => 'required|max:50|unique:dealers,name',
                'email' => 'required|max:50|email',
                'phone' => 'required|max:20|min:10',
                'vContactperson' => 'max:50',
                'vAddressline1' => 'required|max:50',
                'vAddressline2' => 'required|max:50',
                'status' => 'required',
                'provinceID' => 'required',
                'districtID' => 'required',
                'cityID' => 'required',
              	'dealercode' => 'max:30',
                'bankID'  => 'required',
                'vBranchname'  => 'required|max:100',
                'vBranchcode'  => 'required|max:50',
                'vAccountnum' => 'required|max:50'
            ]);
        } else {
            $request->validate([
                'dealer_name' => 'required|max:50',
                'email' => 'required|max:50|email',
                'phone' => 'required|max:20|min:10',
                'vContactperson' => 'max:50',
                'vAddressline1' => 'required|max:50',
                'vAddressline2' => 'required|max:50',
                'status' => 'required',
                'provinceID' => 'required',
                'districtID' => 'required',
                'cityID' => 'required',
                'dealercode' => ['max:30', Rule::unique('dealers')->where(function ($query) use ($request) {
                    return $query->where('id', '!=', decrypt($request->id))
                                 ->whereNotNull('dealercode');})
                                ],
                'bankID'  => 'required',
                'vBranchname'  => 'required|max:100',
                'vBranchcode'  => 'required|max:50',
                'vAccountnum' => 'required|max:50'
            ]);
        }
        
        $data_arry = array();
        $data_arry['name'] = $request->dealer_name;
        $data_arry['email'] = $request->email;
        $data_arry['phone'] = $request->phone;
        $data_arry['Contact_person'] = $request->vContactperson;
        $data_arry['opening_hours'] = $request->vOpeninghours;
        $data_arry['vLatitude'] = $request->vLatitude;
        $data_arry['vLongitude'] = $request->vLongitude;
        $data_arry['status'] = $request->status;        
        $data_arry['dealercode'] =$request->dealercode;
        $data_arry['bankID'] =$request->bankID;
        $data_arry['vBranchname'] =$request->vBranchname;
        $data_arry['vBranchcode'] =$request->vBranchcode;
        $data_arry['vAccountnum'] =$request->vAccountnum;
        
        $addresses_arry = array(); 
            // address details
        $addresses_arry['vAddressline1'] =$request->vAddressline1;
        $addresses_arry['vAddressline2'] =$request->vAddressline2;
        $addresses_arry['provinceID'] =$request->provinceID;
        $addresses_arry['districtID'] =$request->districtID;
        $addresses_arry['cityID'] =$request->cityID;

        
        if($request->savestatus == 'A'){
            
            $addressID = Address::create($addresses_arry);
            $data_arry['addressID'] = $addressID->id;
            $id= Dealers::create($data_arry);
             \LogActivity::addToLog('New dealers'.$request->dealer_name.' added('.$id->id.').');
            return redirect('new-dealers')->with('success', 'New dealers created successfully');
        }else{
            
            $recid = $request->id;
            $addressid = $request->adddressid;
            Address::where('id', decrypt($addressid))->update($addresses_arry);
            Dealers::where('id', decrypt($recid))->update($data_arry);
            \LogActivity::addToLog('dealers ' . $request->dealer_name . ' updated(' . decrypt($recid) . ').');
            return redirect('/edit-dealers/'.$recid.'')->with('success', 'dealers updated successfully');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $count = Dealers::select('dealers.*')->get();
        $title = 'Edit';
        $ID = decrypt($id);
        $info = Dealers::where('id', '=', $ID)->get();
        $province =Province::select('*')->where('status','Y')->where('is_delete',  0)->orderBy('province_name_en','ASC')->get();
        $District =District::select('*')->where('status','Y')->where('is_delete',  0)->orderBy('district_name_en','ASC')->get();
        $city =City::select('*')->where('status', 'Y')->where('is_delete',  0)->orderBy('city_name_en','ASC')->get();
        $addressID = $info[0]->addressID; 
        $addressinfo = Address::where('id','=',$addressID)->get();
        $savestatus = 'E';
        $bank =Bankmodal::select('*')->where('status', 'Y')->where('is_delete',  0)->orderBy('name','ASC')->get();
        return view('adminpanel.dealers.edit')->with('title',$title)->with('info',$info)->with('savestatus',$savestatus)->with('province',$province)->with('District',$District)->with('city',$city)->with('addressinfo',$addressinfo)->with('count',$count)->with('bank',$bank);
        //return view('masterdata.complain_category.edit', ['data' => $data]);
        //return view('masterdata.complain_category.edit');
    }
    
    
    public function activation(Request $request)
    {
        $idD = decrypt($request->id);

        $data =  Dealers::find($idD);

        if ( $data->status == "1" ) {

            $data->status = '0';
            $data->save();
            $id = $data->id;

            \LogActivity::addToLog('dealers record '.$data->name.' deactivated('.$idD.')');

            User::where("dealerID", $idD)->update(["status" => "N"]);

            \LogActivity::addToLog('dealer '.$data->name.' user records deactivated');

            return redirect()->route('dealers-list')
            ->with('success', 'Record deactivate successfully.');

        } else {

            $data->status = "1";
            $data->save();
            $id = $data->id;

            \LogActivity::addToLog('dealers record '.$data->name.' activated('.$idD.')');

            return redirect()->route('dealers-list')
            ->with('success', 'Record activate successfully.');
        }

    }
    
     public function get_state_cities(Request $request)
    {
        $districtID =  $request->districtID;
        $city['data'] = City::select('*')->where("district_id", $districtID)->where('is_delete',  0)->orderBy('city_name_en','ASC')->get();
        return response()->json($city);
    }
    
    
     public function get_dealer_territories(Request $request)
    {
         $provinceID =  $request->provinceID; 
        $territories['data'] = District::select('*')->where("province_id", $provinceID)->where('is_delete',  0)->orderBy('district_name_en','ASC')->get();
        return response()->json($territories);
    }

    public function check_existing_dealercode_edit(Request $request)
    {
        // echo $request->startTime;
        //   exit();
        // \DB::enableQueryLog();
        $code = $request->code;
        $id = decrypt($request->id);
        $users = Dealers::where("dealercode", $code)->where("id",'!=', $id)
                        ->get();
                        
        if ($users->isEmpty()) {
            return response()->json(true);
        }else{
            return response()->json(false);
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    
    //////////////////// Add users to dealers / stiores //////////////////////////////////////////
    
     public function add_dealer_user($id)
    {
        $Dealer_ID = $id;
        $ID_dealer = decrypt($Dealer_ID);
        $info = Dealers::where('id', '=', $ID_dealer)->get();
        $savestatus= 'A';
        $district =District::select('*')->orderBy('district_name_en','ASC')->get();
        $city =City::select('*')->where('status', 'Y')->orderBy('city_name_en','ASC')->get();
        return view('adminpanel.dealers.add_dealer_user')->with('district',$district)->with('savestatus',$savestatus)->with('city',$city)->with('Dealer_ID',$Dealer_ID)->with('info',$info);
    }
    
    public function checkEmail_dealeruser(Request $request)
    {
        // echo $request->startTime;
        //   exit();
        // \DB::enableQueryLog();
        $users = User::where("email", $request->email)
                        ->where("roleID",2)
                        ->get();
                        // $events = \DB::getQueryLog();
                        // print_r($events);
                        // exit();

        return response()->json($users);
    }
    
    public function save_dealer_user(Request $request)
    {
        $dealerID = $request->Dealer_id;
        $data_arry = array();
        if ($request->savestatus == 'A') {
            $request->validate([
                'name' => 'required|max:50',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|same:confirmpassword',
                'phone' => 'required|max:20|min:10',
                'status' => 'required'
            ]);
            
            
            $data_arry['name'] = $request->name;
            $data_arry['email'] = $request->email;
            $data_arry['mobile_no'] = $request->phone;
            $data_arry['dealerID'] = decrypt($request->Dealer_id);
            $data_arry['roleID'] = 3;
            $data_arry['password'] = Hash::make($request->password);
            $data_arry['status'] = $request->status;
            
        } else {
            $id = decrypt($request->id);
            if ($request->password) {
                $request->validate([
                    'name' => 'required|max:50',
                    'email' => 'required|email|unique:users,email,' . $id,
                    'password' => 'same:confirmpassword',
                    'phone' => 'required|max:20|min:10',
                    'status' => 'required'
                ]);
                
                $data_arry['name'] = $request->name;
                $data_arry['email'] = $request->email;
                $data_arry['mobile_no'] = $request->phone;
                $data_arry['dealerID'] = decrypt($request->Dealer_id);
                $data_arry['roleID'] = 3;
                $data_arry['password'] = Hash::make($request->password);
                $data_arry['status'] = $request->status;
            } else {
                $request->validate([
                    'name' => 'required|max:50',
                    'email' => 'required|email|unique:users,email,' . $id,
                    //'password' => 'same:confirmpassword',
                    'phone' => 'required|max:20|min:10',
                    'status' => 'required'
                ]);
              
                $data_arry['name'] = $request->name;
                $data_arry['email'] = $request->email;
                $data_arry['mobile_no'] = $request->phone;
                $data_arry['dealerID'] = decrypt($request->Dealer_id);
                $data_arry['roleID'] = 3;
                //$data_arry['password'] = Hash::make($request->password);
                $data_arry['status'] = $request->status;
            }
        }
        
        
        if($request->savestatus == 'A'){
            
           
            $id= User::create($data_arry);
            $id->assignRole('Dealer User');
             \LogActivity::addToLog('New dealer user'.$request->name.' added('.$id->id.').');
            return redirect('new-dealer-user/'.$dealerID)->with('success', 'New dealer user created successfully');
        }else{
            
            $recid = $request->id;
           
            User::where('id', decrypt($recid))->update($data_arry);
            \LogActivity::addToLog('dealer user edited ' . $request->name . ' updated(' . decrypt($recid) . ').');
            return redirect('/edit-dealer-user/'.$recid.'')->with('success', 'dealer user updated successfully');
        }
    }
    
    public function dealer_user_list(Request $request)
    {   
        $Dealer_ID = request()->segment(2);
        $ID_dealer = decrypt($Dealer_ID);
        $info = Dealers::where('id', '=', $ID_dealer)->get();
        
        if ($request->ajax()) {
            $data = User::select('users.*')
                    ->where('dealerID',$ID_dealer)
                    ->orderBy('users.name','ASC')
                    ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function($row){
                if($row->status == "Y"){
                $btn = 'Active';}
                else{  $btn = 'Inactive';}
                 return $btn;
            })  
                    ->addColumn('edit', function ($row) {

                   $edit_url = route('edit-dealer-user',encrypt($row->id));
                    $btn = '<a href="' . $edit_url . '"><i class="fa fa-edit"></i></a>';
                    return $btn;
                }) 
                
                ->addColumn('activation', function($row){
                    if ( $row->status == "Y" )
                        $status ='fa fa-check';
                    else
                        $status ='fa fa-remove';

                    $status_url = route('status-dealer-user',encrypt($row->id));
                    $btn = '<a href="'.$status_url.'"><i class="'.$status.'"></i></a>';

                    return $btn;
                })
                
                
                //->addColumn('edit', 'dealers.actionsEdit')
                //->addColumn('activation', 'dealers.actionsStatus')
                ->rawColumns(['edit', 'activation'])
                ->make(true);
        }

        return view('adminpanel.dealers.dealer_userlist')->with('info',$info)->with('Dealer_ID',$Dealer_ID);
    }
    
    public function edit_dealeruser($id)
    {
        $ID = decrypt($id);
        $Userinfo = User::where('id', '=', $ID)->get();
        //var_dump($Userinfo[0]->dealerID);die();
        $Dealer_ID = encrypt($Userinfo[0]->dealerID);
        $info = Dealers::where('id', '=',$Userinfo[0]->dealerID )->get();
        
        
        $savestatus = 'E';
        return view('adminpanel.dealers.add_dealer_user')->with('Userinfo',$Userinfo)->with('savestatus',$savestatus)->with('info',$info)->with('Dealer_ID',$Dealer_ID);
        //return view('masterdata.complain_category.edit', ['data' => $data]);
        //return view('masterdata.complain_category.edit');
    }
    
    public function status_dealer_user(Request $request)
    {
        $idD = decrypt($request->id);

        $data =  User::find($idD);

        if ( $data->status == "Y" ) {

            $data->status = 'N';
            $data->save();
            $id = $data->id;

            \LogActivity::addToLog('dealers user record '.$data->name.' deactivated('.$id.')');

            return redirect()->route('dealer-user-list',encrypt($data->dealerID))
            ->with('success', 'Record deactivate successfully.');

        } else {

            $data->status = "Y";
            $data->save();
            $id = $data->id;

            \LogActivity::addToLog('dealers user record '.$data->name.' activated('.$id.')');

            return redirect()->route('dealer-user-list',encrypt($data->dealerID))
            ->with('success', 'Record activate successfully.');
        }

    }
    
    
    
}
