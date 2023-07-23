<?php

namespace App\Http\Controllers;

use App\Models\AccessoryCategory;
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
        $updateProduct = "gun.update";
        $storeProduct = "gun.store";
        $redirectTo = "manage.gun";
        $submitBtn = 'Add Product';

        return view('admin.product-form', [
            'brands' => $brands, 
            'categories' => $categories,
            'header' => $header,
            'subHeader' => $subHeader,
            'redirectTo' => $redirectTo,
            'updateProduct' => $updateProduct,
            'storeProduct' => $storeProduct,
            'submitBtn' => $submitBtn
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
            'price.integer' => 'The price must be a valid number',
            'images.*.image' => 'Invalid image format',
            'images.*.mimes' => 'Only JPEG, JPG, PNG, and GIF images are allowed',
            'images.*.max' => 'Image size must not exceed 1MB'
        ];
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required|integer',
            'description' => 'required',
            'brand_id' => 'required',
            'category_id' => 'required',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,jpg,png,gif|max:1000'
        ], $messages);
        $gunProduct = GunProduct::create($validated);
        
        $this->handleImages($request, $gunProduct);
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
        $updateProduct = 'gun.edit';
        $submitBtn = 'Update Product';

        return view('admin.product-form', [
            'product' => $gun,
            'updateProduct' => $updateProduct,
            'brands' => $brands, 
            'categories' => $categories,
            'header' => $header,
            'subHeader' => $subHeader,
            'redirectTo' => $redirectTo,
            'submitBtn' => $submitBtn
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
            'price' => 'required|integer',
            'description' => 'required',
            'brand_id' => 'required',
            'category_id' => 'required',
            'images' => 'array',
            'images.*' => 'image|mimes:jpeg,jpg,png,gif|max:1000'
        ], $messages);
        
        $gun = GunProduct::findOrFail($id);
        

        $gun->update($validated);

        $this->handleImages($request, $gun);
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
            foreach($gun->images as $image){
                Storage::disk('public')->delete('product_images/' . $image->filename);
            }
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

    public function indexAccessoryAdmin()
    {
        $accessories = $this->getAccessoryProducts('all');
        return view('admin.manage-accessory', ['products' => $accessories]);
    }

    private function getAccessoryProducts($category_id = '')
    {
        if($category_id == 'all'){
            return AccessoryProduct::with('brand')
                                    ->inRandomOrder()
                                    ->paginate(10);
        }

        return AccessoryProduct::with('brand')
                                ->where('category_id', $category_id)
                                ->paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createAccessory()
    {
        $brands = Brand::all();
        $categories = AccessoryCategory::all();

        $header = "Manage Accessory Product";
        $subHeader = "Add accessory product";
        $updateProduct = "accessory.update";
        $storeProduct = "accessory.store";
        $redirectTo = "manage.accessories";
        $submitBtn = 'Add product';
        return view('admin.product-form', [
            'brands' => $brands, 
            'categories' => $categories,
            'header' => $header,
            'subHeader' => $subHeader,
            'redirectTo' => $redirectTo,
            'updateProduct' => $updateProduct,
            'storeProduct' => $storeProduct,
            'submitBtn' => $submitBtn
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAccessory(Request $request)
    {
        $messages = [
            'brand_id.required' => "The brand is required",
            'category_id.required' => 'The category is required',
            'images.*.image' => 'Invalid image format',
            'images.*.mimes' => 'Only JPEG, JPG, PNG and GIF are allowed',
            'images.*.max' => 'The images must not exceed to 1MB',
            'images.*.required' => 'Please select an images' 
        ]; 
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required|integer',
            'description' => 'required',
            'brand_id' => 'required',
            'category_id' => 'required',
            'images' => 'required|array',
            'images.*' => 'max:1000|mimes:jpeg,jpg,png,gif|image'
        ], $messages);

        $accessory = AccessoryProduct::create($validated);

        $this->handleImages($request, $accessory);

        return redirect()->route('manage.accessories')->with('success', 'Accessory is successfully created.');
        
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
        $brands = Brand::all();
        $categories = AccessoryCategory::all();
        $accessory = AccessoryProduct::findOrFail($id);

        $header = "Manage Accessory Product";
        $subHeader = "Update accessory product";
        $updateProduct = "accessory.update";
        $storeProduct = "accessory.store";
        $redirectTo = "manage.accessories";
        $submitBtn = 'Update Product';

        return view('admin.product-form', [
            'product' => $accessory,
            'brands' => $brands, 
            'categories' => $categories,
            'header' => $header,
            'subHeader' => $subHeader,
            'redirectTo' => $redirectTo,
            'updateProduct' => $updateProduct,
            'storeProduct' => $storeProduct,
            'submitBtn' => $submitBtn
        ]);

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
        $messages = [
            'brand_id.required' => 'The brand is required',
            'category_id.required' => 'The category is required',
            'images.*.mimes' => 'Only JPEG, JPG, PNG and GIF are allowed',
            'images.*.max' => "The image size must not exceed to 1MB",
            'images.*.image' => 'Invalid image format'    
        ];

        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required|integer',
            'description' => 'required',
            'brand_id' => 'required',
            'category_id' => 'required',
            'images' => 'array',
            'images.*' => 'mimes:jpeg,jpg,png,gif|max:1000|image'
        ], $messages);

        $accessory = AccessoryProduct::findOrFail($id);
        $accessory->update($validated);
        $this->handleImages($request, $accessory);
        return redirect()->route('manage.accessories')->with('success', 'The accessory si successfully updated.');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyAccessory($id)
    {
        $accessory = AccessoryProduct::findOrFail($id);
        if($accessory){
            foreach($accessory->images as $image){
                Storage::disk('public')->delete('product_images/', $image->filename);
            }
            $accessory->delete();
        }
        return redirect()->route('manage.accessories')->with('success', 'The accessory is successfully deleted.');
    }

    private function handleImages(Request $request, $product)
    {
        if($request->hasFile('images')){
            $images = $request->file('images');

            foreach($images as $index => $image){
                if($image){
                    if($product->images->count() > $index){
                        Storage::disk('public')->delete('product_images/' . $product->images[$index]->filename);
                        $product->images[$index]->delete();
                        $fileName = uniqid() . "." .$image->getClientOriginalExtension();
                        $image->storeAs('public/product_images/', $fileName);
                        $product->images()->create(['filename' => $fileName]);
                    } else {
                        $fileName = uniqid() . "." .$image->getClientOriginalExtension();
                        $image->storeAs('public/product_images/', $fileName);
                        $product->images()->create(['filename' => $fileName]);
                    }
                }
            }
        }
    }


}