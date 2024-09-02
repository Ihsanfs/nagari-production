<?php

namespace App\Http\Controllers;

use App\Models\Appnama;
use App\Models\halaman;
use App\Models\instansi;
use App\Models\menu;
use App\Models\Pengumuman;
use App\Models\sosmedinstansi;
use App\Models\Visit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Download;

class PengumumanController extends Controller
{

    public $getip;
    public $mingguan;
    public $bulanan;
    public $kemarin;
    public $totalvisit;
    public $today;

    public function __construct(Request $request)
    {
        $Week = Carbon::now()->startOfWeek();
        $Month = Carbon::now()->startOfMonth();
        $today = Carbon::now();
        $this->middleware('trackvisit');
        $this->getip = Visit::where('last_activity', '>=', now()->subMinutes(5))->count();
        $this->mingguan = Visit::whereDate('activity', '>=', $Week)->count();
        $this->bulanan = Visit::whereDate('activity', '>=', $Month)->count();
        $this->kemarin = Visit::whereDate('activity', Carbon::yesterday())->count();
        $this->today = Visit::whereDate('activity', $today)->count();
        $this->totalvisit = Visit::count();
        $this->middleware('setUserRole');
    }


    public function index(Request $request){
        $role = $request->role;
        $pengumuman = Pengumuman::all();
        return view('form.pengumuman.index', compact('role', 'pengumuman'));
    }

    public function create(Request $request){
        $role = $request->role;
        return view('form.pengumuman.create', compact('role'));

    }

    public function store(Request $request){
        $role = $request->role;
        try {
            $this->validate($request, [
                'judul_pengumuman' => 'required',
                'file_pengumuman' => 'required|mimes:pdf,doc,docx,jpeg,png,gif|max:2048',
                'is_active' => 'required'
            ],
            [
                'judul_pengumuman.required' => 'Judul wajib diisi.',
                'file_pengumuman' => 'Wajib memasukkan file',
                'is_active' => 'is active wajib di isi'
            ]);



            $pengumuman = new Pengumuman();
            $pengumuman->judul_pengumuman = $request->judul_pengumuman;

            if ($request->hasFile('file_pengumuman')) {
                $file = $request->file('file_pengumuman');
                $rand = rand(10, 999);
                $fileName = $file->getClientOriginalName();
                $filePath = 'file/pengumuman/' . $rand . $fileName;
                $file->move(public_path('file/pengumuman'), $rand . $fileName);
                $pengumuman->file_pengumuman = $filePath;
            }
            $pengumuman->is_active = $request->is_active;
            $pengumuman->save();

            $role = $request->role;

            return redirect()->route($role . '.pengumuman')->with('success', 'pengumuman berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->with(['error' => 'Error: ' . $e->getMessage()]);
        }

    }

    public function update(Request $request,$id){
        $role = $request->role;

        try {
            $this->validate($request, [
                'judul_pengumuman' => 'required',
                'is_active' => 'required',
                'file_pengumuman' => 'nullable|mimes:pdf,doc,docx,jpeg,png,gif',
            ],
            [
                'judul_pengumuman.required' => 'Judul wajib diisi.',
                'file_pengumuman' => 'Wajib memasukkan file maksimal 2 MB',
                'is_active' => 'is active wajib di isi'
            ]);

            $pengumuman = Pengumuman::findOrFail($id);
            $pengumuman->judul_pengumuman = $request->judul_pengumuman;

            // Cek file pengumuman di-upload
            if ($request->hasFile('file_pengumuman')) {
                $file = $request->file('file_pengumuman');
                $rand = rand(10, 999);
                $fileName = $file->getClientOriginalName();
                $filePath = 'file/pengumuman/' . $rand . $fileName;
                $file->move(public_path('file/pengumuman'), $rand . $fileName);

                // Hapus  pengumuman lama jika ada
                if (file_exists(public_path($pengumuman->file_pengumuman))) {
                    unlink(public_path($pengumuman->file_pengumuman));
                }

                $pengumuman->file_pengumuman = $filePath;
            }

            $pengumuman->is_active = $request->is_active;
            $pengumuman->update();

            return redirect()->route($role . '.pengumuman')->with('success', 'Pengumuman berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->with(['error' => 'Error: ' . $e->getMessage()]);
        }

    }

    public function delete(Request $request,$id){
        $role = $request->role;
        $pengumuman = Pengumuman::find($id);
        if (!$pengumuman) {
            return back()->with(['error' => 'Pengumuman tidak ditemukan']);
        }

        if ($pengumuman->file_pengumuman) {
            $filePath = public_path($pengumuman->file_pengumuman);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        $pengumuman->delete();

        return back()->with('success', 'pengumuman berhasil di hapus');
    }

    public function pengumuman_nagari(Request $request){
        $ip = $this->getip;
        $kemarin = $this->kemarin;
        $mingguan = $this->mingguan;
        $bulanan = $this->bulanan;
        $totalvisit = $this->totalvisit;
        $hariini = $this->today;

        $instansi = instansi::first();
        //halaman urut
        $halaman = halaman::leftJoin('menu', 'halaman.menu_id', '=', 'menu.id')
            ->where('menu.is_active', 1)
            ->where('halaman.is_active', 1)
            ->where('halaman.page_halaman', '>', 0)
            ->select('menu.*', 'halaman.*')
            ->orderBy('halaman.page_halaman', 'ASC')
            ->get();

        // Mengelompokkan berdasarkan menu_id
        $grouphalaman = $halaman->groupBy('menu_id');
        $menu = Menu::where('is_active', 1)->orderBy('urutan_menu', 'desc')->get();
        $pengumuman = pengumuman::where('is_active', 1)->paginate(20);
        $download = Download::where('is_active', 1)->get();
        if ($request->ajax()) {
            $downloads =  pengumuman::where('is_active', 1)->get();
            return DataTables::of($downloads)
                ->addIndexColumn()
                ->make(true);
        }
        $media = sosmedinstansi::all();
        $app = Appnama::first();

        return view('front.pengumuman', compact('halaman','menu','grouphalaman','app','download', 'media','pengumuman','instansi','ip','kemarin','mingguan','bulanan','totalvisit','hariini'));

    }
}
