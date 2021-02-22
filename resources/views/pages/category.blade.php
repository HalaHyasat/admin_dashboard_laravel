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
                            <form action="category" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="category_name" class="control-label mb-1">Category Name</label>
                                    <input  name="category_name" type="text" class="form-control" value="{{ old('category_name') }}">
                                    @if ($errors->has('category_name'))
                                        <div class="alert alert-danger">{{ $errors->first('category_name') }}</div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="category_description" class="control-label mb-1">Category Description</label>
                                    <input  name="category_description" type="text" class="form-control" value="{{ old('category_description') }}">
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
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block" name="submit">Add
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row m-t-30">
                <div class="col-md-12">
                    <!-- DATA TABLE-->
                    <div class="table-responsive m-b-40">
                        <table class="table table-borderless table-data3">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{$category->id}}</td>
                                    <td> <div class="image img-cir img-40">
                                            <img src="images/{{$category->category_image}}">
                                        </div>
                                    </td>
                                    <td>{{$category->category_name}}</td>
                                    <td>
                                        <a href="{{ route('category.edit', $category->id)}}" class="text-warning">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('category.destroy', $category->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-danger" type="submit">Delete</button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- END DATA TABLE-->
                </div>
            </div>
        </div>
    </div>
@endsection
