<?php

namespace App\Http\Controllers\masterdata;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Hash;
use App\Models\Bankmodal;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BankContoller extends Controller
{
    function __construct()
    {

        $this->middleware('permission:bank-list|bank-create|bank-edit|bank-delete', ['only' => ['datalist']]);
        $this->middleware('permission:bank-create', ['only' => ['index', 'store']]);
        $this->middleware('permission:bank-edit', ['only' => ['edit', 'update','activation']]);
        $this->middleware('permission:bank-list', ['only' => ['datalist']]);
        $this->middleware('permission:bank-list|bank-create|bank-edit|bank-delete', ['only' => ['datalist']]);
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
        
        return view('adminpanel.bank.index')->with('savestatus',$savestatus)->with('title',$title);
    }

     public function datalist(Request $request)
    {
        if ($request->ajax()) {
            $data = Bankmodal::select('*')
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

                   $edit_url = route('edit-bank',encrypt($row->id));
                    $btn = '<a href="' . $edit_url . '"><i class="fa fa-edit"></i></a>';
                    return $btn;
                }) 
                
                ->addColumn('activation', function($row){
                    if ( $row->status == "Y" )
                        $status ='fa fa-check';
                    else
                        $status ='fa fa-remove';

                    $status_url = route('status-bank',encrypt($row->id));
                    $btn = '<a href="'.$status_url.'"><i class="'.$status.'"></i></a>';

                    return $btn;
                })
             
                
                //->addColumn('edit', 'dealers.actionsEdit')
                //->addColumn('activation', 'dealers.actionsStatus')
                ->rawColumns(['edit', 'activation'])
                ->make(true);
        }

        return view('adminpanel.bank.list');
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
     
        /*if ($request->hasFile('vlogo')) {                

                // Save the file locally in the storage/public/ folder under a new folder named /product
                $dte=date("ymdHms");                 
                //$path = $file->store('public/images');
                $file1 =$request->file('vlogo');
                
                $name1 = $file1->getClientOriginalName();
                $extension1 = $file1->getClientOriginalExtension();
                $fileSaveName1=str_replace(' ', '_',$dte.$name1);
                $fullpath = $fileSaveName1 . '.' . $extension1 ; // adding full path
                $file1->move('images', $fileSaveName1);
                //var_dump($fileSaveName1); die();
                $data_arry['vlogo'] =$fileSaveName1; 
                // Store the record, using the new file hashname which will be it's new filename identity.
            }*/
             
        $data_arry['name'] = $request->name;
        $data_arry['status'] = $request->status; 
        
              
        if($request->savestatus == 'A'){
                       
            $id= Bankmodal::create($data_arry);
             \LogActivity::addToLog('New bank'.$request->name.' added('.$id->id.').');
            return redirect('new-bank')->with('success', 'New bank created successfully');
        }else{
            
            $recid = $request->id;
            
            Bankmodal::where('id', decrypt($recid))->update($data_arry);
            \LogActivity::addToLog('bank ' . $request->name . ' updated(' . decrypt($recid) . ').');
            return redirect('/edit-bank/'.$recid.'')->with('success', 'bank updated successfully');
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
        $info = Bankmodal::where('id', '=', $ID)->get();
        $title = 'Edit';
        
        $savestatus = 'E';
        return view('adminpanel.bank.index')->with('info',$info)->with('savestatus',$savestatus)->with('title',$title);
        //return view('complain_bank.edit', ['data' => $data]);
        //return view('complain_bank.edit');
    }
    
    
    public function activation(Request $request)
    {
        $idD = decrypt($request->id);

        $data =  Bankmodal::find($idD);

        if ( $data->status == "Y" ) {

            $data->status = 'N';
            $data->save();
            $id = $data->id;

            \LogActivity::addToLog('bank record '.$data->name.' deactivated('.$id.')');

            return redirect()->route('bank-list')
            ->with('success', 'Record deactivate successfully.');

        } else {

            $data->status = "Y";
            $data->save();
            $id = $data->id;

            \LogActivity::addToLog('bank record '.$data->name.' activated('.$id.')');

            return redirect()->route('bank-list')
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
