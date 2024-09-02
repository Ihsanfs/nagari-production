<?php

namespace App\Http\Controllers;

use App\Models\pelayanan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PelayananController extends Controller
{

    public function __construct()
    {
        $this->middleware('setUserRole');
    }

    public function index(Request $request)
    {
        $role = $request->role;

        $pelayanan = pelayanan::all();
        return view('form.pelayanan.index', compact('role', 'pelayanan'));
    }

    public function create(Request $request)
    {
        $role = $request->role;
        return view('form.pelayanan.create', compact('role'));
    }

    public function store(Request $request)
    {
        $role = $request->role;

        try {

            $this->validate($request, [
                'nama_pelayanan' => 'required',
                'gambar_layanan' => 'required|image|mimes:jpeg,jpg,png',
                'deskripsi' => 'required',
                'is_active' => 'required',
                'tanggal' => 'required',
            ], [
                'nama_pelayanan.required' => 'Judul wajib diisi.',
                'gambar_layanan.required' => 'Wajib memasukkan gambar.',
                'gambar_layanan.image' => 'Harus memilih file gambar.',
                'gambar_layanan.mimes' => 'Format gambar yang didukung: JPEG, JPG, PNG.',
                'deskripsi.required' => 'Deskripsi harus berupa teks.',
                'is_active.required' => 'status wajib di isi',
                'tanggal.required' => 'Tanggal harus dalam format tanggal yang valid.',
            ]);

            $pelayanan = new Pelayanan();
            $pelayanan->nama_pelayanan = $request->nama_pelayanan;
            $pelayanan->slug = Str::slug($request->nama_pelayanan);
            $pelayanan->deskripsi = $request->deskripsi;
            $pelayanan->is_active = $request->is_active;
            $pelayanan->tanggal = $request->tanggal;
            $pelayanan->user_id = Auth::user()->id;

            if ($request->hasFile('gambar_layanan')) {
                $file = $request->file('gambar_layanan');
                $rand = rand(10, 999);
                $fileName = $file->getClientOriginalName();
                $filePath = 'images/layanan/' . $rand . $fileName;
                $file->move(public_path('images/layanan'), $rand . $fileName);
                $pelayanan->gambar_layanan = $filePath;
            }
            // dd($pelayanan);
            $pelayanan->save();


            return redirect()->route($role . '.pelayanan')->with('success', 'Data berhasil disimpan');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        $role = $request->role;

        try {
            $this->validate($request, [
                'nama_pelayanan' => 'required',
                'gambar_layanan' => 'nullable|image|mimes:jpeg,jpg,png',
                'deskripsi' => 'required',
                'is_active' => 'required',
                'tanggal' => 'required',
            ], [
                'nama_pelayanan.required' => 'Judul wajib diisi.',
                'gambar_layanan.image' => 'Harus memilih file gambar.',
                'gambar_layanan.mimes' => 'Format gambar yang didukung: JPEG, JPG, PNG.',
                'deskripsi.required' => 'Deskripsi harus berupa teks.',
                'is_active.required' => 'status wajib di isi',
                'tanggal.required' => 'Tanggal harus dalam format tanggal yang valid.',
            ]);


            $pelayanan = Pelayanan::find($id);


            $pelayanan->nama_pelayanan = $request->nama_pelayanan;
            $pelayanan->slug = Str::slug($request->nama_pelayanan);
            $pelayanan->deskripsi = $request->deskripsi;
            $pelayanan->is_active = $request->is_active;
            $pelayanan->tanggal = $request->tanggal;
            $pelayanan->user_id = Auth::user()->id;

            if ($request->hasFile('gambar_layanan')) {
                $file = $request->file('gambar_layanan');
                $rand = rand(10, 999);
                $fileName = $file->getClientOriginalName();
                $filePath = 'images/layanan/' . $rand . $fileName;
                $file->move(public_path('images/layanan'), $rand . $fileName);
                $pelayanan->gambar_layanan = $filePath;
            }

            $pelayanan->update();

            return redirect()->route($role . '.pelayanan')->with('success', 'Data berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
    public function destroy(Request $request, $id)
    {
        $layanan = pelayanan::find($id);
        if (!$layanan) {
            return back()->with(['error' => 'Gambar Layanan tidak ditemukan']);
        }

        if ($layanan->gambar_layanan) {
            $filePath = public_path($layanan->gambar_layanan);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        $layanan->delete();
        $role = $request->role;

        return back()->with(['success' => 'layanan berhasil dihapus']);
    }

    public function edit(Request $request,$id){
        $layanan = pelayanan::find($id);
        $role = $request->role;

        return view('form.pelayanan.edit', compact('layanan','role'));

    }

}
