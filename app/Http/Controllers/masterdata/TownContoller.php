<?php

namespace App\Http\Controllers\masterdata;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Hash;
use App\Models\District;
use App\Models\City;
use App\Models\Province;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TownContoller extends Controller
{
    function __construct()
    {

        $this->middleware('permission:town-list|town-create|town-edit|town-delete', ['only' => ['datalist']]);
        $this->middleware('permission:town-create', ['only' => ['index', 'store']]);
        $this->middleware('permission:town-edit', ['only' => ['edit', 'update','activation']]);
        $this->middleware('permission:town-list', ['only' => ['datalist']]);
        $this->middleware('permission:town-list|town-create|town-edit|town-delete', ['only' => ['datalist']]);
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
        $province =Province::select('*')->where('status','Y')->where('is_delete',  0)->orderBy('province_name_en','ASC')->get();
        $District =District::select('*')->where('status','Y')->where('is_delete',  0)->orderBy('district_name_en','ASC')->get();
        return view('adminpanel.town.index')->with('savestatus',$savestatus)->with('title',$title)->with('province',$province)->with('District',$District);
    }

     public function datalist(Request $request)
    {
        if ($request->ajax()) {
            // $data = City::join('provinces', 'cities.province_id', '=', 'provinces.id')
            //         ->join('districts', 'cities.district_id', '=', 'districts.id')
            //         ->where('cities.is_delete',  0)
            //         ->select('cities.*','provinces.province_name_en','districts.district_name_en')
            //         ->orderBy('city_name_en','ASC')
            //         ->get();
            $data = DB::table('cities')->join('provinces', 'cities.province_id', '=', 'provinces.id')
                    ->join('districts', 'cities.district_id', '=', 'districts.id')
                    ->where('cities.is_delete',  0)
                    ->select('cities.*','provinces.province_name_en','districts.district_name_en')
                    ->orderBy('city_name_en','ASC');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function($row){
                if($row->status == 'Y'){
                $btn = 'Active';}
                else{  $btn = 'Inactive';}
                 return $btn;
            })  
                    ->addColumn('edit', function ($row) {

                   $edit_url = route('edit-town',encrypt($row->id));
                    $btn = '<a href="' . $edit_url . '"><i class="fa fa-edit"></i></a>';
                    return $btn;
                }) 
                
                ->addColumn('activation', function($row){
                    if ( $row->status == "Y" )
                        $status ='fa fa-check';
                    else
                        $status ='fa fa-remove';

                    $status_url = route('status-town',encrypt($row->id));
                    $btn = '<a href="'.$status_url.'"><i class="'.$status.'"></i></a>';

                    return $btn;
                })
             
                
                //->addColumn('edit', 'dealers.actionsEdit')
                //->addColumn('activation', 'dealers.actionsStatus')
                ->rawColumns(['edit', 'activation'])
                ->make(true);
        }

        return view('adminpanel.town.list');
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
                'name' => 'required|max:50',                
                'status' => 'required',
                'provinceID' => 'required',
                'districtID' => 'required',
                
            ]);
        } else {
            $request->validate([
                'name' => 'required|max:50',
                'status' => 'required',
                'provinceID' => 'required',
                'districtID' => 'required',
                
            ]);
        }
        
        $data_arry = array();
        $data_arry['city_name_en'] = $request->name;
        $data_arry['status'] = $request->status; 
        $data_arry['province_id'] = $request->provinceID;
        $data_arry['district_id'] = $request->districtID;
        
              
        if($request->savestatus == 'A'){
                       
            $id= City::create($data_arry);
             \LogActivity::addToLog('New town'.$request->name.' added('.$id->id.').');
            return redirect('new-town')->with('success', 'New town created successfully');
        }else{
            
            $recid = $request->id;
            
            City::where('id', decrypt($recid))->update($data_arry);
            \LogActivity::addToLog('town ' . $request->name . ' updated(' . decrypt($recid) . ').');
            return redirect('/edit-town/'.$recid.'')->with('success', 'town updated successfully');
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
        $ID = decrypt($id);
        $info = City::where('id', '=', $ID)->get();
        $title = 'Edit';
        $province =Province::select('*')->where('status','Y')->where('is_delete',  0)->orderBy('province_name_en','ASC')->get();
        $District =District::select('*')->where('status','Y')->where('is_delete',  0)->orderBy('district_name_en','ASC')->get();
        
        $savestatus = 'E';
        return view('adminpanel.town.index')->with('info',$info)->with('savestatus',$savestatus)->with('title',$title)->with('province',$province)->with('District',$District);
        //return view('masterdata.complain_category.edit', ['data' => $data]);
        //return view('masterdata.complain_category.edit');
    }
    
    
    public function activation(Request $request)
    {
        $idD = decrypt($request->id);

        $data =  City::find($idD);

        if ( $data->status == "Y" ) {

            $data->status = 'N';
            $data->save();
            $id = $data->id;

            \LogActivity::addToLog('town record '.$data->district_name_en.' deactivated('.$id.')');

            return redirect()->route('town-list')
            ->with('success', 'Record deactivate successfully.');

        } else {

            $data->status = "Y";
            $data->save();
            $id = $data->id;

            \LogActivity::addToLog('town record '.$data->district_name_en.' activated('.$id.')');

            return redirect()->route('town-list')
            ->with('success', 'Record activate successfully.');
        }

    }
    
     public function get_region_territories(Request $request)
    {
        $provinceID =  $request->provinceID;
        $territories['data'] = District::select('*')->where("province_id", $provinceID)->where('is_delete',  0)->orderBy('district_name_en','ASC')->get();
        return response()->json($territories);
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
    

}
