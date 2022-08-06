<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Product;
use Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use DB;
use PDF;

class ReportController extends Controller
{
    public function sell($outlet,$current_date,$search){
       return  DB::table('sales')
                ->when($outlet != 0, function ($query) use ($outlet) {
                    $query->where('sales.outlet_id', $outlet);
                })
                ->$search('sales.created_at',$current_date)
                ->sum('sales.total');
    }

    public function cost($current_date,$search){
        $date = Carbon::now();
        $current_year = $date->format('Y');
        return DB::table('sales')
                ->leftjoin('sale_items','sale_items.order_id','=','sales.id')
                ->leftjoin('products','sale_items.product_id','=','products.id')
                ->select(
                    DB::raw('sum(products.inc_purchase_price * sale_items.qty) as sums')
                    )
                ->$search('sales.created_at',$current_date)
                ->whereYear('sales.created_at',$current_year)
                ->first();
    }

    public function expense($outlet,$current_date,$search){
        $date = Carbon::now();
        $current_year = $date->format('Y');
        return DB::table('expenses')
                    ->when($outlet != 0, function ($query) use ($outlet) {
                        $query->where('expenses.outlet_id', $outlet);
                    })
                    ->$search('created_at',$current_date)
                    ->whereYear('created_at',$current_year)
                    ->sum('expenses.amount');
    }

    public function expenseTable($current_date,$search){
        return DB::table('expenses')
                ->select('expenses.*','outlets.name as outlet_name')
                ->leftjoin('outlets','outlets.id','=','expenses.outlet_id')
                ->$search('expenses.created_at',$current_date)
                ->get();
    }

    public function sellProducts($current_date,$search){
        return  DB::table('sales')
                    ->select('sales.*','sale_items.product_id','sale_items.qty','products.name','products.selling_price','outlets.name as outlet_name')
                    ->leftjoin('outlets','outlets.id','=','sales.outlet_id')
                    ->leftjoin('sale_items','sale_items.order_id','=','sales.id')
                    ->leftjoin('products','sale_items.product_id','=','products.id')
                    ->$search('sales.created_at',$current_date)
                    ->get();
    }

    public function duePays($current_date,$search){
        return  DB::table('sale_dues')
                ->select('sale_dues.*','customers.name')
                ->leftjoin('sales','sales.id','=','sale_dues.order_id')
                ->leftjoin('customers','customers.id','=','sales.customer_id')
                ->$search('sale_dues.payment_dat',$current_date)
                ->get();
    }

    public function todayReport(){
        $outlet = 0;
        $date = Carbon::now();
        $current_date = $date->format('Y-m-d');
        $search = "whereDate";

        $today_sell = $this->sell($outlet,$current_date,$search);

        $purchase_cost = $this->cost($current_date,$search);

        $today_expenses = $this->expense($outlet,$current_date,$search);

        $today_profit = $today_sell - $purchase_cost->sums - $today_expenses;

        $today_expenses_datas = $this->expenseTable($current_date,$search);

        $today_sell_products = $this->sellProducts($current_date,$search);

        $today_due_pays = $this->duePays($current_date,$search);

        return view('reports.today_report',compact([
            'today_sell',
            'purchase_cost',
            'today_expenses',
            'today_profit',
            'today_expenses_datas',
            'today_sell_products',
            'today_due_pays'
        ]));
    }

    public function monthlyReport(){
        $outlet = 0;
        $date = Carbon::now();
        $current_month = $date->format('m');
        $search = "whereMonth";

        $monthly_sell = $this->sell($outlet,$current_month,$search);

        $purchase_cost = $this->cost($current_month,$search);

        $monthly_expenses = $this->expense($outlet,$current_month,$search);

        $monthly_profit = $monthly_sell - $purchase_cost->sums - $monthly_expenses;

        $monthly_expenses_datas = $this->expenseTable($current_month,$search);

        $monthly_sell_products = $this->sellProducts($current_month,$search);

        $monthly_due_pays = $this->duePays($current_month,$search);

        return view('reports.monthly_report',compact([
            'monthly_sell',
            'purchase_cost',
            'monthly_expenses',
            'monthly_profit',
            'monthly_expenses_datas',
            'monthly_sell_products',
            'monthly_due_pays'
        ]));
    }

