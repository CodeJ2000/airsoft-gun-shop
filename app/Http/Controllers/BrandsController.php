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
        // Retrieve a paginated list of brands, with each page containing up to 5 brands.
        $brands = Brand::paginate(5);

        // Return the 'admin.manage-brands' view, passing the retrieved brands data to the view.
        return view('admin.manage-brands', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // The routeName is used in the form action URL to store the brand using the 'brand.store' route.
        $routeName = "brand.store";

         // The brandHeader is the sub-header for the brand creation form.
        $brandHeader = "Add a brands";

        // The mainHeader is the main header for the page where the form is displayed.
        $mainHeader = "Manage Brands";

        // The redirectTo is the route to redirect after submitting the form.
        $redirectTo = "manage.brands";

        // Return the 'admin.manage-categories-brands-form' view, passing the data required for the brand creation form to the view.
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
         // Validate the incoming request data, ensuring that the 'name' field is required and has a maximum length of 40 characters.
        $validated = $request->validate([
            'name' => "required|max:40"
        ]);

        // Create a new instance of the Brand model.  
        $brands = new Brand();

        // Assign the validated 'name' field value to the brand's 'name' property.
        $brands->name = $validated['name'];

        // Save the brand record to the database.
        $brands->save();

        // Store a success message in the session to display after the brand is successfully added.
        session()->put('success', 'Successfully added!');

        // Redirect the user to the 'manage.brands' route after the brand is added.
        return redirect()->route('manage.brands');

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