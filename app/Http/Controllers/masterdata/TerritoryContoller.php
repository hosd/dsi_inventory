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

class TerritoryContoller extends Controller
{
    function __construct()
    {

        $this->middleware('permission:territory-list|territory-create|territory-edit|territory-delete', ['only' => ['datalist']]);
        $this->middleware('permission:territory-create', ['only' => ['index', 'store']]);
        $this->middleware('permission:territory-edit', ['only' => ['edit', 'update','activation']]);
        $this->middleware('permission:territory-list', ['only' => ['datalist']]);
        $this->middleware('permission:territory-list|territory-create|territory-edit|territory-delete', ['only' => ['datalist']]);
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
        return view('adminpanel.territory.index')->with('savestatus',$savestatus)->with('title',$title)->with('province',$province);
    }

     public function datalist(Request $request)
    {
        if ($request->ajax()) {
            $data = District::join('provinces', 'districts.province_id', '=', 'provinces.id')
                    ->where('districts.is_delete',  0)
                    ->select('districts.*','provinces.province_name_en')
                    ->orderBy('district_name_en','ASC')
                    ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function($row){
                if($row->status == 'Y'){
                $btn = 'Active';}
                else{  $btn = 'Inactive';}
                 return $btn;
            })  
                    ->addColumn('edit', function ($row) {

                   $edit_url = route('edit-territory',encrypt($row->id));
                    $btn = '<a href="' . $edit_url . '"><i class="fa fa-edit"></i></a>';
                    return $btn;
                }) 
                
                ->addColumn('activation', function($row){
                    if ( $row->status == "Y" )
                        $status ='fa fa-check';
                    else
                        $status ='fa fa-remove';

                    $status_url = route('status-territory',encrypt($row->id));
                    $btn = '<a href="'.$status_url.'"><i class="'.$status.'"></i></a>';

                    return $btn;
                })
             
                
                //->addColumn('edit', 'dealers.actionsEdit')
                //->addColumn('activation', 'dealers.actionsStatus')
                ->rawColumns(['edit', 'activation'])
                ->make(true);
        }

        return view('adminpanel.territory.list');
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
                
            ]);
        } else {
            $request->validate([
                'name' => 'required|max:50',
                'status' => 'required',
                'provinceID' => 'required',
                
            ]);
        }
        
        $data_arry = array();
        $data_arry['district_name_en'] = $request->name;
        $data_arry['status'] = $request->status; 
        $data_arry['province_id'] = $request->provinceID;
        
              
        if($request->savestatus == 'A'){
                       
            $id= District::create($data_arry);
             \LogActivity::addToLog('New territory'.$request->name.' added('.$id->id.').');
            return redirect('new-territory')->with('success', 'New territory created successfully');
        }else{
            
            $recid = $request->id;
            
            District::where('id', decrypt($recid))->update($data_arry);
            \LogActivity::addToLog('territory ' . $request->name . ' updated(' . decrypt($recid) . ').');
            return redirect('/edit-territory/'.$recid.'')->with('success', 'territory updated successfully');
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
        $info = District::where('id', '=', $ID)->get();
        $title = 'New';
        $province =Province::select('*')->where('status','Y')->where('is_delete',  0)->orderBy('province_name_en','ASC')->get();
        
        $savestatus = 'E';
        return view('adminpanel.territory.index')->with('info',$info)->with('savestatus',$savestatus)->with('title',$title)->with('province',$province);
        //return view('masterdata.complain_category.edit', ['data' => $data]);
        //return view('masterdata.complain_category.edit');
    }
    
    
    public function activation(Request $request)
    {
        $idD = decrypt($request->id);

        $data =  District::find($idD);

        if ( $data->status == "Y" ) {

            $data->status = 'N';
            $data->save();
            $id = $data->id;

            \LogActivity::addToLog('territory record '.$data->district_name_en.' deactivated('.$id.')');

            return redirect()->route('territory-list')
            ->with('success', 'Record deactivate successfully.');

        } else {

            $data->status = "Y";
            $data->save();
            $id = $data->id;

            \LogActivity::addToLog('territory record '.$data->district_name_en.' activated('.$id.')');

            return redirect()->route('territory-list')
            ->with('success', 'Record activate successfully.');
        }

    }
    
     public function get_state_cities(Request $request)
    {
        $districtID =  $request->districtID;
        $city['data'] = City::select('*')->where("district_id", $districtID)->orderBy('city_name_en','ASC')->get();
        return response()->json($city);
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
