@extends('layouts.dashboardmaster')

@section('content')
    <div class="page-body">

        <!-- New Product Add Start -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-sm-8 m-auto">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-header-2">
                                        <h5>Product Information</h5>
                                    </div>

                                    @if (session('success'))
                                        <div class="alert alert-success">{{ session('success') }}</div>
                                    @endif
                                    <form class="theme-form theme-form-2 mega-form" method="POST"
                                        enctype="multipart/form-data" action={{ route('product.store') }}>
                                        @csrf

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Category Name**</label>
                                            <div class="col-sm-9">
                                                <select name="product_category_id" id="" class="form-control">
                                                    <option value="select-one">select one</option>
                                                    @foreach ($allCategories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->category_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('product_category')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Product Name**</label>
                                            <div class="col-sm-9">
                                                <input id="product_name" class="form-control" type="text"
                                                    placeholder="Product Name" Name" name="product_name"
                                                    value="{{ old('product_name') }}">
                                                @error('product_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>



                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Product Purches Price**</label>
                                            <div class="col-sm-9">
                                                <input id="purches_product_price" class="form-control" type="number"
                                                    placeholder="Product Price" name="purches_product_price"
                                                    value="{{ old('purches_product_price') }}">
                                                @error('purches_product_price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Reqular Price**</label>
                                            <div class="col-sm-9">
                                                <input id="regular_product_price" class="form-control" type="number"
                                                    placeholder="Regular Product Price" name="regular_product_price"
                                                    value="{{ old('regular_product_price') }}">
                                                @error('regular_product_price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>



                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Product Discount(%)</label>
                                            <div class="col-sm-9">
                                                <input id="product_discount_price" class="form-control" type="number"
                                                    placeholder="Regular Product Price" name="product_discount_price"
                                                    value="{{ old('product_discount_price') }}">
                                                @error('product_discount_price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="mb-4 row align-items-center">
                                            <label for="short_description" class="form-label col-sm-3 mb-0">Product Short
                                                Description</label>

                                            <div class="col-sm-9">
                                                <textarea id="short_description" class="form-control" rows="3" name="short_description"></textarea>
                                                @error('short_description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>



                                        <div class="mb-4 row align-items-center">
                                            <label for="long_description" class="form-label col-sm-3 mb-0">Product Long
                                                Description</label>

                                            <div class="col-sm-9">
                                                <textarea id="long_description" class="form-control" rows="3" name="long_description"></textarea>
                                                @error('long_description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label for="additonal_information" class="form-label col-sm-3 mb-0">Additional
                                                Infromation</label>
                                            <div class="col-sm-9">
                                                <textarea id="additonal_information" class="form-control" rows="3" name="additonal_information"></textarea>
                                                @error('additonal_information')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="mb-4 row align-items-center">
                                            <label for="care_instruction" class="form-label col-sm-3 mb-0">Care
                                                Instruction</label>
                                            <div class="col-sm-9">
                                                <textarea id="care_instruction" class="form-control" rows="3" name="care_instruction"></textarea>
                                                @error('care_instruction')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>




                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Product Thumbnail</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="file" name="product_thumbnail">
                                            </div>
                                            @error('product_thumbnail')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Product Features Photo</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="file" name="product_features_photo">
                                            </div>
                                            @error('product_features_photo')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0"></label>
                                            <div class="col-sm-9">
                                                <button type="submit" class="btn btn-danger">Add Product</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- New Product Add End -->

        <!-- footer Start -->
        <div class="container-fluid">
            <footer class="footer">
                <div class="row">
                    <div class="col-md-12 footer-copyright text-center">
                        <p class="mb-0">Copyright 2022 © Fastkart theme by pixelstrap</p>
                    </div>
                </div>
            </footer>
        </div>
        <!-- footer En -->
    </div>
    <!-- Container-fluid End -->
    </div>
    <!-- Page Body End -->
    </div>
    <!-- page-wrapper End -->

    <!-- Modal Start -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <h5 class="modal-title" id="staticBackdropLabel">Logging Out</h5>
                    <p>Are you sure you want to log out?</p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    <div class="button-box">
                        <button type="button" class="btn btn--no" data-bs-dismiss="modal">No</button>
                        <button type="button" class="btn  btn--yes btn-primary">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal End -->
@endsection
