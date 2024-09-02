<?php

namespace App\Http\Controllers\super;

use App\Http\Controllers\Controller;
use App\Models\halaman;
use App\Models\halamanstatic;
use App\Models\menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use Illuminate\Validation\ValidationException;

class HalamanController extends Controller
{
    public function __construct()
    {
        $this->middleware('setUserRole');
    }

    public function index(Request $request)
    {

        $userRole = Auth::user()->role_id;
        $role = ($userRole == 2) ? 'admin' : 'superadmin';
        $halaman = halaman::with('author_halaman')->paginate(20);
        return view('form.halaman.index', compact('halaman', 'role'));
    }

    public function create(Request $request)
    {
        $menu = Menu::where('is_active', 1)
        ->whereNotIn('status', [2, 4])
        ->get();
        $role = $request->role;

        return view('form.halaman.create', compact('role', 'menu'));
    }

    public function store(Request $request)
    {
        try {


            $validationRules = [
                'judul_halaman' => 'required',
                'deskripsi_h' => 'nullable|required_with:deskripsi',
                'url' => 'nullable|url|required_with:url',
                'urutan' => 'nullable|integer',
                'is_active' => 'required',
                'g_halaman' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ];


            $message = [
                'g_halaman.image' => 'File harus berupa gambar.',
                'g_halaman.mimes' => 'Format gambar yang didukung: jpeg, png, jpg, gif.',
                'g_halaman.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',
            ];


            $this->validate($request, $validationRules, $message);

            $menu = Menu::find($request->nama_h);

            if (!$menu) {
                return back()->with(['error' => 'Menu not found']);
            }

            $pageExists = Halaman::where('menu_id', $menu->id)->where('page_halaman', $request->urutan)->exists();
            if ($pageExists) {
                return back()->with(['warning' => 'Nomor halaman sudah ada']);
            }

            $halaman = new Halaman();
            $halaman->menu_id = $menu->id;
            $halaman->nama = $request->judul_halaman;
            $halaman->slug = Str::slug($request->judul_halaman);
            $halaman->deskripsi = $request->deskripsi_h;
            $halaman->view = 0;
            $halaman->url = $request->url;
            $halaman->page_halaman = $request->urutan;
            $halaman->is_active = $request->is_active;
            $halaman->user_id = Auth::id();
            $rand = rand(10, 999);

            if ($request->hasFile('g_halaman')) {
                $file = $request->file('g_halaman');
                $fileName = $rand . '_' . $file->getClientOriginalName();
                $filePath = 'images/halaman/' . $fileName;
                $file->move(public_path('images/halaman'), $fileName);
                $halaman->gambar_h = $filePath;
            } else {
                $halaman->gambar_h = null;
            }


            $halaman->save();
            $role = $request->role;
            return redirect()->route($role . '.halaman')->with(['success' => 'Halaman berhasil ditambahkan']);
        } catch (\Exception $e) {
            return back()->with(['error' => 'Error: ' . $e->getMessage()]);
        }
    }



    public function edit(Request $request,$id)
    {
        $halaman = halaman::find($id);
        $menu = menu::wherenot('status', 2)->get();

        $role = $request->role;


        // dd($halaman);
        return view('form.halaman.edit', compact('halaman', 'role', 'menu'));
    }

    public function update(Request $request, $id)
    {

        try{
            $validationRules = [
                'judul_halaman' => 'required',
                'deskripsi_h' => 'nullable|required_with:deskripsi',
                'url' => 'nullable|url|required_with:url',
                'urutan' => 'nullable|integer',
                'is_active' => 'required',
                'g_halaman' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ];


            $message = [
                'judul_halaman' => 'judul wajib di isi',
                'g_halaman.image' => 'File harus berupa gambar.',
                'g_halaman.mimes' => 'Format gambar yang didukung: jpeg, png, jpg, gif.',
                'g_halaman.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',
            ];


            $this->validate($request, $validationRules, $message);


            $halaman = halaman::find($id);
            $menu =   menu::find($request->nama_h);

            if ($request->urutan && $menu->id) {

                if ($request->urutan != $halaman->page_halaman || $menu->id != $halaman->menu_id) {
                    $pageExists = Halaman::where('menu_id', $menu->id)
                        ->where('page_halaman', $request->urutan)
                        ->where('user_id', Auth::user()->id)
                        ->exists();
                    if ($pageExists) {
                        return back()->with(['warning' => 'Nomor halaman sudah ada']);
                    }
                    $halaman->page_halaman = $request->urutan;
                    $halaman->menu_id = $menu->id;
                }
            }
            $halaman->nama = $request->judul_halaman;
            $halaman->slug = Str::slug($request->judul_halaman);
            $halaman->deskripsi = $request->deskripsi_h;
            $halaman->user_id = Auth::user()->id;
            $halaman->url = $request->url;
            $halaman->is_active = $request->is_active;
            if (!$request->hasFile('g_halaman')) {
                $halaman->update();
                $role = $request->role;

                return redirect()->route($role . '.halaman')->with(['success' => 'Halaman berhasil diupdate']);
            } else {

                $rand = rand(10, 999);
                $file = $request->file('g_halaman');
                $fileName = $rand . '_' . $file->getClientOriginalName();
                $filePath = 'images/halaman/' . $fileName;
                $file->move(public_path('images/halaman'), $fileName);

                $halaman->gambar_h = $filePath;
                $halaman->update();
                $role = $request->role;

                return redirect()->route($role . '.halaman')->with(['success' => 'Halaman berhasil diupdate']);
            }
        }catch(\Exception $e){
            return back()->with(['error'=> $e->getMessage()]);
        }

    }


    public function destroy($id)
    {

        $halaman = halaman::find($id);

        if (!empty($halaman->gambar_h)) {
            $file_path = public_path($halaman->gambar_h);
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
        $halaman->delete();
        return redirect()->back()->with(['success' => 'Halaman berhasil dihapus']);
    }

    public function halaman_static(Request $request)
    {
   
        $menu = Menu::find($request->pilihhalaman);

        // Check if menu exists
        if (!$menu) {
            return back()->with(['error' => 'Menu not found']);
        }


        $pageExists = Halaman::where('menu_id', $menu->id)->where('page_halaman', $request->urutan)->exists();
        if ($pageExists) {
            return back()->with(['warning' => 'Nomor halaman sudah ada']);
        }
        $halaman = new Halaman();
        $halaman->menu_id = $menu->id;
        $halaman->nama = $request->judul_halaman;
        $halaman->slug = Str::slug($request->judul_halaman);
        $halaman->view = 0;
        $halaman->page_halaman = $request->urutan;
        $halaman->is_active = $request->is_active;
        $halaman->url = $request->url;
        $halaman->user_id = Auth::id();
        // dd($halaman);
        $halaman->save();

        return back();
    }

    public function status($id)
    {

        $menu = menu::where('is_active', 1)->find($id);
        // dd($menu);
        return response()->json($menu);
    }
}
