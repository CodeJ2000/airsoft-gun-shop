<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\GunProduct;
use App\Models\GunCategory;
use Illuminate\Http\Request;
use App\Models\AccessoryProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->shareNavigationData();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexGun($cat_id)
    {
        
        $gun_products = $this->getGunProducts($cat_id);

        return view('list-products', ['products' => $gun_products]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexGunAdmin()
    {
        $gunProducts = $this->getGunProducts('all');
        return view('admin.manage-guns', ['products' => $gunProducts]);
    }

    private function getGunProducts($category_id = '')
    {
        if($category_id == 'all'){
            return GunProduct::with(['brand', 'category'])
                            ->inRandomOrder()
                            ->paginate(10);    
        }

        return GunProduct::with('brand')
                            ->where('category_id', $category_id)
                            ->inRandomOrder()
                            ->paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createGun()
    {
        $brands = Brand::all();
        $categories = GunCategory::all();
        $header = "Manage Gun Product";
        $subHeader = "Add gun product";
        $redirectTo = "manage.gun";

        return view('admin.product-form', [
            'brands' => $brands, 
            'categories' => $categories,
            'header' => $header,
            'subHeader' => $subHeader,
            'redirectTo' => $redirectTo
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeGun(Request $request)
    {
        $messages = [
            'brand_id.required' => 'The brand field is required',
            'category_id.required' => 'The category field is required',
            'images.required' => 'Please select an images',
            'images.*.image' => 'Invalid image format',
            'images.*.mimes' => 'Only JPEG, JPG, PNG, and GIF images are allowed',
            'images.*.max' => 'Image size must not exceed 1MB'
        ];
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'brand_id' => 'required',
            'category_id' => 'required',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,jpg,png,gif|max:1000'
        ], $messages);
        $gunProduct = GunProduct::create($validated);
        
        if($request->hasFile('images')){
            $images = $request->file('images');

            foreach($images as $image){
                $fileName = uniqid() . '.' . $image->getClientOriginalExtension();

                $image->storeAs('public/product_images/',  $fileName);

                $gunProduct->images()->create(['filename' => $fileName]);
                
            }
        }
        return redirect()->route('manage.gun')->with('success', 'Gun added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showGun($id)
    {
        $singleGun = GunProduct::with('brand')
                                ->find($id);
        $brandName = $singleGun->brand->name;
        return view('single', ['singleProduct' => $singleGun, 'brandName' => $brandName]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editGun($id)
    {
        $gun = GunProduct::find($id);
        $brands = Brand::all();
        $categories = GunCategory::all();
        $header = "Manage Gun Product";
        $subHeader = "Add gun product";
        $redirectTo = "manage.gun";

        return view('admin.product-form', [
            'product' => $gun,
            'brands' => $brands, 
            'categories' => $categories,
            'header' => $header,
            'subHeader' => $subHeader,
            'redirectTo' => $redirectTo
        ]);
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
        $messages = [
            'brand_id.required' => 'The brand field is required',
            'category_id.required' => 'The category field is required',
            'images.*.image' => 'Invalid image format',
            'images.*.mimes' => 'Only JPEG, JPG, PNG, and GIF images are allowed',
            'images.*.max' => 'Image size must not exceed 1MB'
        ];
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'brand_id' => 'required',
            'category_id' => 'required',
            'images' => 'array',
            'images.*' => 'image|mimes:jpeg,jpg,png,gif|max:1000'
        ], $messages);
        
        $gun = GunProduct::findOrFail($id);
        

        $gun->update($validated);

        if($request->hasFile('images')){
            $images = $request->file('images');

            foreach($images as $index => $image){
                if($image){
                    Storage::delete('public/product_images/' . $gun->images[$index]->filename);
                    File::delete('storage/product_images/' . $gun->images[$index]->filename);
                    $gun->images[$index]->delete();
                    $fileName = uniqid() . "." . $image->getClientOriginalExtension();
                    $image->storeAs('public/product_images/', $fileName);
                    $gun->images()->create(['filename' => $fileName]);
                } else {
                    continue;
                }
            }
        }
        return redirect()->route('manage.gun')->with('success', 'Gun updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyGun($id)
    {
        $gun = GunProduct::findOrFail($id);

        if($gun){
            $gun->delete();
            return redirect()->route('manage.gun')->with('success', 'Gun product is successfully deleted.');
        }
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAccessory($cat_id)
    {
        $accessory_products = $this->getAccessoryProducts($cat_id);

        return view('list-products', ['products' => $accessory_products]);
    }

    private function getAccessoryProducts($category_id = '')
    {
        if($category_id == 'all'){
            return AccessoryProduct::with('brand')
                                    ->inRandomOrder()
                                    ->get();
        }

        return AccessoryProduct::with('brand')
                                ->where('category_id', $category_id)
                                ->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createAccessory()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAccessory(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showAccessory($id)
    {
        $singleAccessory = AccessoryProduct::with('brand')
                                            ->find($id);
        $brandName = $singleAccessory->brand->name;

        return view('single', ['singleProduct' => $singleAccessory, 'brandName' => $brandName]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editAccessory($id)
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
    public function updateAccessory(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyAccessory($id)
    {
        //
    }

}