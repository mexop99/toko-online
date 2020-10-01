<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('keyword') ? $request->get('keyword'): '';
        $status = $request->get('status');
        // dd($status);

        if ($status) {
            $products = Product::with('categories')->where('title', "LIKE", "%$keyword%")->where('status', strtoupper($status))->paginate(5);
        }else {
            $products = Product::with('categories')->paginate(5);
        }

        // $products = Product::with('categories')->paginate(5);
        return view('products.index', ['products'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_product = new Product;
        $new_product->title =$request->get('title');
        $new_product->description =$request->get('description');
        $new_product->price =$request->get('price');
        $new_product->stock =$request->get('stock');
        $new_product->status =$request->get('save_action');
        $new_product->slug = \Str::slug($request->get('title'));
        $new_product->created_by = \Auth::user()->id;
        
        /**
         * mengambil nilai gambar
         */
        $image = $request->file('image');
        if ($image) {
            $image_path = $image->store('product_images', 'public');
            $new_product->image = $image_path;
        }
        /**
         * SAVE 
         */
        $new_product->save();


        /**
         * mengambil nilai kategori, 
         * dan memasukan ke table category_product
         */
        $new_product->categories()->attach($request->get('categories'));


        if ($request->get('save_action') == 'PUBLISH') {
            return redirect()->route('products.create')->with('status', 'Product Succesfully Published!');
        }else {
            return redirect()->route('products.create')->with('status', 'Product Save a Draft!');            
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', ['product'=>$product]);
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
        $product = Product::findOrFail($id);

        $product->title = $request->get('title');
        $product->slug = \Str::slug($request->get('title'));
        $product->description = $request->get('description');
        $product->stock = $request->get('stock');
        $product->price = $request->get('price');
        $product->status = $request->get('status');
        $product->updated_by = \Auth::user()->id;

        $new_image = $request->get('image');
        if ($new_image) {
            if ($product->image && file_exists(storage_path('app/public/' . $product->image))) {
                \Storage::delete('public/'.$product->image);
            }
            $new_image_path = $new_image->store('product_images', 'public');
            $product->image = $new_image_path;
        }
        $product->save();

        /**
         * update categori
         */
        $product->categories()->sync($request->get('categories'));
        return redirect()->route('products.edit', [$product->id])->with('status', 'Product successfully updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.trash')->with('status', 'Product moved to Trash');
    }

    public function trash()
    {
        $products = Product::onlyTrashed()->paginate(5);
        return view('products.trash', ['products'=>$products]);
    }

    public function restore($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        if ($product->trashed()) {
            $product->restore();
            return redirect()->route('products.trash')->with('status', 'book successfully restored!');
        }else {
            return redirect()->route('products.trash')->with('status', 'book is not in trash!');
        }
    }

    public function deletePermanent($id)    
    {
        $product = Product::withTrashed()->findOrFail($id);
        if (!$product->trashed()) {
            return redirect()->route('product.trash')->with('status', 'Product is not in trash');
        } else {
            $product->categories()->detach();
            $product->forceDelete();
            return redirect()->route('products.trash')->with('status', 'Product permanently deleted!');

        }
        
    }
}
