<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Book::all();

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil ditampilkan',
            'data' => $data,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'   => 'required',
            'author'  => 'required',
            'publish' => 'required|date',
        ], [
            'title.required'   => 'Title is required.',
            'author.required'  => 'Author is required.',
            'publish.required' => 'Publish date is required.',
            'publish.date'     => 'Must be date.',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Data gagal ditambah',
                'data' => $validator->errors(),
            ], 422);
        }

        Book::create([
            'title'    => $request->title,
            'author'   => $request->author,
            'publish'  => $request->publish,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil ditambah',
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Book::find($id);

        if($data){
            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'data' => $data,
            ], 200);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $book = Book::find($id);

        if(empty($book)){
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'title'   => 'required',
            'author'  => 'required',
            'publish' => 'required|date',
        ], [
            'title.required'   => 'Title is required.',
            'author.required'  => 'Author is required.',
            'publish.required' => 'Publish date is required.',
            'publish.date'     => 'Must be date.',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Data gagal diupdate',
                'data' => $validator->errors(),
            ], 422);
        }

        Book::where('id', $id)->update([
            'title'    => $request->title,
            'author'   => $request->author,
            'publish'  => $request->publish,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil diupdate',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::find($id);

        if(empty($book)){
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        $book->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dihapus',
        ], 200);
    }
}
