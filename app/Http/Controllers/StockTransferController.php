<?php

namespace App\Http\Controllers;

use App\Models\StockTransfer;
use Illuminate\Http\Request;
use App\Models\Outlet;
use App\Models\Product;
use App\Models\TemporaryStock;
use App\Models\TransferProduct;
use Session;
use DB;

class StockTransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $stockTransfers = StockTransfer::with('LocationFrom','LocationTo')->get();
        return view('stocks.all_stock',compact('stockTransfers'));
    }

    public function StockAll(){
        $stocks = TemporaryStock::with('product')->get();
        return response($stocks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $outlets =Outlet::all();
        $products = Product::all();
        return view('stocks.add_stock',compact('outlets','products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required',
            'location_from' => 'required',
            'location_to' => 'required',
        ]);

        try {

            $transfer_id = DB::table('stock_transfers')->insertGetId([
                'date' => $request->date,
                'reference' => $request->reference,
                'loc_from' => $request->location_from,
                'loc_to' => $request->location_to,
                'note' => $request->note,
                'total_amount' => $request->total,
            ]);

            foreach($request->product as $product){
                $transfer = new TransferProduct();
                $transfer->stock_transfer_id =  $transfer_id;
                $transfer->product_id = $product['id'];
                $transfer->qty = $product['qty'];
                $transfer->subtotal = $product['subtotal'];
                $transfer->save();
            }

            TemporaryStock::truncate();

            return redirect()->route('transfers.index');
            // all good
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function stockAdd(Request $request,$id){
        $exist = TemporaryStock::where('product_id',$id)->first();
        if(!$exist){
            $stock = new TemporaryStock();
            $stock->product_id = $id;
            $stock->quantity = 1;
            $stock->save();
        }else{
            return response([
                'message' => "Product Already Added"
            ]);
        }

        return response([
            'message' => "Product Added Successfully"
        ]);
    }

    public function StocIncrement(Request $request,$id){
        $product = TemporaryStock::where('product_id',$id)->first();
        $product->quantity = $product->quantity + 1;
        $product->update();

        return response([
            "message" => "Product icremented successfully",
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StockTransfer  $stockTransfer
     * @return \Illuminate\Http\Response
     */
    public function show(StockTransfer $stockTransfer,$id)
    {
        $stock = StockTransfer::where('id',$id)->with('LocationFrom','LocationTo')->first();
        $products = TransferProduct::where('stock_transfer_id',$stock->id)->with('product')->get();
        return response([
            'stock' => $stock,
            'products' => $products
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StockTransfer  $stockTransfer
     * @return \Illuminate\Http\Response
     */
    public function edit(StockTransfer $stockTransfer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StockTransfer  $stockTransfer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StockTransfer $stockTransfer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StockTransfer  $stockTransfer
     * @return \Illuminate\Http\Response
     */
    public function destroy(StockTransfer $stockTransfer,$id)
    {
        $stock = StockTransfer::find($id)->delete();
        $products = TransferProduct::where('stock_transfer_id',$id)->get();
        foreach ($products as $product) {
            $product->delete();
        }

        return response([
            'message' => 'Stock transfer product deleted successfully',
        ]);
    }

    public function StockDelete($id){
        TemporaryStock::find($id)->delete();
        return response([
            'message' => "Product deleted successfully",
        ]);
    }

    public function stockAccept($id){
        $stock = StockTransfer::find($id);
        $stock->status = 1;
        $stock->update();

        return response([
            'message' => 'Stock Request Accepted'
        ]);
    }

    public function stockComplete($id){
        $stock = StockTransfer::find($id);
        $stock->status = 2;
        $stock->update();

        return response([
            'message' => 'Stock Transfer Completed'
        ]);
    }
}
