<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use App\Models\tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TagController extends Controller
{

    public function __construct()
    {
        $this->middleware('setUserRole');
    }

    public function index(Request $request)
    {
        $tag = tag::all();
        $role = $request->role;

        return view('form.tag.index', compact('tag', 'role'));
    }

    public function store(Request $request)
    {


        $rules = [
            'nama_tag' => 'required|max:255',
        ];

        $messages = [
            'nama_tag.required' => 'Nama tag wajib diisi.',
            'nama_tag.max' => 'Nama tag tidak boleh lebih dari :max karakter.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return redirect()->back()->with(['error' => implode('<br>', $errors)])->withInput();
        }


        $tag = new Tag();
        $tag->nama_tag = $request->nama_tag;
        $tag->slug = Str::slug($request->nama_tag);
        $tag->save();

        return redirect()->back()->with('success', 'Tag berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $tag = tag::find($id);

        // Periksa apakah tag dengan ID yang diberikan ditemukan
        if ($tag) {
            $tag->delete();
            return back()->with(['success' => 'Tag berhasil dihapus']);
        } else {
            // Jika tag tidak ditemukan, kembalikan dengan pesan kesalahan
            return back()->with(['error' => 'Tag tidak ditemukan']);
        }
    }

    public function update(Request $request, $id)
    {

        $rules = [
            'nama_tag' => 'required|max:255',
        ];

        $messages = [
            'nama_tag.required' => 'Nama tag wajib diisi.',
            'nama_tag.max' => 'Nama tag tidak boleh lebih dari :max karakter.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);


        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return redirect()->back()->with(['error' => implode('<br>', $errors)])->withInput();
        }


        $tag = Tag::find($id);


        if ($tag) {

            $tag->nama_tag = $request->nama_tag;

            $tag->slug = Str::slug($request->nama_tag);

            $tag->update();

            return redirect()->back()->with('success', 'Tag berhasil diperbarui');
        } else {

            return redirect()->back()->with('error', 'Tag tidak ditemukan');
        }
    }
}
