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
        return view('admin.manage-categories-form', ['categoryHeader' => $gunHeader, 'routeName' => $routeName , 'header' => $mainHeader]);
    }

    public function createAccessory()
    {
        $routeName = "manageAccessory.categories.store";
        $accessoryHeader = "Add a category for Accessories";
        $mainHeader = "Manage Category";
        return view('admin.manage-categories-form', ['categoryHeader' => $accessoryHeader, 'routeName' => $routeName, 'header' => $mainHeader]);
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
        $request->session()->put('success', 'Gun category is successfully added');
        return redirect()->route('manage.categories');
    }

    public function storeAccessory(Request $request)
    {
        $validated = $request->validate([
            'name' => "required|max:30"
        ]);

        $accessoryCategory = new AccessoryCategory();
        $accessoryCategory->name = $validated['name'];
        $accessoryCategory->save();
        $request->session()->put('success', 'Accessory category is successfully added');
        return redirect()->route('manage.categories');
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
        return view('admin.manage-categories-form', ['category' => $gunCat, 'categoryHeader' => $header, 'routeName' => $routeName, 'header' => $mainHeader]);        
    }

    public function editAccessory($id)
    {
        $accessoryCat = AccessoryCategory::findOrFail($id);
        $header = "Edit " . $accessoryCat->name;
        $mainHeader = "Accessory Category";
        $routeName = "updateAccessory.form";
        return view('admin.manage-categories-form', ['category' => $accessoryCat, 'categoryHeader' => $header, 'routeName' => $routeName, 'header' => $mainHeader]);
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
        $request->session()->put('success', 'Successfully Updated');
        
        return redirect()->route('manage.categories')->with('removeSuccess', true);
    }

    public function updateAccessory(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:40'
        ]);
        $accessoryCategory = AccessoryCategory::find($id);
        $accessoryCategory->name = $validated['name'];
        $accessoryCategory->save();
        $request->session()->put('success', 'Successfully Updated');

        return redirect()->route('manage.categories');
        
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
            session()->flash('success', "Successfully deleted!");
        }

        return redirect()->route('manage.categories');
    }

    public function destroyAccessory($id)
    {
        $accessoryCategory = AccessoryCategory::find($id);
        if($accessoryCategory){
            $accessoryCategory->delete();
            session()->flash('success', 'Successfully deleted!');
        }

        return redirect()->route('manage.categories');
    }
}