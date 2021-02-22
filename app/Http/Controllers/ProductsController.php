<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public function index (){
        $products = DB::table('categories')
            ->join('products', 'categories.id', '=', 'products.category_id')
            ->select('categories.category_name', 'products.*')
            ->get();
        $categories = Category::all();
        return view('pages.products',compact('categories', 'products'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'product_name' => 'required|min:4',
            'product_description' => 'required|max:255',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $imageName = time().'.'.request()->product_image->getClientOriginalExtension();
        request()->product_image->move(public_path('images'), $imageName);

        $var = new Product();
        $var->product_name = $request->input('product_name');
        $var->product_description = $request->input('product_description');
        $var->category_id = $request->input('category_id');
        $var->product_image = $imageName;

        $var->save();
        return back()->with('successProduct', 'Product created successfully.');
    }

    public function edit($id)
    {
        $categories = Category::all();
        $product = Product::find($id);
        return view('pages.editProduct', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product_name' => 'required|min:4',
            'product_description' => 'required|max:255',
            'category_id' => 'required',
            'product_image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        if (!empty(request()->product_image)){
            $imageName = time().'.'.request()->product_image->getClientOriginalExtension();
            request()->product_image->move(public_path('images'), $imageName);
        }
        else {
            $product = Product::find($id);
            $imageName= $product-> product_image;
        }

        $product = Product::find($id);
        $product->product_name =  $request->get('product_name');
        $product->product_description = $request->get('product_description');
        $product->product_image = $imageName;
        $product->category_id = $request->get('category_id');
        $product->save();

        return redirect('/products')->with('successProduct', 'Product updated!');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return back()->with('successProduct', 'Product deleted!');
    }


}
