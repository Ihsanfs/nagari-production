<?php

namespace App\Http\Controllers;

use App\Models\Sosialmedia;
use Illuminate\Http\Request;

class SosialmediaController extends Controller
{

    public function __construct()
    {
        $this->middleware('setUserRole');
    }

    public function index(Request $request)
    {
        $media = Sosialmedia::all();
        $role = $request->role;

        return view('form.sosialmedia.index', compact('role', 'media'));

    }

    public function create(Request $request)
    {
        $role = $request->role;
        return view('form.sosialmedia.create', compact('role'));
    }


    public function store(Request $request)
    {

        try {
            $this->validate(
                $request,
                [
                    'media_icon' => 'required',
                    'namasosmed' => 'required'
                ],
                [
                    'media_icon' => 'icon media wajib di isi',
                    'namasosmed' => 'wajin di isi'

                ]
            );

            $role = $request->role;

            $icon = $request->media_icon;

            $media = new Sosialmedia();
            $media->media_font = $icon;
            $media->nama_sosmed = $request->namasosmed;
            $media->save();
            return redirect()->route($role . '.media')->with('success', 'icon berhasil ditambahkan');
        } catch (\Exception $e) {

            return back()->with('error', $e->getMessage());
        }

    }

    public function update(Request $request, $id)
    {

        try {
            $this->validate(
                $request,
                [
                    'media_icon' => 'required',
                    'namasosmed' => 'required'

                ],
                [
                    'media_icon' => 'icon media wajib di isi',
                    'namasosmed' => 'Wajib di isi'

                ]
            );
            $role = $request->role;
            $media = Sosialmedia::find($id);
            $media->media_font = $request->media_icon;
            $media->nama_sosmed = $request->namasosmed;

            // dd($media);
            $media->update();
           return back()->with('success','Icon sukses di tambahkan');
        } catch (\Exception $e) {

            return back()->with('error', $e->getMessage());


        }
    }


    public function delete(Request $request, $id)
    {
        $role = $request->role;
        $media = Sosialmedia::find($id);
        $media->delete();
        return back()->with('success', 'icon berhasil di hapus');

    }
}