    public function yearlyReport(){
        $outlet = 0;
        $date = Carbon::now();
        $current_year = $date->format('Y');
        $search = "whereYear";

        $yearly_sell = $this->sell($outlet,$current_year,$search);

        $purchase_cost = $this->cost($current_year,$search);

        $yearly_expenses = $this->expense($outlet,$current_year,$search);

        $yearly_profit = $yearly_sell - $purchase_cost->sums - $yearly_expenses;

        $yearly_expenses_datas = $this->expenseTable($current_year,$search);

        $yearly_sell_products = $this->sellProducts($current_year,$search);

        $yearly_due_pays = $this->duePays($current_year,$search);

        return view('reports.yearly_report',compact([
            'yearly_sell',
            'purchase_cost',
            'yearly_expenses',
            'yearly_profit',
            'yearly_expenses_datas',
            'yearly_sell_products',
            'yearly_due_pays'
        ]));
    }

    public function customerDueReport(){
        return view('reports.customer_due_report');
    }

    public function customerDueReportData($start = 0,$end = 0){

        $dueCustomersBuilder = Sale::select([
            'sales.due_amount',
            'customers.*'
        ]);

        $dueCustomersBuilder->join("customers", function ($join) {
            $join->on('sales.customer_id', '=', 'customers.id');
        });

        if($start != 0 && $end != 0){
            $dueCustomersBuilder->whereDate('sales.created_at','>=',$start)
                                ->whereDate('sales.created_at','<=',$end);
        }

        $dueCustomers = $dueCustomersBuilder->get();

        return response()->json([
            'customers' => $dueCustomers
        ]);
    }

    public function topProduct(){

        $topProducts= SaleItem::leftjoin('products','products.id','sale_items.product_id')
                    ->select('sale_items.product_id','products.name','products.sku',DB::raw('sum(sale_items.qty) as count'))
                    ->groupBy('sale_items.product_id')
                    ->orderBy('count','DESC')
                    ->take(10)
                    ->get();

        return view('reports.top_products_report',compact('topProducts'));
    }

    public function todaySell(){
        $outlet = 0;
        $date = Carbon::now();
        $current_date = $date->format('Y-m-d');
        $search = "whereDate";

        $today_sell_products = $this->sellProducts($current_date,$search);

        $data = [
            'title' => 'Today Selling Products',
            'products' => $today_sell_products->toArray(),
        ];

        $pdf = PDF::loadView('reports/print/invoice', $data);

        return $pdf->stream();
    }

    public function todayExpenses(){
        $outlet = 0;
        $date = Carbon::now();
        $current_date = $date->format('Y-m-d');
        $search = "whereDate";

        $today_expenses = $this->expenseTable($current_date,$search);

        $data = [
            'title' => 'Today Expenses',
            'products' => $today_expenses->toArray(),
        ];

        $pdf = PDF::loadView('reports/print/expenseInvoice', $data);

        return $pdf->stream();
    }

    public function monthlySell(){
        $outlet = 0;
        $date = Carbon::now();
        $current_month = $date->format('m');
        $search = "whereMonth";

        $monthly_sell_products = $this->sellProducts($current_month,$search);

        $data = [
            'title' => 'Monthly Selling Products',
            'products' => $monthly_sell_products->toArray(),
        ];

        $pdf = PDF::loadView('reports/print/invoice', $data);

        return $pdf->stream();
    }

    public function monthlyExpenses(){
        $outlet = 0;
        $date = Carbon::now();
        $current_month = $date->format('m');
        $search = "whereMonth";

        $monthly_expenses = $this->expenseTable($current_month,$search);

        $data = [
            'title' => 'Monthly Expenses',
            'products' => $monthly_expenses->toArray(),
        ];

        $pdf = PDF::loadView('reports/print/expenseInvoice', $data);

        return $pdf->stream();
    }

    public function yearlySell(){
        $outlet = 0;
        $date = Carbon::now();
        $current_year = $date->format('Y');
        $search = "whereYear";

        $yearly_sell_products = $this->sellProducts($current_year,$search);

        $data = [
            'title' => 'Yearly Selling Products',
            'products' => $yearly_sell_products->toArray(),
        ];

        $pdf = PDF::loadView('reports/print/invoice', $data);

        return $pdf->stream();
    }

    public function yearlyExpenses(){
        $outlet = 0;
        $date = Carbon::now();
        $current_year = $date->format('Y');
        $search = "whereYear";

        $yearly_expenses_datas = $this->expenseTable($current_year,$search);

        $data = [
            'title' => 'Yearly Expenses',
            'products' => $yearly_expenses_datas->toArray(),
        ];

        $pdf = PDF::loadView('reports/print/expenseInvoice', $data);

        return $pdf->stream();
    }
}
