<?php

namespace App\Http\Controllers\Books;

use App\Http\Controllers\Controller;
use App\Domain\Books\BookRepositoryInterface;
use Illuminate\Http\Request;

class BookController extends Controller
{
    protected $bookRepo;

    public function __construct(BookRepositoryInterface $bookRepo)
    {
        $this->bookRepo = $bookRepo;
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }

    public function index()
    {
        return response()->json($this->bookRepo->all());
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'isbn' => 'required|numeric',
            'value' => 'required|numeric'
        ]);

        $book = $this->bookRepo->create($validatedData);
        return response()->json($book, 201);
    }

    public function show($id)
    {
        $book = $this->bookRepo->find($id);
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        return response()->json($book);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'isbn' => 'sometimes|required|numeric',
            'value' => 'sometimes|required|numeric'
        ]);

        $book = $this->bookRepo->update($id, $validatedData);
        return response()->json($book);
    }

    public function destroy($id)
    {
        if ($this->bookRepo->delete($id)) {
            return response()->json(['message' => 'Book deleted successfully'], 204);
        }
        return response()->json(['message' => 'Book not found'], 404);
    }

    public function attachStores(Request $request, $bookId)
    {
        $book = $this->bookRepo->find($bookId);
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $book->stores()->attach($request->store_ids);
        return response()->json(['message' => 'Stores attached successfully']);
    }

    public function detachStores(Request $request, $bookId)
    {
        $book = $this->bookRepo->find($bookId);
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $book->stores()->detach($request->store_ids);
        return response()->json(['message' => 'Stores detached successfully']);
    }

    public function getStores($bookId)
    {
        $book = $this->bookRepo->find($bookId);
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        return response()->json($book->stores);
    }
}
