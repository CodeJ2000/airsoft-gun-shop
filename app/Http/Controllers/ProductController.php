<?php

namespace App\Http\Controllers;

use App\Models\AccessoryProduct;
use App\Models\GunProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function indexAdmin()
    {
        
    }

    private function getGunProducts($category_id = '')
    {
        if($category_id == 'all'){
            return GunProduct::with('brand')
                            ->inRandomOrder()
                            ->get();    
        }

        return GunProduct::with('brand')
                            ->where('category_id', $category_id)
                            ->inRandomOrder()
                            ->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createGun()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeGun(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyGun($id)
    {
        //
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