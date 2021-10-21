<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Models\Store;

class StoreController extends Controller
{

    public function index()
    {
        try {
            $store = Store::with('Products')->get();
            return response()->json([
                'stores' => $store,
                'success_message' => ''
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error_message' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(StoreRequest $request)
    {
        try {
            $store = new Store;
            $store->name = $request->name;
            $store->email = $request->email;
            $store->save();

            return response()->json([
                'store' => $store,
                'success_message' => 'Loja cadastrada com sucesso!'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error_message' => $e->getMessage(),
            ], 500);
        }
    }

    public function show(Store $store)
    {
        try {

            return response()->json([
                'store' => $store,
                'success_message' => ''
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error_message' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(Store $store, StoreRequest $request)
    {
        try {
            $store->name = $request->name;
            $store->email = $request->email;
            $store->save();

            return response()->json([
                'store' => $store,
                'success_message' => 'Loja atualizada com sucesso!'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error_message' => $e->getMessage(),
            ], 500);
        }
    }

    public function delete(Store $store)
    {
        try {
            $store->delete();
            return response()->json([
                'store' => '',
                'success_message' => 'Loja removida com sucesso!'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error_message' => $e->getMessage(),
            ], 500);
        }
    }
}
