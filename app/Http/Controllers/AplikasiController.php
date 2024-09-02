<?php

namespace App\Http\Controllers;

use App\Models\Appnama;
use Illuminate\Http\Request;

class AplikasiController extends Controller
{

    public function __construct()
    {
        $this->middleware('setUserRole');
    }
    public function index(Request $request)
    {

        $app = Appnama::all();
        $role = $request->role;
        return view('form.aplikasi_nama.index', compact('app', 'role'));

    }

    public function update(Request $request, $id)
    {
        try {
            // Perform validation with custom messages
            $this->validate($request, [
                'website' => 'required|string|max:255',
                'lokasi' => 'required|string',
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ], [
                'website.required' => 'Nama website harus diisi.',
                'website.string' => 'Nama website harus berupa teks.',

                'lokasi.required' => 'Lokasi harus diisi.',
                'lokasi.string' => 'Lokasi harus berupa teks.',


                'logo.image' => 'Logo harus berupa file gambar.',
                'logo.mimes' => 'Logo harus berformat: jpeg, png, jpg, gif, atau svg.',
                'logo.max' => 'Ukuran logo tidak boleh lebih dari 2MB.',
            ]);

            // Find the application by ID
            $app = Appnama::find($id);

            // Check if the application exists
            if (!$app) {
                return back()->with(['error' => 'Data Aplikasi Tidak Ditemukan']);
            }

            // Update the application data
            $app->nama_web = $request->website;
            $app->lokasi = $request->lokasi;

            // Check if a new logo file is uploaded
            if ($request->hasFile('logo')) {
                // Delete the old logo file if it exists
                if ($app->logo && file_exists(public_path($app->logo))) {
                    unlink(public_path($app->logo));
                }

                // Save the new logo file
                $file = $request->file('logo');
                $rand = rand(10, 999);
                $fileName = $rand . '_' . $file->getClientOriginalName();
                $filePath = 'logo/website/' . $fileName;
                $file->move(public_path('logo/website/'), $fileName);
                $app->logo = $filePath;
            }

            // Save the changes to the database
            $app->save();

            return back()->with(['success' => 'Data Aplikasi Berhasil Diperbarui']);
        } catch (\Exception $e) {
            // Handle any exceptions and return an error message
            return back()->with(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }



    public function delete($id)
    {
        $app = Appnama::find($id);
        if ($app) {
            if ($app->logo && file_exists(public_path($app->logo))) {

                unlink(public_path($app->logo));
            }
            $app->delete();
            return back()->with(['success' => 'Data Aplikasi Berhasil Dihapus']);
        }
        return back()->with(['error' => 'Data Aplikasi Tidak Ditemukan']);
    }


    public function store(Request $request)
    {

        $this->validate($request, [
            'website' => 'required|string|max:255',
            'lokasi' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'website.required' => 'Nama website harus diisi.',
            'website.string' => 'Nama website harus berupa teks.',


            'lokasi.required' => 'Lokasi harus diisi.',
            'lokasi.string' => 'Lokasi harus berupa teks.',


            'logo.image' => 'Logo harus berupa file gambar.',
            'logo.mimes' => 'Logo harus berformat: jpeg, png, jpg, gif, atau svg.',
            'logo.max' => 'Ukuran logo tidak boleh lebih dari 2MB.',
        ]);

        try {
            $rand = rand(10, 999);
            $app = new Appnama();
            $app->nama_web = $request->website;
            $app->lokasi = $request->lokasi;

            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $fileName = $rand . '_' . $file->getClientOriginalName();
                $filePath = 'logo/website/' . $fileName;
                $file->move(public_path('logo/website/'), $fileName);
                $app->logo = $filePath;
            }

            $app->save();

            return back()->with(['success' => 'Data Aplikasi Berhasil Disimpan']);
        } catch (\Exception $e) {
            return back()->with(['error' => 'Error: ' . $e->getMessage()]);
        }
    }




}
