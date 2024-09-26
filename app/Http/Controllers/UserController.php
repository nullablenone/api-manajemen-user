<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json([
            'success' => true,
            'data' => $users,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        $user = User::create($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Pengguna berhasil dibuat',
            'data' => $user
        ], 201);
    }

    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'error' => 'Pengguna tidak di temukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $user
        ]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'error' => 'Pengguna tidak di temukan'
            ], 404);
        }

        $user->update($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Pengguna berhasil di perharui',
            'data' => $user
        ]);
    }
}
