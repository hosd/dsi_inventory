<?php

namespace App\Http\Controllers\masterdata;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Hash;
use App\Models\Vmodel;
use App\Models\Make;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ModelContoller extends Controller
{
    function __construct()
    {

        $this->middleware('permission:model-list|model-create|model-edit|model-delete', ['only' => ['datalist']]);
        $this->middleware('permission:model-create', ['only' => ['index', 'store']]);
        $this->middleware('permission:model-edit', ['only' => ['edit', 'update','activation']]);
        $this->middleware('permission:model-list', ['only' => ['datalist']]);
        $this->middleware('permission:model-list|model-create|model-edit|model-delete', ['only' => ['datalist']]);
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
        $make = Make::select('*')->where('status','Y')->where('is_delete',  0)->orderBy('name','ASC')->get();
        
        return view('adminpanel.model.index')->with('savestatus',$savestatus)->with('title',$title)->with('make',$make);
    }

     public function datalist(Request $request)
    {
        if ($request->ajax()) {
            $data = Vmodel::join('make', 'model.makeID', '=', 'make.id')
                    ->select('model.*','make.name as make')
                    ->where('model.is_delete',  0)
                    ->orderBy('model.name','ASC')
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

                   $edit_url = route('edit-model',encrypt($row->id));
                    $btn = '<a href="' . $edit_url . '"><i class="fa fa-edit"></i></a>';
                    return $btn;
                }) 
                
                ->addColumn('activation', function($row){
                    if ( $row->status == "Y" )
                        $status ='fa fa-check';
                    else
                        $status ='fa fa-remove';

                    $status_url = route('status-model',encrypt($row->id));
                    $btn = '<a href="'.$status_url.'"><i class="'.$status.'"></i></a>';

                    return $btn;
                })
             
                
                //->addColumn('edit', 'dealers.actionsEdit')
                //->addColumn('activation', 'dealers.actionsStatus')
                ->rawColumns(['edit', 'activation'])
                ->make(true);
        }

        return view('adminpanel.model.list');
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
                'makeID' => 'required',
                
            ]);
        } else {
            $request->validate([
                'name' => 'required|max:50',
                'status' => 'required',
                'makeID' => 'required',
                
            ]);
        }
        
        $data_arry = array();
        $data_arry['name'] = $request->name;
        $data_arry['status'] = $request->status; 
        $data_arry['makeID'] = $request->makeID;
        
              
        if($request->savestatus == 'A'){
                       
            $id= Vmodel::create($data_arry);
             \LogActivity::addToLog('New model'.$request->name.' added('.$id->id.').');
            return redirect('new-model')->with('success', 'New model created successfully');
        }else{
            
            $recid = $request->id;
            
            Vmodel::where('id', decrypt($recid))->update($data_arry);
            \LogActivity::addToLog('model ' . $request->name . ' updated(' . decrypt($recid) . ').');
            return redirect('/edit-model/'.$recid.'')->with('success', 'model updated successfully');
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
        $info = Vmodel::where('id', '=', $ID)->get();
        $title = 'Edit';        
        $savestatus = 'E';
        $make = Make::select('*')->where('status','Y')->where('is_delete',  0)->orderBy('name','ASC')->get();
        
        return view('adminpanel.model.index')->with('info',$info)->with('savestatus',$savestatus)->with('title',$title)->with('make',$make);;
        //return view('masterdata.complain_model.edit', ['data' => $data]);
        //return view('masterdata.complain_model.edit');
    }
    
    
    public function activation(Request $request)
    {
        $idD = decrypt($request->id);

        $data =  Vmodel::find($idD);

        if ( $data->status == "Y" ) {

            $data->status = 'N';
            $data->save();
            $id = $data->id;

            \LogActivity::addToLog('model record '.$data->province_name_en.' deactivated('.$id.')');

            return redirect()->route('model-list')
            ->with('success', 'Record deactivate successfully.');

        } else {

            $data->status = "Y";
            $data->save();
            $id = $data->id;

            \LogActivity::addToLog('model record '.$data->province_name_en.' activated('.$id.')');

            return redirect()->route('model-list')
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
