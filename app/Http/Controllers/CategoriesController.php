<?php

namespace App\Http\Controllers;

use App\Models\AccessoryCategory;
use App\Models\GunCategory;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gun_categories = GunCategory::paginate(5);
        $accessory_categories = AccessoryCategory::paginate(5);
        return view('admin.manage-categories', compact('gun_categories', 'accessory_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createGun()
    {   $routeName = "manageGun.categories.store";
        $gunHeader = "Add a category for guns";
        $mainHeader = "Manage Category";
        $redirectTo = "manage.categories";
        return view('admin.manage-categories-brands-form', ['subHeader' => $gunHeader, 'routeName' => $routeName , 'header' => $mainHeader, 'redirectTo' => $redirectTo]);
    }

    public function createAccessory()
    {
        $routeName = "manageAccessory.categories.store";
        $accessoryHeader = "Add a category for Accessories";
        $mainHeader = "Manage Category";
        $redirectTo = "manage.categories";
        return view('admin.manage-categories-brands-form', ['subHeader' => $accessoryHeader, 'routeName' => $routeName, 'header' => $mainHeader, 'redirectTo' => $redirectTo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeGun(Request $request)
    {
        $validated = $request->validate([
            'name' => "required|max:30"
        ]);

        $gunCategory = new GunCategory();
        $gunCategory->name = $validated['name'];
        $gunCategory->save();
        return redirect()->route('manage.categories')->with('success', 'Gun category is successfully added');
    }

    public function storeAccessory(Request $request)
    {
        $validated = $request->validate([
            'name' => "required|max:30"
        ]);

        $accessoryCategory = new AccessoryCategory();
        $accessoryCategory->name = $validated['name'];
        $accessoryCategory->save();
        return redirect()->route('manage.categories')->with('success', 'Accessory category is successfully added');
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
    public function editGun($id)
    {
        $gunCat = GunCategory::findOrFail($id);
        $header = "Edit " . $gunCat->name;
        $mainHeader = "Gun Category";
        $routeName = "updateGun.form";
        $redirectTo = "manage.categories";
        return view('admin.manage-categories-brands-form', ['dataFound' => $gunCat, 'subHeader' => $header, 'routeName' => $routeName, 'header' => $mainHeader, 'redirectTo' => $redirectTo]);        
    }

    public function editAccessory($id)
    {
        $accessoryCat = AccessoryCategory::findOrFail($id);
        $header = "Edit " . $accessoryCat->name;
        $mainHeader = "Accessory Category";
        $routeName = "updateAccessory.form";
        $redirectTo = "manage.categories";
        return view('admin.manage-categories-brands-form', ['dataFound' => $accessoryCat, 'subHeader' => $header, 'routeName' => $routeName, 'header' => $mainHeader, 'redirectTo' => $redirectTo]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateGun(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:40'
        ]);
        $gunCategory = GunCategory::findOrFail($id);
        
        $gunCategory->name = $validated['name'];
        $gunCategory->save();
        return redirect()->route('manage.categories')->with('success', 'Successfully Updated');
    }

    public function updateAccessory(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:40'
        ]);
        $accessoryCategory = AccessoryCategory::find($id);
        $accessoryCategory->name = $validated['name'];
        $accessoryCategory->save();
        return redirect()->route('manage.categories')->with('success', 'Successfully Updated');
        
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyGun($id)
    {
        $gunCategory = GunCategory::find($id);
        if($gunCategory){
            $gunCategory->delete();
        }
        return redirect()->route('manage.categories')->with('success', "Successfully deleted!");
    }

    public function destroyAccessory($id)
    {
        $accessoryCategory = AccessoryCategory::find($id);
        if($accessoryCategory){
            $accessoryCategory->delete();
        }
        return redirect()->route('manage.categories')->with('success', 'Successfully deleted!');
    }
}