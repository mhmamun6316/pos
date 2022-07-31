<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Models\Product;
use Auth;
use PDF;
use DB;

class PosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function saleGenerate($id){

        $sales = DB::table('sales')
            ->where('sales.id',$id)
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

        $pdf = PDF::loadView('invoice', $data);

        return $pdf->stream();
    }

    public function index()
    {
        $carts = Cart::content();
        $cartTotal = Cart::total();
        return response()->json([
            'carts' => $carts,
            'cartTotal' => $cartTotal,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::where('outlet_id',Auth::user()->busineess_id)->get();
        return view('pos.create',compact('products'));
    }

    public function addToPos($id){
        $product = Product::findOrFail($id);
        Cart::add([
            'id' => $id,
            'name' => $product->name,
            'qty' => 1,
            'price' => $product->selling_price,
            'weight' => 1,
        ]);

        return response([
           'message' => 'Product added to cart'
        ]);
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

    public function incrementPos($rowId){
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty + 1);
        return response()->json([
            'message' => 'Product incremented successfully'
        ]);
    }

    public function decrementPos($rowId){
        $row = Cart::get($rowId);
        if ($row->qty == 1) {
            return response()->json(['message' => 'product can not be 0']);
        }else {
            Cart::update($rowId, $row->qty - 1);
            return response()->json(['message' => 'product decremented successfully']);
        }
    }

    public function removePos($id){
        Cart::remove($id);
        return response()->json(['message' => 'Product Removed successfully']);
    }
}
