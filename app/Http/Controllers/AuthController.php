<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use DB;

class AuthController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard');
        }else{
            return back();
        }
    }

    public function dashboard(){
        $outlet = 0;
        $date = Carbon::now();
        $current_date = $date->format('Y-m-d');
        $current_month = $date->format('m');
        $current_month_name = $date->format('F');
        $current_year = $date->format('Y');

        $alerts = Product::whereColumn('alert_quantity', '>=', 'quantity')->with('outlet')->get();

        $today_sell = DB::table('sales')
                     ->when($outlet != 0, function ($query) use ($outlet) {
                        $query->where('sales.outlet_id', $outlet);
                     })
                     ->whereDate('sales.created_at',$current_date)
                     ->whereYear('created_at',$current_year)
                     ->sum('sales.total');

        $monthly_sell = DB::table('sales')
                     ->whereMonth('sales.created_at',$current_month)
                     ->whereYear('created_at',$current_year)
                     ->when($outlet != 0, function ($query) use ($outlet) {
                        $query->where('sales.outlet_id', $outlet);
                     })
                     ->sum('sales.total');

        $yearly_sell = DB::table('sales')
                     ->whereYear('created_at',$current_year)
                     ->when($outlet != 0, function ($query) use ($outlet) {
                        $query->where('sales.outlet_id', $outlet);
                     })
                     ->sum('sales.total');

        $today_gross_profit = DB::table('sales')
                     ->leftjoin('sale_items','sale_items.order_id','=','sales.id')
                     ->leftjoin('products','sale_items.product_id','=','products.id')
                     ->select(
                         DB::raw('sum(products.inc_purchase_price * sale_items.qty) as sums')
                         )
                     ->whereDate('sales.created_at',$current_date)
                     ->whereYear('sales.created_at',$current_year)
                     ->first();

        $monthly_gross_profit = DB::table('sales')
                     ->select(
                        DB::raw('sum(products.inc_purchase_price * sale_items.qty) as sums')
                      )
                     ->leftjoin('sale_items','sale_items.order_id','=','sales.id')
                     ->leftjoin('products','sale_items.product_id','=','products.id')
                     ->whereMonth('sales.created_at',$current_month)
                     ->whereYear('sales.created_at',$current_year)
                     ->first();


        $yearly_gross_profit = DB::table('sales')
                     ->leftjoin('sale_items','sale_items.order_id','=','sales.id')
                     ->leftjoin('products','sale_items.product_id','=','products.id')
                     ->select(
                         DB::raw('sum(products.inc_purchase_price * sale_items.qty) as sums')
                         )
                     ->whereYear('sales.created_at',$current_year)
                     ->first();

        $today_expenses = DB::table('expenses')
                        ->when($outlet != 0, function ($query) use ($outlet) {
                            $query->where('expenses.outlet_id', $outlet);
                        })
                        ->whereDate('created_at',$current_date)
                        ->sum('expenses.amount');

        $monthly_expenses = DB::table('expenses')
                        ->when($outlet != 0, function ($query) use ($outlet) {
                            $query->where('expenses.outlet_id', $outlet);
                        })
                        ->whereMonth('created_at',$current_month)
                        ->sum('expenses.amount');

        $yearly_expenses = DB::table('expenses')
                        ->when($outlet != 0, function ($query) use ($outlet) {
                            $query->where('expenses.outlet_id', $outlet);
                        })
                        ->whereYear('created_at',$current_year)
                        ->sum('expenses.amount');

                        // dd($today_gross_profit);
        $today_net_profit = $today_sell - $today_gross_profit->sums -  $today_expenses;
        $monthly_net_profit = $monthly_sell - $monthly_gross_profit->sums - $monthly_expenses;
        $yearly_net_profit = $yearly_sell - $yearly_gross_profit->sums - $yearly_expenses;

        $products =Product::orderBy('name','ASC')->with('brand','outlet','category','subcategory')->get();

        $qty = Product::sum('quantity');

        return view('index',compact([
            'alerts',
            'today_sell',
            'monthly_sell',
            'yearly_sell',
            'current_month_name',
            'current_year',
            'today_gross_profit',
            'monthly_gross_profit',
            'yearly_gross_profit',
            'today_expenses',
            'monthly_expenses',
            'yearly_expenses',
            'today_net_profit',
            'monthly_net_profit',
            'yearly_net_profit',
            'products',
            'qty'
        ]));
    }

    public function logout(Request $request){
        Auth::logout();
        return redirect('/');
    }

    public function ProfileView(){
        return view('auth.view_profile');
    }

    public function ProfileUpdate(Request $request){
        $request->validate([
            'email' => 'required',
        ]);

        $admin_id = Auth::user()->id;
        $admin = User::find($admin_id);
        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        $admin->gender = $request->input('gender');
        if ($request->file('image')) {
            $file = $request->file('image');
            $extension = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
            Image::make($file)->resize(300, 300)->save('uploads/user/' . $extension);
            $save_url = 'uploads/user/' . $extension;
            $admin->photo = $save_url;
        }
        $admin->dob = $request->input('dob');
        $admin->nid = $request->input('nid');
        $admin->phone = $request->input('phone');
        $admin->address = $request->input('address');
        $admin->updated_at = Carbon::now()->timezone('CST');
        $admin->update();
        return redirect()->route('dashboard');
    }

    public function ProfilePassword(){
        return view('auth.change_password');
    }

    public function PasswordUpdate(Request $request){
        $request->validate([
            'old_password' => 'required',
            'password' => [
                'required',
                'confirmed',
                'min:8',
            ],
        ]);

        $admin_pass = Auth::user()->password;
        $current_password = $request->old_password;
        $newpass = $request->password;

       if (Hash::check($current_password,$admin_pass)) {
            User::findOrFail(Auth::id())->update([
            'password' => Hash::make($newpass)
            ]);
            $notification=array(
                'message'=>'Your Password Change Success.',
                'alert-type'=>'success'
            );
            return redirect()->route('dashboard')->with($notification);
       }else {
        $notification=array(
            'message'=>'Old Password Not Match',
            'alert-type'=>'error'
        );
        return Redirect()->back()->with("fail","Old Password Not Match");
       }
    }
}
