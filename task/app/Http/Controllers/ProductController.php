<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
class ProductController extends Controller
{
    public function index()
    {
        $product = Product::with('brand','category')->get();
                    return response()->json($product);
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
    
 if ($request->image) {
         $position = strpos($request->image, ';');
         $sub = substr($request->image, 0, $position);
         $ext = explode('/', $sub)[1];

         $name = time().".".$ext;
         $img = Image::make($request->image)->resize(240,200);
         $upload_path = 'backend/product/';
         $image_url = $upload_path.$name;
         $img->save($image_url);

         $product = new Product;
         $product->category_id = $request->category_id;
         $product->brand_id = $request->brand_id;
         $product->name = $request->name;
         $product->SKE = $request->SKE;
         $product->image = $image_url;
         $product->save(); 
     }else{
        $product = new Product;
         $product->category_id = $request->category_id;
         $product->brand_id = $request->brand_id;
         $product->name = $request->name;
         $product->SKE = $request->SKE;
         
         $product->save(); 

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
        $product = DB::table('products')->where('id',$id)->first();
       return response()->json($product);
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
       $data = array();
        $data['name'] = $request->name;
        $data['SKE'] = $request->SKE;
        $data['category_id'] = $request->category_id;
        $data['brand_id'] = $request->brand_id;
        $image = $request->newimage;

        if ($image) {
         $position = strpos($image, ';');
         $sub = substr($image, 0, $position);
         $ext = explode('/', $sub)[1];

         $name = time().".".$ext;
         $img = Image::make($image)->resize(240,200);
         $upload_path = 'backend/product/';
         $image_url = $upload_path.$name;
         $success = $img->save($image_url);
         
         if ($success) {
            $data['image'] = $image_url;
            $img = DB::table('products')->where('id',$id)->first();
            $image_path = $img->image;
            $done = unlink($image_path);
            $user  = DB::table('products')->where('id',$id)->update($data);
         }
          
        }else{
            $oldphoto = $request->image;
            $data['image'] = $oldphoto;
            $user = DB::table('products')->where('id',$id)->update($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $product = DB::table('products')->where('id',$id)->first();
       $photo = $product->image;
       if ($photo) {
         unlink($photo);
         DB::table('products')->where('id',$id)->delete();
       }else{
        DB::table('products')->where('id',$id)->delete();
       }
    }






}
