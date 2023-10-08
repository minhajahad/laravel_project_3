<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Image;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->get();
        return view('backend.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Product::create([
                'product_name'=>$request->product_name,
                'product_slug'=>strtolower(str_replace('','_',$request->product_name)),
                'selling_price'=>$request->selling_price,
                'discount_price'=>$request->discount_price,

                'long_descp'=>$request->long_descp,
                'status'=>1,
                'product_image'=>$this->uploadImage(request()->file('product_image'))
            ]);

            return redirect()->route('products.index')->withMessage('Product created succesfully');

        }catch (QueryException $e ){
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('backend.products.show',[
            'product'=>$product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('backend.products.edit',['product'=>$product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        try {
            $requestData =([
                'product_name'=>$request->product_name,
                'product_slug'=>strtolower(str_replace('','_',$request->product_name)),
                'selling_price'=>$request->selling_price,
                'discount_price'=>$request->discount_price,
                'long_descp'=>$request->long_descp,
                'status'=>1,
                // 'product_image'=>$this->uploadImage(request()->file('product_image'))
            ]);

            if ($request->hasFile('product_image')){
                $requestData['product_image']=$this->uploadImage(request()->file('product_image'));
            }
            $product->update($requestData);

            return redirect()->route('products.index')->withMessage('Product updated succesfully');

        }catch (QueryException $e ){
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->withMessage('Product deleted succesfully');
    }


    public function ProductInactive($id)
    {
        Product::findOrFail($id)->update(['status' => 0]);

        return redirect()->route('products.index')->withMessage('Product Inactive succesfully');
    }

    public function ProductActive($id)
    {
        Product::findOrFail($id)->update(['status' => 1]);

        return redirect()->route('products.index')->withMessage('Product Active succesfully');
    }

    public function uploadImage($file)
    {
        $fileName = time().'.'.$file->getClientOriginalExtension();
        Image::make($file)->resize(800,800)->
        save(storage_path().'/app/public/products/'.$fileName);
        return $fileName;
    }

}
