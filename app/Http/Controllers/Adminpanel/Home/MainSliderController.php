<?php

namespace App\Http\Controllers\Adminpanel\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MainSlider;

class MainSliderController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:main-slider-list|main-slider-create|main-slider-edit|main-slider-delete', ['only' => ['list']]);
        $this->middleware('permission:main-slider-create', ['only' => ['index', 'store']]);
        $this->middleware('permission:main-slider-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:main-slider-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $mainslider = MainSlider::where('status', 'Y')->where('is_delete', 0)->get();

        return view('adminpanel.home.mainslider.index', compact('mainslider'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'heading_1_en' => 'required',
            'heading_2_en' => 'required',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);      

        $data = new MainSlider();
        $data->heading_1_en = $request->heading_1_en;
        $data->heading_1_si = $request->heading_1_si;
        $data->heading_1_ta = $request->heading_1_ta;
        $data->heading_2_en = $request->heading_2_en;
        $data->heading_2_si = $request->heading_2_si;
        $data->heading_2_ta = $request->heading_2_ta;
        $data->caption_en = $request->caption_en;
        $data->caption_si = $request->caption_si;
        $data->caption_ta = $request->caption_ta;
        $data->url = $request->url;
        $data->status = $request->status;        

        // ensure the request has a file before we attempt anything else.
        if ($request->hasFile('file')) {
            $request->validate([
                'image' => 'mimes:jpeg,jpg,png' // Only allow .jpg, .bmp and .png file types.
            ]);

            // Save the file locally in the storage/public/ folder under a new folder named /product
            $request->store('public/main_slider');
            
            $data->image = $file->hashName();
            // Store the record, using the new file hashname which will be it's new filename identity.
        }

        $data->save();

        \LogActivity::addToLog('New Slider '.$request->heading_1_en.' added.');

        return redirect()->route('main-slider')
            ->with('success', 'Record created successfully.');
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $data = MainSlider::select('*')->where('is_delete',0);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('edit', function ($row) {
                    $edit_url = url('/edit-main-slider/' . encrypt($row->id) . '');
                    $btn = '<a href="' . $edit_url . '"><i class="fa fa-edit"></i></a>';
                    return $btn;
                })
                ->addColumn('activation', function($row){
                    if ( $row->status == "Y" )
                        $status ='fa fa-check';
                    else
                        $status ='fa fa-remove';

                    $btn = '<a href="changestatus-mainslider/'.$row->id.'/'.$row->cEnable.'"><i class="'.$status.'"></i></a>';

                    return $btn;
                })
                // ->addColumn('blockprovince', function($row){
                //     if ( $row->status == "1" )
                //         $dltstatus ='fa fa-ban';
                //     else
                //         $dltstatus ='fa fa-trash';

                //     $btn = '<button class="btn-delete" value="'.$row->id.'"><i class="'.$dltstatus.'"></i></button>';


                //     return $btn;
                // })
                ->addColumn('blockmainslider', 'adminpanel.home.mainslider.actionsBlock')
                ->rawColumns(['edit', 'activation', 'blockmainslider'])
                ->make(true);
        }

        return view('adminpanel.home.mainslider.list');
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
        //
        $mainSliderID = decrypt($id);
        $data = MainSlider::find($mainSliderID);
        return view('adminpanel.home.mainslider.edit', ['data' => $data]);
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
        $request->validate([
            'heading_1_en' => 'required',
            'heading_2_en' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:6144'
        ]);

        $data =  MainSlider::find($request->id);
        $data->heading_1_en = $request->heading_1_en;
        $data->heading_1_si = $request->heading_1_si;
        $data->heading_1_ta = $request->heading_1_ta;
        $data->heading_2_en = $request->heading_2_en;
        $data->heading_2_si = $request->heading_2_si;
        $data->heading_2_ta = $request->heading_2_ta;
        $data->caption_en = $request->caption_en;
        $data->caption_si = $request->caption_si;
        $data->caption_ta = $request->caption_ta;
        $data->url = $request->url;
        $data->status = $request->status;
        // ensure the request has a file before we attempt anything else.
        if ($request->hasFile('file')) {
            $request->validate([
                'image' => 'mimes:jpeg,jpg,png' // Only allow .jpg, .bmp and .png file types.
            ]);

            // Save the file locally in the storage/public/ folder under a new folder named /product
            $file->store('public/main_slider');
            
            $data->image =  $file->hashName();
            // Store the record, using the new file hashname which will be it's new filename identity.
        }

        $data->save();
        $id = $data->id;

        \LogActivity::addToLog('Main Slider record '.$data->heading_1_en.' updated('.$id.').');

        return redirect()->route('main-slider-list')
            ->with('success', 'Record updated successfully.');
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

    public function activation(Request $request)
    {
        $request->validate([
            // 'status' => 'required'
        ]);

        $data =  MainSlider::find($request->id);

        if ( $data->status == "Y" ) {

            $data->status = 'N';
            $data->save();
            $id = $data->id;

            \LogActivity::addToLog('Main Slider record '.$data->heading_1_en.' deactivated('.$id.').');

            return redirect()->route('main-slider-list')
            ->with('success', 'Record deactivate successfully.');

        } else {

            $data->status = "Y";
            $data->save();
            $id = $data->id;

            \LogActivity::addToLog('Main Slider record '.$data->heading_1_en.' activated('.$id.').');

            return redirect()->route('main-slider-list')
            ->with('success', 'Record activate successfully.');
        }

    }

    public function block(Request $request)
    {
        $request->validate([
            // 'status' => 'required'
        ]);

        $data =  MainSlider::find($request->id);
        $data->is_delete = 1;
        $data->save();
        $id = $data->id;

        \LogActivity::addToLog('Main Slider record '.$data->heading_1_en.' deleted('.$id.').');

        return redirect()->route('main-slider-list')
            ->with('success', 'Record deleted successfully.');
    }
}
