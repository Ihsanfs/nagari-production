<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SlideController extends Controller
{
    public function __construct()
    {
        $this->middleware('setUserRole');
    }

   public function index(Request $request){
    $slide = Slide::all();
    $userRole = Auth::user()->role_id;
    $role = ($userRole == 2) ? 'admin' : 'superadmin';
    return view ('form.slide.index', compact('slide','role'));
   }


   public function create(Request $request){
    $role = $request->role;

    return view ('form.slide.create',compact('role'));

   }

   public function store(Request $request){

    try{
        $this->validate($request, [
            'judul_slide' => 'required',
            'video_slide' => 'nullable|file|mimes:mp4,webm,ogg|max:20480',
        ], [
            'judul_slide.required' => 'Judul video harus diisi.',
            'video_slide.file' => 'Video harus berupa file.',
            'video_slide.mimes' => 'Format video tidak valid. Hanya diperbolehkan: mp4, webm, ogg.',
            'video_slide.max' => 'Ukuran video tidak boleh lebih dari 20 MB.',
        ]);


            $slide = new Slide();
            $slide->judul_slide = $request->judul_slide;
            if($request->link == '' || FALSE){
                $slide->type = 2;
            }elseif($request->link == TRUE ){
                $slide->type = 1;
            $slide->link = $request->link;

            }

            $slide->is_active = $request->is_active;
            if ($request->hasFile('video_slide')) {
                $file = $request->file('video_slide');
                $time = time();
                $fileName = $file->getClientOriginalName();

                $filePath = 'video/slide/'. $time . $fileName;
                $file->move(public_path('video/slide'),$time . $fileName);
                $slide->video_slide = $filePath;
            }

            $slide->save();
            $userRole = Auth::user()->role_id;
            $role = ($userRole == 2) ? 'admin' : 'superadmin';
        return redirect()->route($role.'.video')->with(['success' =>'video berhasil di tambahkan']);
        }catch (\Exception $e) {
            return back()->with(['error' => 'Error: video gagal di tambahkan ' . $e->getMessage()]);
        }


        }

   public function edit(Request $request,$id){
        $slide = Slide::find($id);
        $role = $request->role;

        return view('form.slide.edit',compact('slide','role'));
   }

   public function update(Request $request,$id){

    try {
        $this->validate($request, [
            'judul_slide' => 'required',
            'video_slide' => 'nullable|file|mimes:mp4,webm,ogg|max:20480',
        ], [
            'judul_slide.required' => 'Judul video harus diisi.',
            'video_slide.file' => 'Video harus berupa file.',
            'video_slide.mimes' => 'Format video tidak valid. Hanya diperbolehkan: mp4, webm, ogg.',
            'video_slide.max' => 'Ukuran video tidak boleh lebih dari 20 MB.',
        ]);

        $slide = Slide::find($id);

        if (!$slide) {
            return back()->with(['error' => 'Slide not found']);
        }

        $role = $request->role;



        if ($request->hasFile('video_slide')) {
            $file = $request->file('video_slide');
            $time = time();
            $fileName = $file->getClientOriginalName();

            $filePath = 'video/slide/'.$time  . $fileName;
            $file->move(public_path('video/slide'),$time . $fileName);
            $slide->video_slide = $filePath;
        }



        $slide->judul_slide = $request->judul_slide;
        if($request->link == '' || FALSE){
            $slide->type = 2;
        }elseif($request->link == TRUE){
            $slide->type = 1;
        $slide->link = $request->link;

        }

        $slide->is_active = $request->is_active;

        // Save changes
        $slide->update();

        return redirect()->route($role . '.video')->with(['success' => 'Video berhasil diupdate']);
    } catch (\Exception $e) {
        return back()->with(['error' => 'Video gagal diupdate']);
    }

   }

   public function destroy($id){

    $slide = Slide::find($id);
    $slide->delete();
    return back()->with(['success'=>'Video Berhasil di Hapus']);
   }



}
