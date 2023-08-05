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
        // This constructor method is automatically called when an instance of HomeController is created.
        // It calls the shareNavigationData() method, possibly for sharing navigation data across the controller.
        $this->shareNavigationData();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexGun($cat_id)
    {
        // Retrieve gun products based on the provided category ID.
        $gun_products = $this->getGunProducts($cat_id);

        // Load the 'list-products' view, passing the retrieved gun products to it.
        return view('list-products', ['products' => $gun_products]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexGunAdmin()
    {
        // Retrieve gun products for administration, showing all categories.
        $gunProducts = $this->getGunProducts('all');

        // Load the 'admin.manage-guns' view, passing the retrieved gun products to it.
        return view('admin.manage-guns', ['products' => $gunProducts]);
    }

    private function getGunProducts($category_id = '')
    {
        // Check if the category ID is set to 'all' to retrieve all gun products.
        if($category_id == 'all'){
            // Retrieve gun products with associated brand and category, in random order, paginated.
            return GunProduct::with(['brand', 'category'])
                            ->inRandomOrder()
                            ->paginate(10);    
        }

        // Retrieve gun products with associated brand, filtered by the provided category ID, in random order, paginated.
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
        // Retrieve all brands and gun categories.
        $brands = Brand::all();
        $categories = GunCategory::all();

        // Data for rendering the product form view.
        $header = "Manage Gun Product";
        $subHeader = "Add gun product";
        $updateProduct = "gun.update";
        $storeProduct = "gun.store";
        $redirectTo = "manage.gun";
        $submitBtn = 'Add Product';

        // Load the 'admin.product-form' view, passing necessary data to it.
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
        // Validation rules and error messages for product creation.
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
            'price' => 'required|numeric',
            'description' => 'required',
            'brand_id' => 'required',
            'category_id' => 'required',
            'stock' => 'required|numeric',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,jpg,png,gif|max:1000'
        ], $messages);

        // Create a new GunProduct instance using the validated data.
        $gunProduct = GunProduct::create($validated);
        
        
        // Handle uploaded images for the product.
        $this->handleImages($request, $gunProduct);

        // Redirect to the 'manage.gun' route with a success message.
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
        // Retrieve a single gun product with associated brand.
        $singleGun = GunProduct::with('brand')
                                ->find($id);
        // Retrieve the brand name for the single gun.
        $brandName = $singleGun->brand->name;
        
        // Load the 'single' view, passing the retrieved product and brand name to it.
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
        // Retrieve the gun product to be edited.
        $gun = GunProduct::find($id);
             
        // Data for rendering the product form view for editing.
        $brands = Brand::all();
        $categories = GunCategory::all();
        $header = "Manage Gun Product";
        $subHeader = "Add gun product";
        $redirectTo = "manage.gun";
        $updateProduct = 'gun.edit';
        $submitBtn = 'Update Product';

        // Load the 'admin.product-form' view, passing necessary data to it.
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
        // Validation rules and error messages for product update.
        $messages = [
            'brand_id.required' => 'The brand field is required',
            'category_id.required' => 'The category field is required',
            'images.*.image' => 'Invalid image format',
            'images.*.mimes' => 'Only JPEG, JPG, PNG, and GIF images are allowed',
            'images.*.max' => 'Image size must not exceed 1MB'
        ];
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'brand_id' => 'required',
            'stock' => 'required|numeric',
            'category_id' => 'required',
            'images' => 'array',
            'images.*' => 'image|mimes:jpeg,jpg,png,gif|max:1000'
        ], $messages);
        
        // Find the gun product to be updated.
        $gun = GunProduct::findOrFail($id);
        
        // Update the gun product using the validated data.
        $gun->update($validated);

        // Handle uploaded images for the updated product.
        $this->handleImages($request, $gun);

        // Redirect to the 'manage.gun' route with a success message.
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
        // Find the GunProduct with the given ID, or throw an exception if not found.
        $gun = GunProduct::findOrFail($id);

        if($gun){
            // Loop through each image associated with the gun and delete it from storage.
            foreach($gun->images as $image){
                Storage::disk('public')->delete('product_images/' . $image->filename);
            }

            // Delete the gun product from the database.
            $gun->delete();

             // Redirect to the manage.gun route with a success message.
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
        // Get accessory products based on the given category ID.
        $accessory_products = $this->getAccessoryProducts($cat_id);


        // Return a view and pass the list of accessory products to it.
        return view('list-products', ['products' => $accessory_products]);
    }

    public function indexAccessoryAdmin()
    {
        // Get all accessory products for administration.
        $accessories = $this->getAccessoryProducts('all');
        
        // Return a view for managing accessory products and pass the products to it.
        return view('admin.manage-accessory', ['products' => $accessories]);
    }

    private function getAccessoryProducts($category_id = '')
    {

        if($category_id == 'all'){
            // Retrieve all accessory products with their associated brand, in random order, and paginate the results.
            return AccessoryProduct::with('brand')
                                    ->inRandomOrder()
                                    ->paginate(10);
        }
         // Retrieve accessory products of a specific category with their associated brand, and paginate the results.
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
        // Retrieve all brands and accessory categories from the database.
        $brands = Brand::all();
        $categories = AccessoryCategory::all();

        // Set up variables for view rendering and form handling.
        $header = "Manage Accessory Product";
        $subHeader = "Add accessory product";
        $updateProduct = "accessory.update";
        $storeProduct = "accessory.store";
        $redirectTo = "manage.accessories";
        $submitBtn = 'Add product';

        // Return the product form view, passing the necessary data.
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

         // Define custom error messages for validation.
        $messages = [
            'brand_id.required' => "The brand is required",
            'category_id.required' => 'The category is required',
            'images.*.image' => 'Invalid image format',
            'images.*.mimes' => 'Only JPEG, JPG, PNG and GIF are allowed',
            'images.*.max' => 'The images must not exceed to 1MB',
            'images.*.required' => 'Please select an images' 
        ]; 

        // Validate the incoming request data.
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'brand_id' => 'required',
            'category_id' => 'required',
            'stock' => 'required|numeric',
            'images' => 'required|array',
            'images.*' => 'max:1000|mimes:jpeg,jpg,png,gif|image'
        ], $messages);

        // Create a new AccessoryProduct instance using the validated data.
        $accessory = AccessoryProduct::create($validated);

        // Handle uploaded images associated with the accessory.
        $this->handleImages($request, $accessory);

         // Redirect back to the accessories management page with a success message.
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
        // Retrieve a single accessory product with its associated brand by ID.  
        $singleAccessory = AccessoryProduct::with('brand')
                                            ->find($id);
        
        // Extract the brand name from the retrieved accessory.        
        $brandName = $singleAccessory->brand->name;

        // Return the view for displaying a single accessory product.
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
        // Retrieve all brands and accessory categories from the database.
        $brands = Brand::all();
        $categories = AccessoryCategory::all();
        
        // Find the accessory product to be edited.
        $accessory = AccessoryProduct::findOrFail($id);

        // Prepare variables for view rendering and form handling.
        $header = "Manage Accessory Product";
        $subHeader = "Update accessory product";
        $updateProduct = "accessory.update";
        $storeProduct = "accessory.store";
        $redirectTo = "manage.accessories";
        $submitBtn = 'Update Product';

        // Return the product form view with relevant data for editing.
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
        // Define custom error messages for validation.
        $messages = [
            'brand_id.required' => 'The brand is required',
            'category_id.required' => 'The category is required',
            'images.*.mimes' => 'Only JPEG, JPG, PNG and GIF are allowed',
            'images.*.max' => "The image size must not exceed to 1MB",
            'images.*.image' => 'Invalid image format'    
        ];

        // Validate the incoming request data.
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'brand_id' => 'required',
            'stock' => 'required|numeric',
            'category_id' => 'required',
            'images' => 'array',
            'images.*' => 'mimes:jpeg,jpg,png,gif|max:1000|image'
        ], $messages);

        // Find the accessory product to be updated.
        $accessory = AccessoryProduct::findOrFail($id);

        // Update the accessory product with validated data.
        $accessory->update($validated);

        // Handle uploaded images associated with the accessory.
        $this->handleImages($request, $accessory);

        // Redirect back to the accessories management page with a success message.
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
        // Find the accessory product with the given ID, or throw an exception if not found
        $accessory = AccessoryProduct::findOrFail($id);

        // Check if the accessory exists
        if($accessory){
             // Loop through each image associated with the accessory
            foreach($accessory->images as $image){

                // Delete the image file from storage
                Storage::disk('public')->delete('product_images/', $image->filename);
            }

            // Delete the accessory product from the database
            $accessory->delete();
        }

        // Redirect to the manage.accessories route with a success message
        return redirect()->route('manage.accessories')->with('success', 'The accessory is successfully deleted.');
    }

    // Function to handle uploading and managing images for a product
    private function handleImages(Request $request, $product)
    {

        // Check if any images are uploaded in the request
        if($request->hasFile('images')){


            $images = $request->file('images');

            // Loop through each uploaded image
            foreach($images as $index => $image){
                if($image){
                    // If the product already has images at this index, replace them
                    if($product->images->count() > $index){

                        // Delete the existing image file from storage and database
                        Storage::disk('public')->delete('product_images/' . $product->images[$index]->filename);
                        $product->images[$index]->delete();

                        // Generate a unique filename and store the new image
                        $fileName = uniqid() . "." .$image->getClientOriginalExtension();
                        $image->storeAs('public/product_images/', $fileName);

                        // Create a new image record in the database
                        $product->images()->create(['filename' => $fileName]);
                    } else {
                        // If the product doesn't have an image at this index, create a new one
                        $fileName = uniqid() . "." .$image->getClientOriginalExtension();
                        $image->storeAs('public/product_images/', $fileName);

                        // Create a new image record in the database
                        $product->images()->create(['filename' => $fileName]);
                    }
                }
            }
        }
    }


}