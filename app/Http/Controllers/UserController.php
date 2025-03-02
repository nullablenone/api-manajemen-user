<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        try {
            // Ambil semua data pengguna
            $users = User::all();

            // Cek apakah data pengguna ada
            if ($users->isEmpty()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Tidak ada data pengguna',
                    'data' => [],
                ], 200); // Tetap 200 karena bukan error, hanya data kosong
            }

            // Return respons sukses jika ada data
            return response()->json([
                'success' => true,
                'message' => 'Data pengguna berhasil diambil',
                'data' => $users,
            ], 200); // Status 200: OK

        } catch (\Exception $e) {
            // Tangkap error tak terduga
            return response()->json([
                'success' => false,
                'message' => 'Terjadi error: ' . $e->getMessage(),
            ], 500); // Status 500: Internal Server Error
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        try {
            $user = User::create($validatedData);

            // Jika proses penyimpanan berhasil
            if ($user) {
                return response()->json([
                    'success' => true,
                    'message' => 'Pengguna berhasil dibuat',
                    'data' => $user,
                ], 201);
            }
            // Jika penyimpanan gagal tanpa exception
            else {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menyimpan pengguna',
                ], 500); // Gunakan kode status 500 untuk error server.
            }
        }
        // Tangkap error lain yang tak terduga
        catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi error: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            // Cari user berdasarkan ID, gunakan findOrFail untuk otomatis return 404 jika tidak ditemukan
            $user = User::findOrFail($id);

            // Return respons sukses jika user ditemukan
            return response()->json([
                'success' => true,
                'message' => 'Pengguna ditemukan',
                'data' => $user,
            ], 200); // Status 200: OK

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Jika user tidak ditemukan
            return response()->json([
                'success' => false,
                'message' => 'Pengguna tidak ditemukan',
            ], 404); // Status 404: Not Found

        } catch (\Exception $e) {
            // Tangkap error lain yang tak terduga
            return response()->json([
                'success' => false,
                'message' => 'Terjadi error: ' . $e->getMessage(),
            ], 500); // Status 500: Internal Server Error
        }
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id, // Update: Tambahkan pengecualian ID untuk validasi email agar tidak konflik.
        ]);

        try {
            // Cari user berdasarkan ID, gunakan findOrFail agar otomatis return 404 kalau tidak ditemukan
            $user = User::findOrFail($id);

            // Update data user dengan data yang sudah divalidasi
            $user->update($validatedData);

            // Return respons sukses
            return response()->json([
                'success' => true,
                'message' => 'Pengguna berhasil diperbarui', // Pesan sukses
                'data' => $user, // Data user setelah diupdate
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Jika user tidak ditemukan
            return response()->json([
                'success' => false,
                'message' => 'Pengguna tidak ditemukan', // Pesan error
            ], 404); // Status 404: Not Found

        } catch (\Exception $e) {
            // Tangkap error lain yang tak terduga
            return response()->json([
                'success' => false,
                'message' => 'Terjadi error: ' . $e->getMessage(), // Pesan error detail untuk debugging
            ], 500); // Status 500: Internal Server Error
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id); // Cari user, kalau gak ada auto-404
            $user->delete(); // Hapus user

            return response()->json([
                'success' => true,
                'message' => 'Pengguna berhasil dihapus',
            ], 200); // Status OK
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Pengguna tidak ditemukan',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi error di server',
            ], 500);
        }
    }
}
