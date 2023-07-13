<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::paginate(5);

        return view('admin.manage-brands', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $routeName = "brand.store";
        $brandHeader = "Add a brands";
        $mainHeader = "Manage Brands";
        $redirectTo = "manage.brands";
        return view('admin.manage-categories-brands-form', ['subHeader' => $brandHeader, 'routeName' => $routeName , 'header' => $mainHeader, 'redirectTo' => $redirectTo]);
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
            'name' => "required|max:40"
        ]);
        $brands = new Brand();
        $brands->name = $validated['name'];
        $brands->save();
        session()->put('success', 'Successfully added!');
        return redirect()->route('manage.brands');

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
        $brand = Brand::find($id);
        $routeName = "brand.update";
        $brandHeader = "Edit a brands";
        $mainHeader = "Manage Brands";
        $redirectTo = "manage.brands";
        return view('admin.manage-categories-brands-form', ['dataFound' => $brand, 'subHeader' => $brandHeader, 'routeName' => $routeName , 'header' => $mainHeader, 'redirectTo' => $redirectTo]);
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
        $validated = $request->validate([
            'name' => 'required|max:40'
        ]);
        $brand = Brand::find($id);
        $brand->name = $validated['name'];
        $brand->save();
        session()->put('success', 'Successfully Updated!');
        return redirect()->route('manage.brands');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);
        if($brand){
            $brand->delete();
            session()->put('success', 'Successfully deleted!');
        }
        return redirect()->route('manage.brands');
    }
}