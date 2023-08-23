@include('admin.partials.side-header')
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">{{ $header }}</h1>
                    </div>
                </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>    
                        @endif
                <!-- /. ROW  -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-info">
                                 <div class="panel-heading">
                                    <strong>{{ $subHeader }}</strong>
                                 </div>
                                 <div class="panel-body">
                                     <form role="form" method="POST" action="{{ isset($product) ? route($updateProduct, $product->id) : route($storeProduct) }}" enctype="multipart/form-data">
                                        @csrf
                                        @if (isset($product))
                                            @method('PUT')
                                        @endif
                                            <div class="col-md-6">
                                                 <div class="form-group">
                                                    <label for="name">Name:</label>
                                                     <input class="form-control" name="name" value="{{ old('name', isset($product) ? $product->name : '') }}" type="text">
                                                 </div>
                                                 <div class="form-group">
                                                    <label for="name">Price:</label>
                                                     <input class="form-control" value="{{ old('price', isset($product) ? $product->price : '') }}" name="price" type="text">
                                                 </div>
                                                 <div class="form-group">
                                                    <label for="name">Stock:</label>
                                                     <input class="form-control" value="{{ old('stock', isset($product) ? $product->stock : '') }}" name="stock" type="number" min="1">
                                                 </div>
                                                 <div class="form-group">
                                                    <label>Description:</label>
                                                    <textarea name="description" class="form-control" rows="3">{{ old('description', isset($product) ? $product->description : '') }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Select Brand</label>
                                                    <select name="brand_id" class="form-control">
                                                        <option value="">Select a Brand...</option>
                                                        
                                                        @if ($brands->count() > 0)
                                                        @foreach ($brands as $brand)
                                                            <option value="{{ $brand->id }}" {{ old('brand_id', (isset($product) && $product->brand_id == $brand->id) ? 'selected' : '') }}>
                                                                {{ ucwords($brand->name) }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                    
                                                    </select>
                                                </div>
                          
                                                <div class="form-group">
                                                    <label>Select Category</label>
                                                    <select name="category_id" class="form-control">
                                                        <option value="">Select a Category...</option>
                                                        
                                                        @if ($categories->count() > 0)
                                                            @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}" {{ old('category_id', isset($product) && $product->category_id == $category->id ?  "selected" : "") }}>{{ ucwords($category->name) }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-lg-4">Image1 Upload</label>
                                                    <div class="">
                                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                                            <div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;">
                                                                @if ( isset($product) && $product->images->count() > 0)
                                                                <img src="{{ asset('storage/product_images/' . $product->images[0]->filename) }}" alt="Image">
                                                                @endif
                                                            </div>
                                                            <div>
                                                                <span class="btn btn-file btn-success"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="images[]"></span>
                                                                <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                
                                                <div class="form-group">
                                                    <label class="control-label col-lg-4">Image2 Upload</label>
                                                    <div class="">
                                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                                            <div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;">
                                                                @if ( isset($product) && $product->images->count() > 0)
                                                                <img src="{{ asset('storage/product_images/' . $product->images[1]->filename) }}" alt="Image">
                                                                @endif
                                                            </div>

                                                            <div>
                                                                <span class="btn btn-file btn-success"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="images[]"></span>
                                                                <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-lg-4">Image3 Upload</label>
                                                    <div class="">
                                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                                            <div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;">
                                                                @if ( isset($product) && $product->images->count() > 0)
                                                                <img src="{{ asset('storage/product_images/' . $product->images[2]->filename) }}" alt="Image">
                                                                @endif
                                                            </div>
                                                            <div>
                                                                <span class="btn btn-file btn-success"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="images[]"></span>
                                                                <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-lg-4">Image4 Upload</label>
                                                    <div class="">
                                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                                            <div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;">
                                                                @if ( isset($product) && $product->images->count() > 0)
                                                                <img src="{{ asset('storage/product_images/' . $product->images[3]->filename) }}" alt="Image">
                                                                @endif
                                                            </div>
                                                            <div>
                                                                <span class="btn btn-file btn-success"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="images[]"></span>
                                                                <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center col-md-12">
                                                 <button type="submit" class="btn btn-info ">{{ $submitBtn }}</button>
                                                 <a href="{{ route($redirectTo) }}" class="btn btn-muted">Back</a>
                                            </div>
                                             </form>
                                     </div>
                                 </div>
                            </div>
                </div>
                   <!-- /. ROW  -->
            <div class="row">
                 
            </div>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
@include('admin.partials.footer')