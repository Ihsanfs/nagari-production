<?php

namespace App\Http\Controllers;

use App\Models\pegawai;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PegawaiController extends Controller
{

    public function __construct()
    {
        $this->middleware('setUserRole');
    }

    public function index(Request $request){
        $role = $request->role;
        $pegawai = pegawai::all();


        if ($request->ajax()) {
            return Datatables::of($pegawai)->make(true);
        }
    return view('form.pegawai.index', compact('role','pegawai'));
    }

    public function create(Request $request){
        $role = $request->role;
    return view('form.pegawai.create', compact('role'));


    }

    public function store(Request $request){
        $role = $request->role;

        try {
            $this->validate($request, [
                'nama_pegawai' => 'required',
                'gambar_pegawai' => 'required|image|mimes:jpeg,jpg,png',
                'jabatan' => 'required',
                'tanggal' => 'required',
                'alamat' => 'required',
                'is_active' => 'required'
            ],
            [
                'nama_pegawai.required' => 'Judul wajib diisi.',
                'gambar_pegawai' => 'Wajib memasukkan gambar, bukan file.',
                'jabatan.required' => 'jabatan wajib di isi',
                'tanggal.required' => 'tanggal wajib di isi',
                'alamat.required' => 'alamat wajib di isi',
                'is_active.required' => 'status wajib di isi'
            ]);
            $pegawai = new pegawai();
            $pegawai->nama_pegawai = $request->nama_pegawai;
            $pegawai->jabatan = $request->jabatan;

            if ($request->hasFile('gambar_pegawai')) {
                $file = $request->file('gambar_pegawai');
                $rand = rand(10, 999);
                $fileName = $file->getClientOriginalName();
                $filePath = 'images/pegawai/' . $rand . $fileName;
                $file->move(public_path('images/pegawai'), $rand . $fileName);
                $pegawai->gambar_pegawai = $filePath;
            }
            $pegawai->tanggal = $request->tanggal;
            $pegawai->is_active = $request->is_active;
            $pegawai->alamat = $request->alamat;
            // dd($pegawai);
            $pegawai->save();

            $role = $request->role;

            return redirect()->route($role . '.pegawai')->with('success', 'pegawai berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->with(['error' => 'Error: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, $id){
        try {
            if ($request->hasFile('gambar_pegawai')) {
                $this->validate($request, [
                    'gambar_pegawai' => 'required|image|mimes:jpeg,jpg,png',
                ],
                [
                    'gambar_pegawai' => 'Wajib memasukkan gambar, bukan file.',
                ]);
            }
        } catch (\Exception $e) {
            return back()->with(['error' => 'Error: ' . $e->getMessage()]);
        }

        $this->validate($request, [
            'nama_pegawai' => 'required',

            'jabatan' => 'required',
            'tanggal' => 'required',
            'alamat' => 'required',
            'is_active' => 'required'
        ],
        [
            'nama_pegawai.required' => 'Judul wajib diisi.',

            'jabatan.required' => 'jabatan wajib di isi',
            'tanggal.required' => 'tanggal wajib di isi',
            'alamat.required' => 'alamat wajib di isi',
            'is_active.required' => 'status wajib di isi'
        ]);

        $pegawai = pegawai::find($id);
        if (!$pegawai) {
            return back()->with(['error' => 'pegawai tidak ditemukan']);
        }
        $pegawai->nama_pegawai = $request->nama_pegawai;
        $pegawai->jabatan = $request->jabatan;

        if ($request->hasFile('gambar_pegawai')) {
            $file = $request->file('gambar_pegawai');
            $rand = rand(10, 999);
            $fileName = $file->getClientOriginalName();
            $filePath = 'images/pegawai/' . $rand . $fileName;
            $file->move(public_path('images/pegawai'), $rand . $fileName);
            $pegawai->gambar_pegawai = $filePath;
        }

        $pegawai->tanggal = $request->tanggal;
        $pegawai->is_active = $request->is_active;
        $pegawai->alamat = $request->alamat;
        $pegawai->update();
        return redirect()->back()->with('success', 'pegawai berhasil diperbarui');
    }

    public function destroy(Request $request, $id){
        // dd($id);
        $pegawai = pegawai::find($id);

        if ($pegawai->gambar_pegawai) {
            $filePath = public_path($pegawai->gambar_pegawai);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        $pegawai->delete();
        $role = $request->role;

        return back()->with(['success' => 'pegawai berhasil dihapus']);
    }
}
