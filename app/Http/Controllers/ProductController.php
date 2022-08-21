<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Outlet;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use Image;
use DB;
use Auth;

class ProductController extends Controller
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

    public function getAll($outlet = 0,$brand = 0,$category = 0,$subcategory = 0,$start_date=0,$to_date){
        $user_id = User::ROLE[Auth::user()->role_id];
        $user = Auth::user();

        $products = DB::table('products')
            ->join('outlets','products.outlet_id','outlets.id')
            ->join('brands','products.brand_id','brands.id')
            ->join('categories','products.category_id','categories.id')
            ->when($user_id != 'Super-admin',function ($query) use ($user_id,$user){
                $query->where('products.outlet_id',$user->busineess_id);
            })
            ->when($outlet != 0, function ($query) use ($outlet) {
                $query->where('products.outlet_id', $outlet);
            })
            ->when($brand != 0, function ($query) use ($brand) {
                $query->where('products.brand_id', $brand);
            })
            ->when($category != 0, function ($query) use ($category) {
                $query->where('products.category_id', $category);
            })
            ->when($subcategory != 0, function ($query) use ($subcategory) {
                $query->where('products.subcategory_id', $subcategory);
            })
            ->when($start_date != 0, function ($query) use ($start_date) {
                $query->whereDate('products.created_at','>=',$start_date);
            })
            ->when($to_date != 0, function ($query) use ($to_date) {
                $query->whereDate('products.created_at','<=',$to_date);
            })
            ->select('products.*','outlets.name as outlet_name','brands.name as brand_name','categories.name as categories_name' )
            ->get();

        return response()->json([
            'role' => $user_id,
            'products' => $products
        ]);
    }

    public function stockProduct(){
        $role = User::ROLE[Auth::user()->role_id];
        $products =Product::orderBy('name','ASC')->with('brand','outlet','category','subcategory')->get();

        $qty = Product::sum('quantity');
        return view('product.stock',compact(
            'products',
            'qty',
            'role'
        ));
    }

    public function index()
    {
        $brands = DB::table('brands')->get();
        $categories = DB::table('categories')->get();
        $subcategories = DB::table('sub_categories')->get();
        $outlets =  DB::table('outlets')->get();
        return view('product.index',compact('outlets','categories','brands','subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = DB::table('brands')->get();
        $categories = DB::table('categories')->get();
        $subcategories = DB::table('sub_categories')->get();
        $outlets =  DB::table('outlets')->get();
        return view('product.create',compact('brands','categories','subcategories','outlets'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->product_name ;
        $product->sku = "sku".rand(10,100);
        $product->barcode_type = $request->barcode_type;
        $product->outlet_id = $request->busineess_location;
        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->alert_quantity = $request->alart_qty;
        $product->description = $request->description;
        $product->custom1 = $request->custom_field1;
        $product->custom2 = $request->custom_field2;
        $product->quantity = $request->quantity;
        $product->applicable_tax = $request->tax;
        $product->exc_purchase_price = $request->single_dpp;
        $product->inc_purchase_price = $request->including_tax_dpp;
        $product->selling_price = $request->including_tax_dsp;
        $product->margin = $request->profit_percent;
        if($request->file('product_image')){
            $file = $request->file('product_image');
            $extension = time() . '.' . $request->file('product_image')->getClientOriginalExtension();
            Image::make($file)->resize(300, 300)->save('uploads/product/' . $extension);
            $product->image = 'uploads/product/' . $extension;
        }
        if($request->file('product_brochure')){
            $file = $request->file('product_brochure');
            $extension = time() . '.' . $request->file('product_brochure')->getClientOriginalExtension();
            Image::make($file)->resize(300, 300)->save('uploads/product/' . $extension);
            $product->brochure = 'uploads/product/' . $extension;
        }
        $product->save();

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product = Product::where('id',$product->id)
                  ->with('brand','category','subcategory','outlet')->first();
        return response($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $brands = Brand::all();
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $outlets = Outlet::all();
        $product = Product::where('id',$product->id)
        ->with('brand','category','subcategory','outlet')->first();
        return view('product.edit',compact('product','brands','categories','subcategories','outlets'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product = Product::find($request->product_id);
        $product->name = $request->product_name ;
        $product->sku = "sku".rand(10,100);
        $product->barcode_type = $request->barcode_type;
        $product->outlet_id = $request->busineess_location;
        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->alert_quantity = $request->alart_qty;
        $product->description = $request->description;
        $product->custom1 = $request->custom_field1;
        $product->custom2 = $request->custom_field2;
        $product->quantity = $request->quantity;
        $product->applicable_tax = $request->tax;
        $product->exc_purchase_price = $request->single_dpp;
        $product->inc_purchase_price = $request->including_tax_dpp;
        $product->selling_price = $request->including_tax_dsp;
        $product->margin = $request->profit_percent;
        if($request->file('product_image')){
            $file = $request->file('product_image');
            $extension = time() . '.' . $request->file('product_image')->getClientOriginalExtension();
            Image::make($file)->resize(300, 300)->save('uploads/product/' . $extension);
            $product->image = 'uploads/product/' . $extension;
        }
        if($request->file('product_brochure')){
            $file = $request->file('product_brochure');
            $extension = time() . '.' . $request->file('product_brochure')->getClientOriginalExtension();
            Image::make($file)->resize(300, 300)->save('uploads/product/' . $extension);
            $product->brochure = 'uploads/product/' . $extension;
        }
        $product->update();

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response([
            'message' => "Product deleted successfully",
        ]);
    }
}
