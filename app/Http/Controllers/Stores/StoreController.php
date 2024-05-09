<?php

namespace App\Http\Controllers\Stores;

use App\Http\Controllers\Controller;
use App\Domain\Stores\StoreRepositoryInterface;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    protected $storeRepo;

    public function __construct(StoreRepositoryInterface $storeRepo)
    {
        $this->storeRepo = $storeRepo;
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }

    public function index()
    {
        return response()->json($this->storeRepo->all());
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'active' => 'required|boolean'
        ]);

        $store = $this->storeRepo->create($validatedData);
        return response()->json($store, 201);
    }

    public function show($id)
    {
        $store = $this->storeRepo->find($id);
        if (!$store) {
            return response()->json(['message' => 'Store not found'], 404);
        }
        return response()->json($store);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'address' => 'sometimes|required|string',
            'active' => 'sometimes|required|boolean'
        ]);

        $store = $this->storeRepo->update($id, $validatedData);
        return response()->json($store);
    }

    public function destroy($id)
    {
        if ($this->storeRepo->delete($id)) {
            return response()->json(['message' => 'Store deleted successfully'], 204);
        }
        return response()->json(['message' => 'Store not found'], 404);
    }

    public function attachBooks(Request $request, $storeId)
    {
        $store = $this->storeRepo->find($storeId);
        if (!$store) {
            return response()->json(['message' => 'Store not found'], 404);
        }

        $store->books()->attach($request->book_ids);
        return response()->json(['message' => 'Books attached successfully']);
    }

    public function detachBooks(Request $request, $storeId)
    {
        $store = $this->storeRepo->find($storeId);
        if (!$store) {
            return response()->json(['message' => 'Store not found'], 404);
        }

        $store->books()->detach($request->book_ids);
        return response()->json(['message' => 'Books detached successfully']);
    }

    public function getBooks($storeId)
    {
        $store = $this->storeRepo->find($storeId);
        if (!$store) {
            return response()->json(['message' => 'Store not found'], 404);
        }

        return response()->json($store->books);
    }
}
