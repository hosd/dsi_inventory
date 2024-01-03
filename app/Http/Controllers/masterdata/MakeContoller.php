<?php

namespace App\Http\Controllers\masterdata;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Hash;
use App\Models\Make;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MakeContoller extends Controller
{
    function __construct()
    {

        $this->middleware('permission:make-list|make-create|make-edit|make-delete', ['only' => ['datalist']]);
        $this->middleware('permission:make-create', ['only' => ['index', 'store']]);
        $this->middleware('permission:make-edit', ['only' => ['edit', 'update','activation']]);
        $this->middleware('permission:make-list', ['only' => ['datalist']]);
        $this->middleware('permission:make-list|make-create|make-edit|make-delete', ['only' => ['datalist']]);
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
        
        return view('adminpanel.make.index')->with('savestatus',$savestatus)->with('title',$title);
    }

     public function datalist(Request $request)
    {
        if ($request->ajax()) {
            $data = Make::select('*')
                    ->where('is_delete',  0)
                    ->orderBy('name','ASC')
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

                   $edit_url = route('edit-make',encrypt($row->id));
                    $btn = '<a href="' . $edit_url . '"><i class="fa fa-edit"></i></a>';
                    return $btn;
                }) 
                
                ->addColumn('activation', function($row){
                    if ( $row->status == "Y" )
                        $status ='fa fa-check';
                    else
                        $status ='fa fa-remove';

                    $status_url = route('status-make',encrypt($row->id));
                    $btn = '<a href="'.$status_url.'"><i class="'.$status.'"></i></a>';

                    return $btn;
                })
             
                
                //->addColumn('edit', 'dealers.actionsEdit')
                //->addColumn('activation', 'dealers.actionsStatus')
                ->rawColumns(['edit', 'activation'])
                ->make(true);
        }

        return view('adminpanel.make.list');
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
                
            ]);
        } else {
            $request->validate([
                'name' => 'required|max:50',
                'status' => 'required',
                
            ]);
        }
        
        $data_arry = array();
        $data_arry['name'] = $request->name;
        $data_arry['status'] = $request->status; 
        
              
        if($request->savestatus == 'A'){
                       
            $id= Make::create($data_arry);
             \LogActivity::addToLog('New make'.$request->name.' added('.$id->id.').');
            return redirect('new-make')->with('success', 'New make created successfully');
        }else{
            
            $recid = $request->id;
            
            Make::where('id', decrypt($recid))->update($data_arry);
            \LogActivity::addToLog('make ' . $request->name . ' updated(' . decrypt($recid) . ').');
            return redirect('/edit-make/'.$recid.'')->with('success', 'make updated successfully');
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
        $info = Make::where('id', '=', $ID)->get();
        $title = 'Edit';
        
        $savestatus = 'E';
        return view('adminpanel.make.index')->with('info',$info)->with('savestatus',$savestatus)->with('title',$title);
        //return view('masterdata.complain_make.edit', ['data' => $data]);
        //return view('masterdata.complain_make.edit');
    }
    
    
    public function activation(Request $request)
    {
        $idD = decrypt($request->id);

        $data =  Make::find($idD);

        if ( $data->status == "Y" ) {

            $data->status = 'N';
            $data->save();
            $id = $data->id;

            \LogActivity::addToLog('make record '.$data->province_name_en.' deactivated('.$id.')');

            return redirect()->route('make-list')
            ->with('success', 'Record deactivate successfully.');

        } else {

            $data->status = "Y";
            $data->save();
            $id = $data->id;

            \LogActivity::addToLog('make record '.$data->province_name_en.' activated('.$id.')');

            return redirect()->route('make-list')
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
