<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function addProduct(Request $req){
        $product = new Product;
        $product->name = $req->input('name');
        $product->price = $req->input('price');
        $product->description = $req->input('desc');
        $product->file_path = $req->file('file')->store('products');
        if( $product->save())
        {
            return response([
            'success'=>"Data has been saved"
            ]); 
        } else{
            return response([
            'error'=>"Error while uploading data"
            ]);  
        } 
    }

    public function list(){
        $product = Product::All();
        return $product;
    }
    
    public funcTion delete($id){
        $result = Product::where('id',$id)->delete();
        if($result){
            return ['result'=>"Product has been deleted"];
        }else{
            return ['result'=>"Operation Failed "];
        }
    }

    public function getProduct($id){
        return Product::find($id);
    }

    public function updateProduct($id, Request $req){
        $product = Product::find($id);
        $product->name = $req->input('name');
        $product->price = $req->input('price');
        $product->description = $req->input('desc');
        if($req->file('file')){
            $product->file_path = $req->file('file')->store('products');
        }       
        if( $product->save())
        {
            return response([
            'success'=>"Data has been updated"
            ]); 
        } else{
            return response([
            'error'=>"Error while updating data"
            ]);  
        } 
    }

    public function search($key){
        return Product::where('name','LIKE','%'.$key.'%')->get();
    }
}
