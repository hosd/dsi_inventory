<?php

namespace App\Http\Controllers\masterdata;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Hash;
use App\Models\Tyresizemodel;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TyresizeContoller extends Controller
{
    function __construct()
    {

        $this->middleware('permission:tyresize-list|tyresize-create|tyresize-edit|tyresize-delete', ['only' => ['datalist']]);
        $this->middleware('permission:tyresize-create', ['only' => ['index', 'store']]);
        $this->middleware('permission:tyresize-edit', ['only' => ['edit', 'update','activation']]);
        $this->middleware('permission:tyresize-list', ['only' => ['datalist']]);
        $this->middleware('permission:tyresize-list|tyresize-create|tyresize-edit|tyresize-delete', ['only' => ['datalist']]);
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
        
        return view('adminpanel.tyresize.index')->with('savestatus',$savestatus)->with('title',$title);
    }

     public function datalist(Request $request)
    {
        if ($request->ajax()) {
            $data = Tyresizemodel::select('*')
                    ->where('is_delete',  0)
                    ->orderBy('id','ASC')
                    ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function($row){
                if($row->status == 'Y'){
                $btn = 'Active';}
                else{  $btn = 'Inactive';}
                 return $btn;
            })  
            ->addColumn('name', function($row){
                $btn = $row->width.' / '.$row->profile.' x '.$row->rim;
                 return $btn;
            })
                    ->addColumn('edit', function ($row) {

                   $edit_url = route('edit-tyresize',encrypt($row->id));
                    $btn = '<a href="' . $edit_url . '"><i class="fa fa-edit"></i></a>';
                    return $btn;
                }) 
                
                ->addColumn('activation', function($row){
                    if ( $row->status == "Y" )
                        $status ='fa fa-check';
                    else
                        $status ='fa fa-remove';

                    $status_url = route('status-tyresize',encrypt($row->id));
                    $btn = '<a href="'.$status_url.'"><i class="'.$status.'"></i></a>';

                    return $btn;
                })
             
                
                //->addColumn('edit', 'dealers.actionsEdit')
                //->addColumn('activation', 'dealers.actionsStatus')
                ->rawColumns(['edit', 'activation'])
                ->make(true);
        }

        return view('adminpanel.tyresize.list');
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
                'width' => 'required|max:50',  
                'profile' => 'required|max:50',
                'rim' => 'required|max:50',
                'status' => 'required',
                
            ]);
        } else {
            $request->validate([
                'width' => 'required|max:50',  
                'profile' => 'required|max:50',
                'rim' => 'required|max:50',
                'status' => 'required',
                
            ]);
        }
        
        $data_arry = array();
        $data_arry['width'] = $request->width;
        $data_arry['profile'] = $request->profile;
        $data_arry['rim'] = $request->rim;        
        $data_arry['status'] = $request->status; 
        
              
        if($request->savestatus == 'A'){
                       
            $id= Tyresizemodel::create($data_arry);
             \LogActivity::addToLog('New tyresize'.$request->width.'.'.$request->profile.'.'.$request->rim.' added('.$id->id.').');
            return redirect('new-tyresize')->with('success', 'New tyresize created successfully');
        }else{
            
            $recid = $request->id;
            
            Tyresizemodel::where('id', decrypt($recid))->update($data_arry);
            \LogActivity::addToLog('tyresize ' . $request->width.'.'.$request->profile.'.'.$request->rim . ' updated(' . decrypt($recid) . ').');
            return redirect('/edit-tyresize/'.$recid.'')->with('success', 'tyresize updated successfully');
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
        $info = Tyresizemodel::where('id', '=', $ID)->get();
        $title = 'Edit';
        
        $savestatus = 'E';
        return view('adminpanel.tyresize.index')->with('info',$info)->with('savestatus',$savestatus)->with('title',$title);
        //return view('masterdata.complain_tyresize.edit', ['data' => $data]);
        //return view('masterdata.complain_tyresize.edit');
    }
    
    
    public function activation(Request $request)
    {
        $idD = decrypt($request->id);

        $data =  Tyresizemodel::find($idD);

        if ( $data->status == "Y" ) {

            $data->status = 'N';
            $data->save();
            $id = $data->id;

            \LogActivity::addToLog('tyresize record '.$data->province_name_en.' deactivated('.$id.')');

            return redirect()->route('tyresize-list')
            ->with('success', 'Record deactivate successfully.');

        } else {

            $data->status = "Y";
            $data->save();
            $id = $data->id;

            \LogActivity::addToLog('tyresize record '.$data->province_name_en.' activated('.$id.')');

            return redirect()->route('tyresize-list')
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
