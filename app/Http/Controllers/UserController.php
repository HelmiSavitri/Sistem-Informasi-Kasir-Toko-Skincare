<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Variabel untuk data umum
    protected $title = 'Users';
    protected $menu = 'users';
    protected $directory = 'admin.users'; // Diubah ke folder view users

    public function index()
    {
        // Menyiapkan array untuk dikirim ke view

    $data['title'] = $this->title;

    $data['menu'] = $this->menu;



    // Mengambil data dari database

    $data['users'] = User::where('role', 'Siswa')->latest()->get();



    // Me-return view beserta data

    return view($this->directory . '.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       // Menyiapkan array untuk dikirim ke view
    $data['title'] = $this->title;
    $data['menu'] = $this->menu;

    // Me-return view beserta data
    return view($this->directory . '.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi data

    $validatedData = $request->validate([

        'name' => 'required|max:255',

        'email' => 'required|email|unique:users',

        'password' => 'required|min:5',

        'role' => 'required'

    ]);



    // 2. Enkripsi password

    $validatedData['password'] = Hash::make($validatedData['password']);



    // 3. Simpan data ke database

    $user = User::create($validatedData);



    // 4. Redirect dengan pesan sukses

    if ($user) {

        return redirect()->route('users.index')->with([

            'status' => 'success',

            'title' => 'Berhasil',

            'message' => 'Data Berhasil Ditambahkan!'

        ]);

    } else {

        return redirect()->route('users.index')->with([

            'status' => 'danger',

            'title' => 'Gagal',

            'message' => 'Data Gagal Ditambahkan!'

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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Menyiapkan array untuk dikirim ke view
    $data['title'] = $this->title;
    $data['menu'] = $this->menu;

    // Mencari data user berdasarkan ID
    $data['user'] = User::findOrFail($id);

    // Me-return view beserta data
    return view($this->directory . '.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       // 1. Cari data user berdasarkan ID

    $user = User::findOrFail($id);



    // 2. Validasi data

    $validatedData = $request->validate([

        'name' => 'required|max:255',

        'email' => 'required|email|unique:users,email,' . $id,

        'password' => 'nullable|min:5', // Password boleh kosong

        'role' => 'required'

    ]);



    // 3. Menyiapkan data untuk diupdate

    $updateData = [

        'name' => $validatedData['name'],

        'email' => $validatedData['email'],

        'role' => $validatedData['role'],

    ];

    // 4. Jika password diisi, enkripsi dan tambahkan ke data update

    if ($request->filled('password')) {

        $updateData['password'] = Hash::make($validatedData['password']);

    }

    // 5. Update data di database

    $updateProcess = $user->update($updateData);

    // 6. Redirect dengan pesan sukses

    if ($updateProcess) {

        return redirect()->route('users.index')->with([

            'status' => 'success',

            'title' => 'Berhasil',

            'message' => 'Data Berhasil Diubah!'

        ]);

    } else {

        return redirect()->route('users.index')->with([

            'status' => 'danger',

            'title' => 'Gagal',

            'message' => 'Data Gagal Diubah!'

        ]);

    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
            // 1. Cari data user berdasarkan ID

    $user = User::findOrFail($id);

    // 2. Lakukan proses delete

    if ($user) {

        $user->delete();
        // 3. Jika berhasil, redirect dengan pesan sukses

        return redirect()->route('users.index')->with([

            'status' => 'success',

            'title' => 'Berhasil',

            'message' => 'Data Berhasil Dihapus!'

        ]);

    } else {

        // 4. Jika gagal, redirect dengan pesan gagal

        return redirect()->route('users.index')->with([

            'status' => 'danger',

            'title' => 'Gagal',

            'message' => 'Data Gagal Dihapus!'

        ]);

    }
    }
}
