@extends('layouts.app')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">Manage Category</div>
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Create Category</h3>
                            </div>
                            <hr>
                            @if ($message = Session::get('successCategory'))
                                <div class="alert alert-success">
                                    <p>{{ $message }}</p>
                                </div>
                            @endif
                            <form action="{{ route('category.update', $category->id) }}" method="post" enctype="multipart/form-data">
                                @method('PATCH')
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="category_name" class="control-label mb-1">Category Name</label>
                                    <input  name="category_name" type="text" class="form-control" value="{{ $category-> category_name }}">
                                    @if ($errors->has('category_name'))
                                        <div class="alert alert-danger">{{ $errors->first('category_name') }}</div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="category_description" class="control-label mb-1">Category Description</label>
                                    <input  name="category_description" type="text" class="form-control" value="{{ $category-> category_description }}">
                                    @if ($errors->has('category_description'))
                                        <div class="alert alert-danger">{{ $errors->first('category_description') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="category_image" class="control-label mb-1">Category image</label>
                                    <input  name="category_image" type="file" class="form-control">
                                    @if ($errors->has('category_image'))
                                        <div class="alert alert-danger">{{ $errors->first('category_image') }}</div>
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
