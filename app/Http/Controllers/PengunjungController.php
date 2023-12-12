<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengunjungController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Pengunjung::getPengunjung()->paginate(10);
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama_lengkap' => 'required',
            'prodi' => 'required',
            'jurusan' => 'required',
            'fakultas' => 'required',
            'pembimbing' => 'required',
            'timestamp' => 'required',
        ]);

        try {
            $response = Pengunjung::create($validate);
            return response()->json([
                'success' => true,
                'message' => 'success',
                'data' => $response
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error',
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'nama_lengkap' => 'required',
            'prodi' => 'required',
            'jurusan' => 'required',
            'fakultas' => 'required',
            'pembimbing' => 'required',
            'timestamp' => 'required',
        ]);

        try {
            $response = Pengunjung::find($id);

            if (!$response) {
                return response()->json([
                    'success' => false,
                    'message' => 'Record not found',
                ], 404);
            }

            $response->update($validate);

            return response()->json([
                'success' => true,
                'message' => 'success',
                'data' => $response
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error',
                'error' => $e->getMessage()
            ]);
        }
    }

/**
 * Remove the specified resource from storage.
 */
    public function destroy(string $id)
    {
        try {
            $result = Pengunjung::find($id);

            if (!$result) {
                return response()->json([
                    'success' => false,
                    'message' => 'Record not found',
                ], 404);
            }

            $result->delete();

            return response()->json([
                'success' => true,
                'message' => 'success',
                'data' => $result
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error',
                'error' => $e->getMessage()
            ]);
        }
    }
}
