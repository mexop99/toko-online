<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::paginate(10);
        $filterKeyword = $request->get('keyword');
        if ($filterKeyword) {
            $categories = Category::where("name", "LIKE", "%$filterKeyword%")->paginate(10);
        }
        return view('categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**
         * VALIDASI CREATE CATEGORY
         */

        Validator::make($request->all(),[
            "name" => "required|min:3|max:20",
            "image" => "required"
        ])->validate();

        $name = $request->get('name');
        $new_category = new Category;
        $new_category->name = $name;

        if ($request->file('image')) {
            $image_path = $request->file('image')->store('category_image', 'public');
            $new_category->image = $image_path;
        }
        $new_category->created_by = \Auth::user()->id;
        $new_category->slug = \Str::slug($name,'-');
        $new_category->save();
        return redirect()->route('categories.index')->with('status', 'Category Successfully Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.show', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category_to_edit = Category::findOrFail($id);
        return view('categories.edit', ['category'=>$category_to_edit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /**
         * VALIDASI UPDATE CATEGORY
         */

        Validator::make($request->all(),[
            "name"=>"required|min:3|max:20"
        ])->validate();


        $name = $request->get('name');

        $category = Category::findOrFail($id);
        $category->name = $name;

        if ($request->file('image')) {
            if ($category->image && file_exists(storage_path('app/public' . $category->image))) {
                \Storage::delete('public/'. $category->image);
            }
            $new_image = $request->file('image')->store('category_image', 'public');
            $category->image = $new_image;
        }
        $category->updated_by = \Auth::user()->id;
        $category->slug = \Str::slug($name);
        $category->save();
        return redirect()->route('categories.edit', [$id])->with('status', 'Category Successfully Updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')->with('status', 'Category Successfully Deleted!');
    }

    public function trash()
    {
        $deleted_category = Category::onlyTrashed()->paginate(10);
        return view('categories.trash', ['categories'=>$deleted_category]);
    }

    public function restore($id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        if ($category->trashed()) {
            $category->restore();
        }else {
            return redirect()->route('categories.index')->with('status', 'Category is Not in trash');
        } 
        return redirect()->route('categories.index')->with('status', 'Category Successfully Restored!');
    }

    public function deletePermanent($id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        if (!$category->trashed()) {
            return redirect()->route('categories.index')->with('status', 'Category is Not in trash');
        }else {
            $category->forceDelete();
            return redirect()->route('categories.index')->with('status', 'Category Successfully Deleted Permanent!');
        } 
        
    }
    public function ajaxSearch(Request $request)
    {
        $keyword = $request->get('q');

        $categories = Category::where("name", "LIKE", "%$keyword%")->get();
        return $categories;
    }

}
