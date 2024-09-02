<?php

namespace App\Http\Controllers;

use App\Models\slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Backtrace\File;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('setUserRole');
    }


    public function index(Request $request)
    {

        $slider = slider::all();
        $role = $request->role;

        return view('form.slider.index', compact('slider', 'role'));
    }

    public function create(Request $request)
    {
        $role = $request->role;
        return view('form.slider.create', compact('role'));
    }

    public function store(Request $request)
    {

        try {
            $this->validate($request, [
                'judul_slider' => 'required',
                'gambar_slider' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            ],
            [
                'judul_slider.required' => 'Judul wajib diisi.',
                'gambar_slider' => 'Wajib memasukkan gambar, bukan file maksimal 2 MB.',
            ]);



            $slider = new Slider();
            $slider->judul_slider = $request->judul_slider;

            if ($request->hasFile('gambar_slider')) {
                $file = $request->file('gambar_slider');
                $rand = rand(10, 999);
                $fileName = $file->getClientOriginalName();
                $filePath = 'images/slider/' . $rand . $fileName;
                $file->move(public_path('images/slider'), $rand . $fileName);
                $slider->gambar_slider = $filePath;
            }

            $slider->is_active = $request->is_active;
            $slider->save();

            $role = $request->role;

            return redirect()->route($role . '.slider_index')->with('success', 'Slider berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->with(['error' => 'Error: ' . $e->getMessage()]);
        }
    }


    public function destroy(Request $request, $id)
    {
        $slider = Slider::find($id);
        if (!$slider) {
            return back()->with(['error' => 'Slider tidak ditemukan']);
        }

        if ($slider->gambar_slider) {
            $filePath = public_path($slider->gambar_slider);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        $slider->delete();
        $role = $request->role;

        return back()->with(['success' => 'Slider berhasil dihapus']);
    }

    public function update(Request $request, $id)
    {


        try {
            if ($request->hasFile('gambar_slider')) {
                $this->validate($request, [
                    'gambar_slider' => 'required|image|mimes:jpeg,jpg,png',
                ],
                [
                    'gambar_slider' => 'Wajib memasukkan gambar, bukan file.',
                ]);
            }
        } catch (\Exception $e) {
            return back()->with(['error' => 'Error: ' . $e->getMessage()]);
        }


        $slider = Slider::find($id);
        if (!$slider) {
            return back()->with(['error' => 'Slider tidak ditemukan']);
        }
        $slider->judul_slider = $request->judul_slider;

        if ($request->hasFile('gambar_slider')) {
            $file = $request->file('gambar_slider');
            $rand = rand(10, 999);
            $fileName = $file->getClientOriginalName();
            $filePath = 'images/slider/' . $rand . $fileName;
            $file->move(public_path('images/slider'), $rand . $fileName);
            $slider->gambar_slider = $filePath;
        }

        $slider->is_active = $request->is_active;
        $slider->update();
        return redirect()->back()->with('success', 'Slider berhasil diperbarui');
    }
}
