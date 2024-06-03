<?php

namespace App\Http\Controllers\Frontend_dealer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use App\Models\ProductCategory;
use App\Models\Productmodel;
use App\Models\Dealer_stock;
use App\Models\User;
use App\Models\Dealeruser;
use App\Models\Dealers;
use Illuminate\Validation\Rule;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DealerCommission;
use Illuminate\Support\Facades\Session;
use App\Models\DealerSessionModel;

class DealerloginContoller extends Controller {

    function __construct() {
        
    }

    public function index() {
        $savestatus = 'A';
        $title = 'New';

        return view('frontend_dealer.profile')->with('savestatus', $savestatus)->with('title', $title);
    }

    public function showLoginForm() {
        return view('frontend_dealer.login');
    }

    public function dashboard() {
        $count = Dealer_stock::join('product_category', 'dealer_stock.categoryID', '=', 'product_category.id')
                ->join('product', 'dealer_stock.productcode', '=', 'product.productcode')
                ->select('dealer_stock.*', 'product_category.name AS category', 'product.productcode as procode', 'product.id as proid')
                ->where('dealer_stock.dealerID', auth()->user()->dealerID)
                ->whereRaw('dealer_stock.quantity < dealer_stock.reorder_quantity')
                ->orderBy('product.productcode', 'ASC')
                ->get();
        $token = $this->generatedToken();
        $delaerID = auth()->user()->dealerID;
        //$delaerID = 1;
        $status = 'pending';

        $apidata = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $token,
                ])->post('https://dsityreshop.com/api/get-pickup-orders?status=' . $status . '&dealerID=' . $delaerID);

        $resultdata = $apidata->json();

        if (isset($resultdata['orderList']) && is_array($resultdata['orderList'])) {
            $pendingout = count($resultdata['orderList']);
        } else {
            $pendingout = 0;
        }

        $monthly_total = 0;

        $resultdata = array();
        $dealer_id = auth()->user()->dealerID;
        $ordered_from = Carbon::now()->firstOfMonth()->format('Y-m-d 00:00:00');
        $ordered_to = Carbon::now()->endOfMonth()->format('Y-m-d 23:59:59');

        if($dealer_id){
            $token = $this->generatedToken();
            $apidata = Http::withHeaders([
                        'Authorization' => 'Bearer ' . $token,
                    ])->post('https://dsityreshop.com/api/get-completed-dealer-orders?dealer_id=' . $dealer_id . '&ordered_from=' . $ordered_from. '&ordered_to=' . $ordered_to);

            $resultdata = $apidata->json();
        }
        
        if (empty($resultdata['orderList'])) {
            $monthly_total = 0;
        } else {
            foreach ($resultdata['orderList'] as $key => $row) {
                $monthly_total = $monthly_total + ($row['quantity'] * $row['dealer_charge']);
            }
        }

        return view('frontend_dealer.dashboard')->with(['count' => $count, 'pendingout' => $pendingout, 'monthly_total' => $monthly_total]);
    }

    public function login(Request $request) {

        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'g-recaptcha-response' => 'required|recaptcha',
        ], [
            'g-recaptcha-response.recaptcha' => 'Captcha validation failed. Please try again.',
        ]);
    
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
    
        if (Auth::guard('dealer')->attempt($credentials)) {
            $user = Auth::guard('dealer')->user();
            $request->session()->regenerate();
            if ($user->status == "Y") {
                // Check if the user's role is either 2 or 3
                if ($user->roleID === 2 || $user->roleID === 3) {
                    if ($user) {

                        // Retrieve the user's stored session IDs from the database
                        $storedSessionIds = DealerSessionModel::where('dealer_id', $user->id)->pluck('session_id');

                        // Get the current session ID
                        $currentSessionId = $request->session()->getId();

                        // Delete old session records except for the current session
                        DealerSessionModel::where('dealer_id', $user->id)
                                    ->whereNotIn('session_id', [$currentSessionId])
                                    ->delete();

                        // Update or create a new session record for the current session
                        DealerSessionModel::updateOrCreate(['dealer_id' => $user->id], ['session_id' => $currentSessionId]);

                        // Store user data in the session
                        $request->session()->put('dealer_data', [
                            'id' => $user->id,
                            'name' => $user->name,
                            'email' => $user->email,
                            'mobile_no' => $user->mobile_no,
                            'status' => $user->status,
                            'dealerID' => $user->dealerID,
                            'roleID' => $user->roleID,
                            // Add other attributes you want to store
                        ]);
                    }
                    return redirect()->intended('dealer/dashboard');
                } else {
                    // Redirect if role is not 2 or 3
                    return back()->withErrors([
                        'email' => 'Unauthorized access.',
                    ]);
                }
            } else {
                // User's status is not "Y"
                Auth::guard('dealer')->logout();
                return back()->withErrors([
                    'email' => 'Your account is inactive.',
                ]);
            }
        }
    
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }    

    public function logout(Request $request) {
        
        DealerSessionModel::where('dealer_id', session('dealer_data.id'))->delete();

        Auth::guard('dealer')->logout();

        // $request->session()->invalidate();

        // $request->session()->regenerateToken();

        return redirect('dealer-login');
    }

    public function stock_list(Request $request) {
        $savestatus = 'A';
        $category = ProductCategory::where([['status', '=', 'Y'],['is_delete', '=', 0],])->whereNotIn('id', [1, 5])->orderBy('name', 'ASC')->get();
        $product = Productmodel::select('*')->orderBy('name', 'ASC')->get();
        //$count = Productmodel::select('*')->get();
        if ($request->ajax()) {
            // DB::enableQueryLog();
            $data = Dealer_stock::join('product_category', 'dealer_stock.categoryID', '=', 'product_category.id')
                    ->join('product', 'dealer_stock.productcode', '=', 'product.productcode')
                    ->select('dealer_stock.*', 'product_category.name AS category', 'product.productcode as procode', 'product.id as proid', 'product.label_name')
                    ->where('dealer_stock.dealerID', auth()->user()->dealerID)
                    //->orderBy('product.productcode', 'ASC')
                    ->orderByRaw('CASE WHEN dealer_stock.quantity < dealer_stock.reorder_quantity THEN 0 ELSE 1 END, product.productcode ASC')
                    ->get();
            //dd(\DB::getQueryLog());
            return Datatables::of($data)
                            ->addIndexColumn()
                            ->addColumn('status', function ($row) {
                                if ($row->status == 1) {
                                    $btn = 'Active';
                                } else {
                                    $btn = 'Inactive';
                                }
                                return $btn;
                            })
                            ->addColumn('edit', function ($row) {

                                // $btn = '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editData"><i class="fa fa-edit"></i></button>';
                                $btn = '<button type="button" class="btn btn-primary btn-sm edit-btn" data-bs-toggle="modal" data-bs-target="#editData" data-category-id="' . $row->categoryID . '" data-quantity="' . $row->quantity . '" data-product-code="' . $row->proid . '" data-reorder-quantity="' . $row->reorder_quantity . '" data-reorder-id="' . $row->id . '"><i class="fa fa-edit"></i></button>';
                                return $btn;
                            })
                            ->addColumn('item', function ($row) {

                                // $btn = '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editData"><i class="fa fa-edit"></i></button>';
                                $btn = '<button type="button" class="btn btn-primary btn-sm item-btn" data-bs-toggle="modal" data-bs-target="#edititem" data-category-id="' . $row->categoryID . '" data-quantity="' . $row->quantity . '" data-product-code="' . $row->proid . '" data-reorder-quantity="' . $row->reorder_quantity . '" data-reorder-id="' . $row->id . '"><i class="fa fa-edit"></i></button>';
                                return $btn;
                            })
                            ->addColumn('size', function ($row) {

                                $btn = $row->width . ' / ' . $row->profile . ' x ' . $row->rim;
                                return $btn;
                            })
                            ->addColumn('name', function ($row) {
                                $name = $row->label_name;
                                if ($name) {
                                    $btn = $name;
                                } else {
                                    $btn = '';
                                }
                                return $btn;
                            })
                            ->addColumn('activation', function ($row) {
                                if ($row->status == "1")
                                    $status = 'fa fa-check';
                                else
                                    $status = 'fa fa-remove';

                                $status_url = route('status-dealer-stock', encrypt($row->id));
                                $btn = '<a href="' . $status_url . '"><i class="' . $status . '"></i></a>';

                                return $btn;
                            })


                            //->addColumn('edit', 'product.actionsEdit')
                            //->addColumn('activation', 'product.actionsStatus')
                            ->rawColumns(['edit', 'activation', 'users', 'item'])
                            ->make(true);
        }

        return view('frontend_dealer.stock_list')->with('category', $category)->with('savestatus', $savestatus)->with('product', $product);
    }

    public function reorder_stock_list(Request $request) {
        $savestatus = 'A';
        $category = ProductCategory::where([['status', '=', 'Y'],['is_delete', '=', 0],])->whereNotIn('id', [1, 5])->orderBy('name', 'ASC')->get();
        $product = Productmodel::select('*')->orderBy('name', 'ASC')->get();

        if ($request->ajax()) {
            //DB::enableQueryLog();
            $data = Dealer_stock::join('product_category', 'dealer_stock.categoryID', '=', 'product_category.id')
                    ->join('product', 'dealer_stock.productcode', '=', 'product.productcode')
                    ->select('dealer_stock.*', 'product_category.name AS category', 'product.productcode as procode', 'product.id as proid')
                    ->where('dealer_stock.dealerID', auth()->user()->dealerID)
                    ->whereRaw('dealer_stock.quantity < dealer_stock.reorder_quantity')
                    ->orderBy('product.productcode', 'ASC')
                    ->get();
            //dd(\DB::getQueryLog());
            return Datatables::of($data)
                            ->addIndexColumn()
                            ->addColumn('status', function ($row) {
                                if ($row->status == 1) {
                                    $btn = 'Active';
                                } else {
                                    $btn = 'Inactive';
                                }
                                return $btn;
                            })
                            ->addColumn('edit', function ($row) {

                                // $btn = '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editData"><i class="fa fa-edit"></i></button>';
                                $btn = '<button type="button" class="btn btn-primary btn-sm edit-btn" data-bs-toggle="modal" data-bs-target="#editData" data-category-id="' . $row->categoryID . '" data-quantity="' . $row->quantity . '" data-product-code="' . $row->proid . '" data-reorder-quantity="' . $row->reorder_quantity . '" data-reorder-id="' . $row->id . '"><i class="fa fa-edit"></i></button>';
                                return $btn;
                            })
                            ->addColumn('item', function ($row) {

                                // $btn = '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editData"><i class="fa fa-edit"></i></button>';
                                $btn = '<button type="button" class="btn btn-primary btn-sm item-btn" data-bs-toggle="modal" data-bs-target="#edititem" data-category-id="' . $row->categoryID . '" data-quantity="' . $row->quantity . '" data-product-code="' . $row->proid . '" data-reorder-quantity="' . $row->reorder_quantity . '" data-reorder-id="' . $row->id . '"><i class="fa fa-edit"></i></button>';
                                return $btn;
                            })
                            ->addColumn('size', function ($row) {

                                $btn = $row->width . ' / ' . $row->profile . ' x ' . $row->rim;
                                return $btn;
                            })
                            ->addColumn('name', function ($row) {
                                $name = $row->label_name;
                                if ($name) {
                                    $btn = $name;
                                } else {
                                    $btn = '';
                                }
                                return $btn;
                            })
                            ->addColumn('activation', function ($row) {
                                if ($row->status == "1")
                                    $status = 'fa fa-check';
                                else
                                    $status = 'fa fa-remove';

                                $status_url = route('status-dealer-stock', encrypt($row->id));
                                $btn = '<a href="' . $status_url . '"><i class="' . $status . '"></i></a>';

                                return $btn;
                            })


                            //->addColumn('edit', 'product.actionsEdit')
                            //->addColumn('activation', 'product.actionsStatus')
                            ->rawColumns(['edit', 'activation', 'users', 'item'])
                            ->make(true);
        }

        return view('frontend_dealer.reorder_stock_list')->with('category', $category)->with('savestatus', $savestatus)->with('product', $product);
    }

    public function get_product_codes(Request $request) {
        $catID = $request->cateID;

        $dealerID = auth()->user()->dealerID;
        //DB::enableQueryLog();
        $products['data'] = Productmodel::select('*')
                ->where("product_category", $catID)
                ->where('status', 1)
                ->where('product_subcategory', '!=', 12)
                ->whereNotIn('productcode', function ($query)use ($dealerID) {
                    $query->select('productcode')
                    ->from('dealer_stock')
                    ->where('dealerID', $dealerID);
                })
                ->orderBy('productcode', 'ASC')
                ->get();
        // dd(\DB::getQueryLog());
        return response()->json($products);
    }

    public function store(Request $request) {
        //var_dump($request->productcode); die();
        if ($request->savestatus == 'A') {
            $request->validate([
                'categoryID' => 'required',
                'productcode' => 'required',
                'quantity' => 'required|max_digits:5|numeric',
                'reorder_quantity' => 'required|max_digits:5|numeric',
            ]);

            $data_arry = array();
            $data_arry['categoryID'] = $request->categoryID;
            $data_arry['productcode'] = $request->productcode;
            $data_arry['quantity'] = $request->quantity;
            $data_arry['reorder_quantity'] = $request->reorder_quantity;
            $data_arry['dealerID'] = $request->dealerID;
            $data_arry['userID'] = auth()->user()->id;
            $data_arry['status'] = 1;
        } elseif ($request->savestatus == 'E') {
            $request->validate([
                'quantityedit' => 'required|max_digits:5|numeric',
                'reorder_quantity_edit' => 'required|max_digits:5|numeric',
            ]);

            $data_arry = array();
            $data_arry['quantity'] = $request->quantityedit;
            $data_arry['reorder_quantity'] = $request->reorder_quantity_edit;
            // $data_arry['dealerID'] = $request->dealerID;
            //$data_arry['userID'] = auth()->user()->id;    
        } else {
            $request->validate([
                'categoryIDitem' => 'required',
                'productcode_item' => 'required',
            ]);

            $data_arry = array();

            $data_arry['categoryID'] = $request->categoryIDitem;
            $data_arry['productcode'] = $request->productcode_item;
        }

        if ($request->savestatus == 'A') {

            $id = Dealer_stock::create($data_arry);

            \LogActivity::addToLog('New dealerstock product: ' . $request->productcode . ' added. dealer : ' . $request->dealerID . '. Rec_id :' . $id->id . '.');
            return redirect('dealer/dealer-stock-list')->with('success', 'New stock created successfully');
        } elseif ($request->savestatus == 'E') {

            $recid = $request->recIDstock;

            Dealer_stock::where('id', $recid)->update($data_arry);

            \LogActivity::addToLog('dealerstock updated record ' . $recid . ' edited_qu/re_qu ' . $request->quantityedit . '/' . $request->reorder_quantity_edit);
            return redirect('dealer/dealer-stock-list')->with('success', 'stock updated successfully');
        } else {
            $recid = $request->recIDitem;

            Dealer_stock::where('id', $recid)->update($data_arry);

            \LogActivity::addToLog('dealerstockitem updated record ' . $recid . ' cat/itemcode ' . $request->categoryIDitem . '/' . $request->productcode_item);
            return redirect('dealer/dealer-stock-list')->with('success', 'stock updated successfully');
        }
    }

    public function activation(Request $request) {
        $idD = decrypt($request->id);

        $data = Dealer_stock::find($idD);

        if ($data->status == "1") {

            $data->status = '0';
            $data->save();
            $id = $data->id;

            \LogActivity::addToLog('delaer stock deactivated(' . $id . ')');

            return redirect()->route('dealer/dealer-stock-list')
                            ->with('success', 'Record deactivate successfully.');
        } else {

            $data->status = "1";
            $data->save();
            $id = $data->id;

            \LogActivity::addToLog('delaer stock activated(' . $id . ')');

            return redirect()->route('dealer/dealer-stock-list')
                            ->with('success', 'Record activate successfully.');
        }
    }

    public function user_list(Request $request) {
        $savestatus = 'A';
        $category = ProductCategory::select('*')->where('status', 'Y')->where('is_delete', 0)->orderBy('name', 'ASC')->get();
        $product = Productmodel::select('*')->orderBy('name', 'ASC')->get();
//         $count = Productmodel::select('*')->get();
        if ($request->ajax()) {

            $data = User::join('roles', 'users.roleID', '=', 'roles.id')
                    ->select('users.*', 'roles.name AS role')
                    ->where('users.dealerID', auth()->user()->dealerID)
                    ->where('is_delete', 0)
                    ->orderBy('users.name', 'ASC')
                    ->get();
            return Datatables::of($data)
                            ->addIndexColumn()
                            ->addColumn('status', function ($row) {
                                if ($row->status == 'Y') {
                                    $btn = 'Active';
                                } else {
                                    $btn = 'Inactive';
                                }
                                return $btn;
                            })
                            ->addColumn('edit', function ($row) {

                                $edit_url = route('dealer-user-edit', encrypt($row->id));
                                $btn = '<a  class="btn btn-primary btn-sm" href="' . $edit_url . '"><i class="fa fa-edit"></i></a>';
//                    $btn = '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editData"><i class="fa fa-edit"></i></button>';
                                return $btn;
                            })
                            ->addColumn('activation', function ($row) {
                                if ($row->status == "Y")
                                    $status = 'fa fa-check';
                                else
                                    $status = 'fa fa-remove';

                                $status_url = route('dealer-user-status', encrypt($row->id));
                                $btn = '<a href="' . $status_url . '"><i class="' . $status . '"></i></a>';

                                return $btn;
                            })


                            //->addColumn('edit', 'product.actionsEdit')
                            //->addColumn('activation', 'product.actionsStatus')
                            ->rawColumns(['edit', 'activation', 'users'])
                            ->make(true);
        }

        return view('frontend_dealer.user_list')->with('category', $category)->with('savestatus', $savestatus)->with('product', $product);
    }

    public function dealer_user_status(Request $request) {
        $idD = decrypt($request->id);

        $data = User::find($idD);

        if ($data->status == "Y") {

            $data->status = 'N';
            $data->save();
            $id = $data->id;

            \LogActivity::addToLog('delaer user deactivated(' . $id . ')');

            return redirect()->route('dealer/user-list')
                            ->with('success', 'Record deactivate successfully.');
        } else {

            $data->status = "Y";
            $data->save();
            $id = $data->id;

            \LogActivity::addToLog('delaer user activated(' . $id . ')');

            return redirect()->route('dealer/user-list')
                            ->with('success', 'Record activate successfully.');
        }
    }

    public function edit_dealeruser($id) {
        $ID = decrypt($id);
        $Userinfo = User::where('id', '=', $ID)->get();
        //var_dump($Userinfo[0]->dealerID);die();
        $Dealer_ID = encrypt($Userinfo[0]->dealerID);
        $info = Dealers::where('id', '=', $Userinfo[0]->dealerID)->get();

        $savestatus = 'E';
        return view('frontend_dealer.user_edit')->with('Userinfo', $Userinfo)->with('savestatus', $savestatus)->with('info', $info)->with('Dealer_ID', $Dealer_ID);
        //return view('masterdata.complain_category.edit', ['data' => $data]);
        //return view('masterdata.complain_category.edit');
    }

    public function save_dealeruser_edit(Request $request) {
        $dealerID = $request->dealerID;
        $data_arry = array();
        if ($request->savestatus == 'A') {
            $request->validate([
                'name' => 'required|max:50',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|same:confirmpassword',
                'phone' => 'required|max:20|min:10',
            ]);

            $data_arry['name'] = $request->name;
            $data_arry['email'] = $request->email;
            $data_arry['mobile_no'] = $request->phone;
            $data_arry['dealerID'] = decrypt($request->dealerID);
            $data_arry['roleID'] = 3;
            $data_arry['password'] = Hash::make($request->password);
            $data_arry['status'] = "Y";
        } else {
            $id = decrypt($request->id);
            if ($request->password) {
                $request->validate([
                    'name' => 'required|max:50',
                    'email' => 'required|email|unique:users,email,' . $id,
                    'password' => 'same:confirmpassword',
                    'phone' => 'required|max:20|min:10'
                        //'status' => 'required'
                ]);

                $data_arry['name'] = $request->name;
                $data_arry['email'] = $request->email;
                $data_arry['mobile_no'] = $request->phone;
                $data_arry['dealerID'] = decrypt($request->dealerID);
                $data_arry['roleID'] = 3;
                $data_arry['password'] = Hash::make($request->password);
                //$data_arry['status'] = $request->status;
            } else {
                $request->validate([
                    'name' => 'required|max:50',
                    'email' => 'required|email|unique:users,email,' . $id,
                    //'password' => 'same:confirmpassword',
                    'phone' => 'required|max:20|min:10'
                        // 'status' => 'required'
                ]);

                $data_arry['name'] = $request->name;
                $data_arry['email'] = $request->email;
                $data_arry['mobile_no'] = $request->phone;
                $data_arry['dealerID'] = decrypt($request->dealerID);
                $data_arry['roleID'] = 3;
                //$data_arry['password'] = Hash::make($request->password);
                //$data_arry['status'] = $request->status;
            }
        }


        if ($request->savestatus == 'A') {


            $id = User::create($data_arry);
            \LogActivity::addToLog('New dealerportal dealer user' . $request->name . ' added(' . $id->id . ').');
            return redirect('dealer/user-list')->with('success', 'New dealer user created successfully');
        } else {

            $recid = $request->id;

            User::where('id', decrypt($recid))->update($data_arry);
            \LogActivity::addToLog('dealerportal dealer user edited ' . $request->name . ' updated(' . decrypt($recid) . ').');
            return redirect('/dealer-user-edit/' . $recid . '')->with('success', 'dealer user updated successfully');
        }
    }

    public function dealer_user_profile() {


        return view('frontend_dealer.profile');
    }

    public function save_user_profile(Request $request) {

        $data_arry = array();

        $id = decrypt($request->id);
        if ($request->password) {
            $request->validate([
                'name' => 'required|max:50',
                'password' => 'same:confirmpassword',
                //'password' => 'same:confirmpassword',
                'phone' => 'required|max:20|min:10'
                    // 'status' => 'required'
            ]);

            $data_arry['name'] = $request->name;
            $data_arry['mobile_no'] = $request->phone;
            $data_arry['password'] = Hash::make($request->password);
        } else {
            $request->validate([
                'name' => 'required|max:50',
                'phone' => 'required|max:20|min:10'
                    // 'status' => 'required'
            ]);

            $data_arry['name'] = $request->name;
            $data_arry['mobile_no'] = $request->phone;
        }


        User::where('id', $id)->update($data_arry);
        \LogActivity::addToLog('profile updated ' . $request->name . ' updated(' . $id . ').');
        return redirect('dealer/dealer-user-profile')->with('success', 'Profile updated successfully');
    }

