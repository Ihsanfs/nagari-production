<?php

namespace App\Http\Controllers;

use App\Models\menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MenuController extends Controller
{

    public function __construct()
    {
        $this->middleware('setUserRole');
    }

    public function index(Request $request){

        $menu = menu::all();
        $role = $request->role;

        return view('form.menu.index',compact('menu','role'));
    }


    public function create(Request $request){
        $role = $request->role;

        return view('form.menu.create',compact('role'));

    }

    public function edit(Request $request,$id){
        $role = $request->role;

    $menu = menu::find($id);
    return view('form.menu.edit',compact('menu','role'));

    }

    public function update(Request $request, $id)
    {
        try {

        $validationRules = [
            'nama_menu' => 'required',
            'is_active' => 'required'
        ];


        $Messages = [
            'gambar_page.image' => 'File harus berupa gambar.',
            'gambar_page.mimes' => 'Format gambar yang didukung: jpeg, png, jpg, gif.',
            'gambar_page.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',
            'is_active' => 'is_active wajib di isi'
        ];

        if ($request->menu_pilih == 4) {

            $validationRules['gambar_page'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048';
            $validationRules['deskripsi_page'] = 'required';
            $Messages['deskripsi_page.required'] = 'Deskripsi halaman harus diisi';

        }

            $this->validate($request, $validationRules, $Messages);


            $menu = Menu::find($id);


            $menu->nama = $request->nama_menu;


            if ($menu->status == 4) {
                $menu->slug = Str::slug($request->nama_menu);
            }

            $menu->is_active = $request->is_active;
            $menu->deskripsi_page = $request->deskripsi_page;
            $menu->url = $request->url;


            if ($request->hasFile('gambar_page')) {
                $rand = rand(10, 999);
                $file = $request->file('gambar_page');
                $fileName = $file->getClientOriginalName();
                $filePath = 'images/gambar_page/' . $rand . $fileName;
                $file->move(public_path('images/gambar_page'), $rand . $fileName);
                $menu->gambar_page = $filePath;
            }


            $menu->save();


            $role = $request->role;


            return redirect()->route($role . '.menu')->with(['success' => 'Menu berhasil diperbarui']);
        } catch (\Exception $e) {

            return back()->with(['error' => 'Error: ' . $e->getMessage()]);
        }
    }



public function store(Request $request)
{
    try {

        $validationRules = [
            'nama_menu' => 'required',
            'menu_pilih' => 'required|in:1,2,3,4',
            'gambar_page' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'required'
        ];


        $Messages = [
            'nama_menu.required' => 'Nama menu harus diisi.',
            'menu_pilih.required' => 'Pilihan menu harus dipilih.',
            'menu_pilih.in' => 'Pilihan menu tidak valid.',
            'gambar_page.image' => 'File harus berupa gambar.',
            'gambar_page.mimes' => 'Format gambar yang didukung: jpeg, png, jpg, gif.',
            'gambar_page.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',
            'is_active.required' => 'Status wajib di isi'
        ];

        if ($request->menu_pilih == 4) {

            $validationRules['gambar_page'] = 'required|image|mimes:jpeg,png,jpg,gif|max:2048';
            $validationRules['deskripsi_page'] = 'required';
            $Messages['deskripsi_page.required'] = 'Deskripsi halaman harus diisi';

        }

        if ($request->menu_pilih == 2) {

            $validationRules['url_menu'] = 'required';
            $Messages['url_menu.required'] = 'URL menu harus diisi.';
            $Messages['url_menu.url'] = 'URL menu harus berupa URL yang valid.';
        }

        $this->validate($request, $validationRules, $Messages);


        $menu = new Menu();
        $menu->nama = $request->nama_menu;
        if ($request->menu_pilih == 4) {
            $menu->slug = Str::slug($request->nama_menu);
        }
        $menu->user_id = Auth::user()->id;
        $menu->url = $request->url_menu;
        $menu->is_active = $request->is_active;
        $menu->status = $request->menu_pilih;
        $menu->deskripsi_page = $request->deskripsi_page;

        if ($request->hasFile('gambar_page')) {
            $file = $request->file('gambar_page');
            $rand = rand(10, 999);
            $fileName = $file->getClientOriginalName();
            $filePath = 'images/gambar_page/' . $rand . $fileName;
            $file->move(public_path('images/gambar_page'), $rand . $fileName);
            $menu->gambar_page = $filePath;
        }
        $menu->save();

        $role = $request->role;

        return redirect()->route($role . '.menu')->with(['success' => 'Menu berhasil ditambahkan']);
    } catch (\Exception $e) {

        return back()->with(['error' => 'Error: ' . $e->getMessage()]);
    }
}


    public function delete($id){
        $menu = menu::find($id);
        $menu->delete();
        return back()->with(['success'=>'menu berhasil di hapus']);
    }

}

