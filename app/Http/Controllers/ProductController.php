<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Mail\NotificationMail;
use App\Models\Product;
use App\Models\Store;
use Mail;

class ProductController extends Controller
{
    public function index()
    {
        try {
            $products = Product::with('Store')->get();

            return response()->json([
                'products' => $products,
                'success_message' => ''
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error_message' => $e->getMessage(),
            ], 500);
        }


    }

    public function store(ProductRequest $request)
    {
        try {
            $product = new Product;
            $product->name = $request->name;
            $product->valor = $request->valor;
            $product->store_id = $request->store_id;
            $product->active = $request->active;
            $product->save();

            $store = Store::find($request->store_id);

            $mail = new \stdClass();
            $mail->subject = 'Novo produto cadastrado com sucesso';
            $mail->email = $store->email;
            $mail->name = $store->name;

            Mail::send(new NotificationMail($mail));


            return response()->json([
                'product' => $product,
                'success_message' => 'Produto cadastrado com sucesso'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error_message' => $e->getMessage(),
            ], 500);
        }
    }

    public function show(Product $product)
    {
        try {
            return response()->json([
                'product' => $product,
                'success_message' => ''
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error_message' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(Product $product, ProductRequest $request)
    {
        try {
            $product->name = $request->name;
            $product->valor = $request->valor;
            $product->store_id = $request->store_id;
            $product->active = $request->active;
            $product->save();

            $store = Store::find($request->store_id);

            $mail = new \stdClass();
            $mail->subject = 'produto atulizado com sucesso';
            $mail->email = $store->email;
            $mail->name = $store->name;

            Mail::send(new NotificationMail($mail));

            return response()->json([
                'product' => $product,
                'success_message' => 'Produto atualizado com sucesso'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error_message' => $e->getMessage(),
            ], 500);
        }
    }

    public function delete(Product $product)
    {
        try {
            $product->delete();
            return response()->json([
                'product' => '',
                'success_message' => 'Produto removido com sucesso'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error_message' => $e->getMessage(),
            ], 500);
        }
    }
}