//////////----------------- Orders -------------------------////////////////////////
    public function pending_orders(Request $request) {

        if ($request->ajax()) {
            $token = $this->generatedToken();
            $delaerID = auth()->user()->dealerID;
            //$delaerID = 1;
            $status = 'pending';

            $apidata = Http::withHeaders([
                        'Authorization' => 'Bearer ' . $token,
                    ])->post('https://dsityreshop.com/api/get-pickup-orders?status=' . $status . '&dealerID=' . $delaerID);

            /* $data = [
              "orderList" => [
              [
              "orderID" => "1",
              "orderNumber" => "ONL23111700001",
              "orderdate" => "2023-10-11",
              "lastpickupdate" => "2023-10-17",
              "status" => "pending",
              "dealerID" => "1",
              "itemQuantity" => "3", // total items ordered,
              "ordervalue" => '248350.00',
              "customerName" => 'Namal perera',
              "mobile" => '0777889977'
              ],
              ]
              ]; */

            $resultdata = $apidata->json();
            if (empty($resultdata['orderList'])) {
                return Datatables::of([])
                                ->addColumn('error', function () {
                                    return 'No data available.';
                                })
                                ->rawColumns(['error'])
                                ->make(true);
            }

            return Datatables::of($resultdata['orderList'])
                            ->addIndexColumn()
                            /*  ->addColumn('edit', function ($row) {
                              $dropdownHtml = '<div class="dropdown">
                              <button class="btn btn-secondary dropdown-toggle" type="button" id="pendingDropdown'.$row['orderID'].'" data-bs-toggle="dropdown" aria-expanded="false">
                              '.$row['status'].'
                              </button>
                              <ul class="dropdown-menu" aria-labelledby="pendingDropdown'.$row['orderID'].'">
                              <li><a class="dropdown-item" value="pending">Pending</a></li>
                              <li><a class="dropdown-item" value="completed">Completed</a></li>
                              <li><a class="dropdown-item" value="cancelled">Cancelled</a></li>
                              </ul>
                              </div>';

                              return $dropdownHtml;
                              }) */
                            ->addColumn('edit', function ($row) {
                                $edit_url = route('view-order-details', $row['orderRef']);
                                $btn = '<a  class="btn btn-primary btn-sm" href="' . $edit_url . '"><i class="fa fa-edit"></i></a>';
                                return $btn;
                            })
                            ->rawColumns(['edit'])
                            ->make(true);
        }

        return view('frontend_dealer.pending_order_list');
    }

    public function completed_orders(Request $request) {

        if ($request->ajax()) {
            $token = $this->generatedToken();
            $delaerID = auth()->user()->dealerID;
            //$delaerID = 1;
            $status = 'completed';

            $apidata = Http::withHeaders([
                        'Authorization' => 'Bearer ' . $token,
                    ])->post('https://dsityreshop.com/api/get-pickup-orders?status=' . $status . '&dealerID=' . $delaerID);

            $resultdata = $apidata->json(); //var_dump($apidata['orderList']); die();

            if (empty($resultdata['orderList'])) {
                return Datatables::of([])
                                ->addColumn('error', function () {
                                    return 'No data available.';
                                })
                                ->rawColumns(['error'])
                                ->make(true);
            }
            return Datatables::of($resultdata['orderList'])
                            ->addIndexColumn()
                            ->addColumn('edit', function ($row) {
                                $edit_url = route('view-order-details', $row['orderRef']);
                                $btn = '<a  class="btn btn-primary btn-sm" href="' . $edit_url . '"><i class="fa fa-eye"></i></a>';
                                return $btn;
                            })
                            ->rawColumns(['edit'])
                            ->make(true);
        }

        return view('frontend_dealer.completed_order_list');
    }

    public function cancelled_orders(Request $request) {

        if ($request->ajax()) {
            $resultdata = array();
            $token = $this->generatedToken();
            $delaerID = auth()->user()->dealerID;
            //$delaerID = 1;
            $status = 'cancelled';

            $apidata = Http::withHeaders([
                        'Authorization' => 'Bearer ' . $token,
                    ])->post('https://dsityreshop.com/api/get-pickup-orders?status=' . $status . '&dealerID=' . $delaerID);

            $resultdata = $apidata->json(); //var_dump($apidata['orderList']); die();
            // Check if $resultdata is empty
            if (empty($resultdata['orderList'])) {
                return Datatables::of([])
                                ->addColumn('error', function () {
                                    return 'No data available.';
                                })
                                ->rawColumns(['error'])
                                ->make(true);
            }
            return Datatables::of($resultdata['orderList'])
                            ->addIndexColumn()
                            ->addColumn('edit', function ($row) {
                                $edit_url = route('view-order-details', $row['orderRef']);
                                $btn = '<a  class="btn btn-primary btn-sm" href="' . $edit_url . '"><i class="fa fa-eye"></i></a>';
                                return $btn;
                            })
                            ->addColumn('cancelleddate', function ($row) {
                                if ($row['cancelleddate']) {
                                    $cdate = $row['cancelleddate'];
                                } else {
                                    $cdate = '-';
                                }
                                return $cdate;
                            })
                            ->rawColumns(['edit', 'cancelleddate'])
                            ->make(true);
        }

        return view('frontend_dealer.cancelled_order_list');
    }

    public function view_order_details($id) {

        $token = $this->generatedToken();

        $apidata = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $token,
                ])->post('https://dsityreshop.com/api/get-order-details?orderID=' . $id);
        $resultdata = $apidata->json();
        $orderinfo = $resultdata['orderdetails'];
        $productlist = $resultdata['ProductList'];
        $customer = $resultdata['Customer'];
        $status = $orderinfo['status'];
        if ($status == 'completed') {
            return view('frontend_dealer.completed_order_details')->with('orderinfo', $orderinfo)->with('productlist', $productlist)->with('customer', $customer);
        } elseif ($status == 'cancelled') {
            return view('frontend_dealer.cancelled_order_details')->with('orderinfo', $orderinfo)->with('productlist', $productlist)->with('customer', $customer);
        } else {
            return view('frontend_dealer.order_details')->with('orderinfo', $orderinfo)->with('productlist', $productlist)->with('customer', $customer);
        }
    }

    public function updateOrderStatus(Request $request) {
        //echo $request->orderRef; die();
        $status = $request->status;
        $orderID = $request->orderid;
        $orderRef = $request->orderRef;

        $token = $this->generatedToken();

        if($status == "cancelled"){
            $apidata1 = Http::withHeaders([
                        'Authorization' => 'Bearer ' . $token,
                    ])->post('https://dsityreshop.com/api/get-order-details?orderID=' . $orderRef);
            $resultdata1 = $apidata1->json();
            $productlist = $resultdata1['ProductList'];

            $dealerID = auth()->user()->dealerID;

            foreach ($productlist as $product) {
                Dealer_stock::where('dealerID', $dealerID)
                            ->where('productcode', $product['ProductCode'])
                            ->increment('quantity', $product['Quantity']);
            }
        } else if($status == "completed"){
            $token = $this->generatedToken();

            $apidata2 = Http::withHeaders([
                        'Authorization' => 'Bearer ' . $token,
                    ])->post('https://dsityreshop.com/api/get-order-details?orderID=' . $orderRef);
            $resultdata2 = $apidata2->json();
            // dd($resultdata2);
            $order = $resultdata2['orderdetails'];
            $orderitem = $resultdata2['ProductList'];
            $user = $resultdata2['Customer'];
            $dealer = Dealers::join('address', 'dealers.addressID', '=', 'address.id')
                    ->select('dealers.*','address.vAddressline1','address.vAddressline2')
                    ->where('dealers.id',$order['dealerID'])
                    ->first();
            $cc_email = $dealer->email;
            $bcc_email = array(
                'karshan@tekgeeks.net',
                'onilne_orders_team@dsityre.lk'
            );
            $to_email = $request->email;
            
            $this->send_sales_invoice($orderRef);
            
            try {
                \Mail::send('frontend_dealer.thanks_mail', 
                [
                    'order' => $order,
                    'orderitem' => $orderitem, 
                    'user' => $user, 
                    'dealer' => $dealer
                ], function ($message) use ($to_email, $bcc_email, $cc_email, $orderRef) {
                    $message->from('orders@dsityreshop.com', 'DSI Tyres');
                    $message->to($to_email)->cc($cc_email)->bcc($bcc_email)->subject('Thank You for Your DSI Tyres Purchase! - '.$orderRef);
                });

            } catch (\Exception $e) {
                \LogActivity::addToLog('Failed to send email: ' . $e->getMessage());
                // return redirect()->back()->with('danger', 'Failed to send email. Try again later.');
            }
        }
        
        $apidata = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('https://dsityreshop.com/api/update-order?orderID=' . $orderID . '&orderRef=' . $orderRef . '&status=' . $status . '&completeddate=' . '' . '&canceleddate=' . '');
        $resultdata = $apidata->json();

        \LogActivity::addToAPILog('order status updated - orderRef: ' . $orderRef . ' Status: ' . $status . '. API response :' . $resultdata['message']);

        return redirect('dealer/pending-orders')->with('success', 'Status updated successfully. Order number :' . $orderRef);
    }

    private function generatedToken() {

        $username = 'admin@tekgeeks.net';
        $password = 'admin123';

        $response = Http::post('https://dsityreshop.com/api/create-access-token?email=' . $username . '&password=' . $password);
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

    public function commission_report(Request $request)
    {
        if ($request->ajax()) {
            $dealer_id = auth()->user()->dealerID;
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
            if($dealer_id){
                $token = $this->generatedToken();
                $apidata = Http::withHeaders([
                            'Authorization' => 'Bearer ' . $token,
                        ])->post('https://dsityreshop.com/api/get-completed-dealer-orders?dealer_id=' . $dealer_id . '&ordered_from=' . $ordered_from. '&ordered_to=' . $ordered_to);
    
                $resultdata = $apidata->json();
            }
            
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
                            return $dealer1->name.' - '.$dealer1->dealercode;
                        })
                        // ->rawColumns(['order_ref_no','name'])
                        ->make(true);
            }
        }
        return view('frontend_dealer.commission_report');
    }

    public function commission_report_excel(Request $request)
    {   
        $dealer_id = $request->ex_dealer_id;
        $ordered_from = $request->ex_ordered_from;
        $ordered_to = $request->ex_ordered_to;
        $current_date = date('Y_m_d_H_i');
        $filename = 'Report';
        return Excel::download(new DealerCommission($dealer_id, $ordered_from, $ordered_to), "$filename _ $current_date.xlsx");
    }

    public function send_sales_invoice($orderRef)
    {
        try {
            $token = $this->generatedToken();
            
            $apidata = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->post('https://dsityreshop.com/api/send-sales-invoice?orderRef=' . $orderRef);

            $resultData = $apidata->json();
            // dd($resultData);
            \LogActivity::addToAPILog('send_sales_invoice output : ' . json_encode($resultData));
            // Return the response
            return;
        } catch (\Exception $e) {
            \LogActivity::addToAPILog('Error in send_sales_invoice: ' . $e->getMessage());
        }
    }

}
