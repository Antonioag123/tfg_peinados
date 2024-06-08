<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
       
        return view('admin_user.product.product_index',compact('products'));
    }

    public function addProduct($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart',[]);
        if(isset($cart[$id])){
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' =>$product->name,
                'quantity' =>1,
                'price'=>$product->price,
                'url'=>$product->url 
            ];
        }
        session()->put('cart',$cart);
        return redirect()->back();
    }

    public function deleteProductCart(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     */
     public function create()
    {
         //No se usa. 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   // Si la peticion ajax se manda correctamente
        if($request->ajax()){

            $producto=Product::create([
                'name'=>$request->name_product,
                'url'=>$request->url,
                'description'=>$request->description,
                'price'=>$request->price,
                'stock'=>$request->stock
            ]);

            //Si se ha registrado correctamente
            if($producto){
                return response()->json([ 
                    'code'=>200,
                    'msg' => 'success',
                    'message' => 'Product stored correctly'
                ],200);
            } else { //Si no se ha registrado bien en la bbdd
                return response()->json([ 
                    'code'=>404,
                    'msg' => 'error',
                    'message' => 'Error, we can not register this product'
                ],404);
            }           
        }
    }

    public function listar_productos()
    {        
        return view('admin_user.cart.cart_show');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product):View
    {
        return view('admin.privilege.privilege_edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    { 
       //
    }

}
