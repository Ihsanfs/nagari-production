<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use App\Models\instansi;
use App\Models\Sosialmedia;
use App\Models\sosmedinstansi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class InstansiController extends Controller
{

    public function __construct()
    {
        $this->middleware('setUserRole');
    }

    public function index(Request $request)
    {
        $instansi = Instansi::first();
        $media = [];
        if ($instansi) {
            $media = SosmedInstansi::where('instansi_id', $instansi->id)->get();
        }
        $role = $request->role;

        return view('form.instansi.index', compact('instansi', 'role', 'media'));
    }


    public function edit(Request $request, $id)
    {
        $instansi = instansi::find($id);
        $role = $request->role;
        $media = sosmedinstansi::whereIn('instansi_id', $instansi->pluck('id'))->get();
        // dd($media_data);
        $media_data = Sosialmedia::get();

        return view('form.instansi.edit', compact('instansi', 'role', 'media', 'media_data'));
    }

    public function create(Request $request)
    {
        $role = $request->role;
        $media = Sosialmedia::all();

        return view('form.instansi.create', ['role' => $role, 'media' => $media]);
    }
    public function update(Request $request, $id)
    {
        try {
            // Validasi input
            $rules = [
                'deskripsi_profil' => 'required',
                'nama' => 'required|string|max:255',
                'nagari' => 'required|string|max:255',
                'kecamatan' => 'required|string|max:255',
                'kabupaten' => 'required|string|max:255',
                'sambutan' => 'required',

            ];

            $messages = [
                'deskripsi_profil.required' => 'Deskripsi profil wajib diisi.',
                'nama.required' => 'Nama wajib diisi.',
                'nama.string' => 'Nama harus berupa string.',
                'nama.max' => 'Nama maksimal 255 karakter.',
                'nagari.required' => 'Nagari wajib diisi.',
                'nagari.string' => 'Nagari harus berupa string.',
                'nagari.max' => 'Nagari maksimal 255 karakter.',
                'kecamatan.required' => 'Kecamatan wajib diisi.',
                'kecamatan.string' => 'Kecamatan harus berupa string.',
                'kecamatan.max' => 'Kecamatan maksimal 255 karakter.',
                'kabupaten.required' => 'Kabupaten wajib diisi.',
                'kabupaten.string' => 'Kabupaten harus berupa string.',
                'kabupaten.max' => 'Kabupaten maksimal 255 karakter.',
                'sambutan.required' => 'Sambutan wajib diisi.',

            ];



            $this->validate($request, $rules, $messages);

            $instansi = Instansi::findOrFail($id);
            $instansi->deskripsi_profil = $request->deskripsi_profil;
            $instansi->nama = $request->nama;
            $instansi->nagari = $request->nagari;
            $instansi->kecamatan = $request->kecamatan;
            $instansi->kabupaten = $request->kabupaten;
            $instansi->sambutan = $request->sambutan;

            // Simpan gambar instansi
            $rand = rand(10, 999);

            if ($request->hasFile('gambar_instansi')) {
                if ($instansi->foto_instansi) {
                    @unlink(public_path($instansi->foto_instansi));
                }
                $file = $request->file('gambar_instansi');
                $fileName = $rand . '_' . $file->getClientOriginalName();
                $filePath = 'images/profil/' . $fileName;
                $file->move(public_path('images/profil'), $fileName);
                $instansi->foto_instansi = $filePath;
            }

            // Simpan gambar kepala
            if ($request->hasFile('gambar_kepala')) {
                if ($instansi->foto_kepala) {
                    @unlink(public_path($instansi->foto_kepala));
                }
                $file = $request->file('gambar_kepala');
                $fileName = $rand . '_' . $file->getClientOriginalName();
                $filePath = 'images/profil/' . $fileName;
                $file->move(public_path('images/profil'), $fileName);
                $instansi->foto_kepala = $filePath;
            }

            $instansi->save();

            // Simpan media sosial

            $media = $request->input('media', []);
            $urls = $request->input('sosmed_url', []);

            SosmedInstansi::where('instansi_id', $instansi->id)->delete();

            if (!empty($media) && is_array($media)) {
                foreach ($media as $index => $sosial_media_id) {
                    $url = $urls[$index] ?? null;

                    if (!is_null($sosial_media_id) && !is_null($url)) {
                        SosmedInstansi::create([
                            'sosial_media_id' => $sosial_media_id,
                            'url' => $url,
                            'instansi_id' => $instansi->id,
                        ]);
                    }
                }
            }



            $role = $request->role;
            return redirect()->route($role . '.instansi')->with('success', 'Data berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }






    public function destroy()
    {

    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'nama' => 'required|string|max:255',
                'nagari' => 'required|string|max:255',
                'kecamatan' => 'required|string|max:255',
                'kabupaten' => 'required|string|max:255',
                'sambutan' => 'required',
                'deskripsi_profil' => 'required',
                'gambar_instansi' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'gambar_kepala' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ], [
                'nama.required' => 'Nama instansi wajib di isi',
                'nagari.required' => 'Nagari wajib di isi',
                'kecamatan.required' => 'Kecamatan wajib di isi',
                'kabupaten.required' => 'Kabupaten wajib di isi',
                'sambutan.required' => 'Kata-kata sambutan wajib di isi',
                'deskripsi_profil.required' => 'Deskripsi profil instansi wajib di isi',
                'gambar_instansi.image' => 'Gambar harus berupa file gambar (jpeg, png, jpg, gif)',
                'gambar_instansi.mimes' => 'Gambar harus berformat jpeg, png, jpg, atau gif',
                'gambar_instansi.max' => 'Gambar maksimal 2 MB',
                'gambar_kepala.image' => 'Gambar harus berupa file gambar (jpeg, png, jpg, gif)',
                'gambar_kepala.mimes' => 'Gambar harus berformat jpeg, png, jpg, atau gif',
                'gambar_kepala.max' => 'Gambar maksimal 2 MB',
            ]);


            $instansi = new Instansi();
            $instansi->nama = $request->nama;
            $instansi->sambutan = $request->sambutan;
            $instansi->nagari = $request->nagari;
            $instansi->deskripsi_profil = $request->deskripsi_profil;
            $instansi->kecamatan = $request->kecamatan;
            $instansi->kabupaten = $request->kabupaten;

            $rand = rand(10, 999);

            // Proses gambar_instansi
            if ($request->hasFile('gambar_instansi')) {
                $file = $request->file('gambar_instansi');
                $fileName = $rand . '_' . $file->getClientOriginalName();
                $filePath = 'images/profil/' . $fileName;
                $file->move(public_path('images/profil'), $fileName);
                $instansi->foto_instansi = $filePath;
            }

            // Proses gambar_kepala instansi
            if ($request->hasFile('gambar_kepala')) {
                $file = $request->file('gambar_kepala');
                $fileName = $rand . '_' . $file->getClientOriginalName();
                $filePath = 'images/profil/' . $fileName;
                $file->move(public_path('images/profil'), $fileName);
                $instansi->foto_kepala = $filePath;
            }

            $instansi->save();

            $media = $request->input('media',[]);
            $urls = $request->input('sosmed_url',[]);

            if (!empty($media) && is_array($media)) {
                foreach ($media as $index => $sosial_media_id) {
                    $url = $urls[$index] ?? null;

                    if (!is_null($sosial_media_id) && !is_null($url)) {
                        SosmedInstansi::create([
                            'sosial_media_id' => $sosial_media_id,
                            'url' => $url,
                            'instansi_id' => $instansi->id,
                        ]);
                    }
                }
            }

            $role = $request->role;

            return redirect()->route($role . '.instansi')->with('success', 'Data berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', $e->getMessage());
        }
    }

    public function remove(Request $request, $id)
    {
        $media = sosmedinstansi::find($id);

        if (!$media) {
            return response()->json(['error' => 'Media not found.'], 404);
        }

        $media->delete();

        return response()->json('Data berhasil dihapus.');
    }



}
