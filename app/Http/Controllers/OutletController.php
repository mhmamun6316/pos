<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use Illuminate\Http\Request;

class OutletController extends Controller
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
        return view('outlets.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $outlets = Outlet::OrderBy('name','ASC')->get();
        return response($outlets);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $outlet = Outlet::create([
            'name' => $request->name,
            'location_id' => $request->location_id,
            'division' => $request->division,
            'district' => $request->district,
            'city' => $request->city,
            'mobile' => $request->mobile,
            'phone' => $request->phone,
            'email' => $request->email,
            'custom1' => $request->custom1,
            'custom2' => $request->custom2,
        ]);

        return response([
            'outlet' => $outlet,
            'message' => "Outlet Added Successfully"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function show(Outlet $outlet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function edit(Outlet $outlet)
    {
        return response($outlet);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Outlet $outlet,$id)
    {
        $outlet = Outlet::where('id',$id)
                ->update([
                    'name' => $request->name,
                    'location_id' => $request->location_id,
                    'division' => $request->division,
                    'district' => $request->district,
                    'city' => $request->city,
                    'mobile' => $request->mobile,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'custom1' => $request->custom1,
                    'custom2' => $request->custom2,
                ]);

        return response([
            'outlet' => $outlet,
            'message' => "Outlet Updated Successfully"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Outlet $outlet)
    {
        $outlet->delete();
        return response([
            "message" => "Outlet Deleted Successfully"
        ]);
    }
}
