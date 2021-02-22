<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index (){
        $categories = Category::all();
        return view('pages.category',compact('categories'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'category_name' => 'required|min:4',
            'category_description' => 'required|max:255',
            'category_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

            $imageName = time().'.'.request()->category_image->getClientOriginalExtension();
            request()->category_image->move(public_path('images'), $imageName);

        $var = new Category();
        $var->category_name = $request->input('category_name');
        $var->category_description = $request->input('category_description');
        $var->category_image = $imageName;

        $var->save();
        return back()->with('successCategory', 'Category created successfully.');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('pages.editCategory', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|min:4',
            'category_description' => 'required|max:255',
            'category_image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        if (!empty(request()->category_image)){
            $imageName = time().'.'.request()->category_image->getClientOriginalExtension();
            request()->category_image->move(public_path('images'), $imageName);
        }
        else {
            $category = Category::find($id);
            $imageName= $category-> category_image;
        }

        $category = Category::find($id);
        $category->category_name =  $request->get('category_name');
        $category->category_description = $request->get('category_description');
        $category->category_image = $imageName;
        $category->save();

        return redirect('/category')->with('successCategory', 'Category updated!');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        return back()->with('successCategory', 'Category deleted!');
    }

}
