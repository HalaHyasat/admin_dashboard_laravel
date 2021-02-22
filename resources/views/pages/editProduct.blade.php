@extends('layouts.app')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">Manage Product</div>
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Edit Product</h3>
                            </div>
                            <hr>
                            @if ($message = Session::get('successProduct'))
                                <div class="alert alert-success">
                                    <p>{{ $message }}</p>
                                </div>
                            @endif
                            <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                                @method('PATCH')
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="product_name" class="control-label mb-1">Product Name</label>
                                    <input  name="product_name" type="text" class="form-control" value="{{ $product-> product_name }}">
                                    @if ($errors->has('product_name'))
                                        <div class="alert alert-danger">{{ $errors->first('product_name') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="product_description" class="control-label mb-1">Product Description</label>
                                    <input  name="product_description" type="text" class="form-control" value="{{ $product-> product_description }}">
                                    @if ($errors->has('product_description'))
                                        <div class="alert alert-danger">{{ $errors->first('product_description') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="category_id" class="control-label mb-1">Category Name</label>
                                    <select  name="category_id" class="form-control">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->category_name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('category_id'))
                                        <div class="alert alert-danger">{{ $errors->first('category_id') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="product_image" class="control-label mb-1">Product image</label>
                                    <input  name="product_image" type="file" class="form-control">
                                    @if ($errors->has('product_image'))
                                        <div class="alert alert-danger">{{ $errors->first('product_image') }}</div>
                                    @endif
                                </div>


                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block" name="submit">Update
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
