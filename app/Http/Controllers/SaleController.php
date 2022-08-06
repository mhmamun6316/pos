<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Customer;
use App\Models\Product;
use App\Models\SaleItem;
use App\Models\SaleDue;
use Illuminate\Http\Request;
use Cart;
use Carbon\Carbon;
use Auth;
use DB;
use PDF;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = DB::table('sales')
                 ->join('outlets','sales.outlet_id','outlets.id')
                 ->join('customers','sales.customer_id','customers.id')
                 ->select('sales.*','outlets.name as outlet_name','customers.name as customer_name')
                 ->orderBy('sales.id','DESC')
                 ->get();

        return view('pos.index',compact('sales'));
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
        // dd($request->all());
        $request->validate([
            'customer_name' => 'required|max:255',
            'customer_mobile' => 'required',
            'customer_address' => 'required',
        ]);

        $carts = Cart::content();

        $customer_id = Customer::insertGetId([
            'name' => $request->customer_name,
            'mobile_number' => $request->customer_mobile,
            'email' => $request->customer_email,
            'address' => $request->customer_address,
            'national_id' => $request->customer_national,
            'credit_number' => $request->customer_card,
            'created_at' => Carbon::now(),
        ]);

        if($request->grand_total - $request->paid_amount <= 0){
            $due_amount = 0;
            $status = "Paid";
        }else{
            $due_amount = $request->grand_total - $request->paid_amount;
            $status = "Due";
        }

        $date = Carbon::now()->format('dmy');

        $order_id = Sale::insertGetId([
            'customer_id' => $customer_id,
            'outlet_id' => Auth::user()->busineess_id,
            'invoice_no' => 'RE' . $date,
            'md_discount' => $request->md_disc,
            'special_discount' => $request->special_disc,
            'parcent_discount' => $request->percent_disc,
            'vat' => $request->vat,
            'status' => $status,
            'pay_amount' => $request->paid_amount,
            'due_amount' => $due_amount,
            'installment_type' => $request->installment_mode,
            'payment_method' => $request->payment_mode,
            'total' => $request->grand_total,
            'remarks' => $request->remarks,
            'created_at' => Carbon::now(),
        ]);


        foreach ($carts as $cart) {
            SaleItem::insert([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'product_name' => $cart->name,
                'qty' => $cart->qty,
                'price' => $cart->price,
                'created_at' => Carbon::now(),
            ]);

            Product::where('id', $cart->id)->decrement('quantity', $cart->qty);
        }

        Cart::destroy();


        $sales = DB::table('sales')
            ->where('sales.id',$order_id)
            ->join('outlets','sales.outlet_id','outlets.id')
            ->join('customers','sales.customer_id','customers.id')
            ->join('sale_items','sales.id','sale_items.order_id')
            ->select('sales.*','sale_items.*','outlets.name as outlet_name','customers.*')
            ->get();

        $data = [
            'title' => 'Welcome to rakhi electronics',
            'date' => date('m/d/Y'),
            'sales' => $sales
        ];

        //  dd($data);

        $pdf = PDF::loadView('reports/invoice', $data);

        return $pdf->stream();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        $sales = DB::table('sales')
                ->where('sales.id',$sale->id)
                ->join('outlets','sales.outlet_id','outlets.id')
                ->join('customers','sales.customer_id','customers.id')
                ->join('sale_items','sales.id','sale_items.order_id')
                ->select('sales.*','sale_items.*','outlets.name as outlet_name','customers.name as customer_name')
                ->get();

        return response($sales);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }

    public function salesDue(){

        $sales = Sale::with('dueSale','customer','outlet')
                ->where('sales.status','Due')
                ->get();

        return view('pos.salesDue',compact('sales'));
    }

    public function salesDuePay(Request $request){
        $sale = Sale::find($request->order_id);
        $sale->due_amount =  $sale->due_amount - $request->due_payment;
        if($sale->due_amount <= 0){
            $sale->status = "Paid";
        }
        $sale->save();

        $saleDue = new SaleDue;
        $saleDue->order_id = $request->order_id;
        $saleDue->payment_dat = $request->payment_date;
        $saleDue->note = $request->note;
        $saleDue->save();

        return back();
    }
}
