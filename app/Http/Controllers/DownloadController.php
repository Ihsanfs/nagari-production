<?php

namespace App\Http\Controllers;

use App\Models\Appnama;
use App\Models\Download;
use App\Models\halaman;
use App\Models\instansi;
use App\Models\menu;
use App\Models\Pengumuman;
use App\Models\sosmedinstansi;
use App\Models\Visit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DownloadController extends Controller
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
        $download = Download::all();
        return view('form.download.index', compact('role', 'download'));
    }

    public function create(Request $request){
        $role = $request->role;
        return view('form.download.create', compact('role'));

    }

    public function store(Request $request){

        try {
            $this->validate($request, [
                'judul_download' => 'required',
                'file_download' => 'required|mimes:pdf,doc,docx,jpeg,png,gif|max:2048',
                'is_active' => 'required'
            ],
            [
                'judul_download.required' => 'Judul wajib diisi.',
                'file_download.required' => 'Wajib memasukkan file Maksimal 2 MB',
                'is_active' => 'is active wajib di isi'
            ]);

            $donwload = new Download();
            $donwload->judul_download = $request->judul_download;

            if ($request->hasFile('file_download')) {
                $file = $request->file('file_download');
                $rand = rand(10, 999);
                $fileName = $file->getClientOriginalName();
                $filePath = 'file/download/' . $rand . $fileName;
                $file->move(public_path('file//download'), $rand . $fileName);
                $donwload->file_download = $filePath;
            }
            $donwload->is_active = $request->is_active;
            $donwload->save();
            $role = $request->role;

            return redirect()->route($role . '.download')->with('success', 'download berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->with(['error' => 'Error: ' . $e->getMessage()]);
        }

    }

    public function update(Request $request,$id){
        $role = $request->role;

        try {
            $this->validate($request, [
                'judul_download' => 'required',
                'file_download' => 'nullable|mimes:pdf,doc,docx,jpeg,png,gif|max:2048',
                'is_active' => 'required',
            ],
            [
                'judul_download.required' => 'Judul wajib diisi.',
                'file_download' => 'Wajib memasukkan file',
                'is_active.required' => 'status aktif wajib di isi'
            ]);

            $download = download::findOrFail($id);
            $download->judul_download = $request->judul_download;

            // Cek apakah file pengumuman di-upload
            if ($request->hasFile('file_download')) {
                $file = $request->file('file_download');
                $rand = rand(10, 999);
                $fileName = $file->getClientOriginalName();
                $filePath = 'file/download/' . $rand . $fileName;
                $file->move(public_path('file/download'), $rand . $fileName);

                // Hapus file download lama jika ada
                if (file_exists(public_path($download->file_download))) {
                    unlink(public_path($download->file_download));
                }

                $download->file_download = $filePath;
            }

            $download->is_active = $request->is_active;
            $download->update();

            return redirect()->route($role . '.download')->with('success', 'download berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->with(['error' => 'Error: ' . $e->getMessage()]);
        }

    }

    public function delete(Request $request,$id){
        $role = $request->role;
        $pengumuman = Download::find($id);
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

    public function download_nagari(Request $request){
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
            $pengumuman = Pengumuman::where('is_active', 1)->get();

        // Mengelompokkan berdasarkan menu_id
        $grouphalaman = $halaman->groupBy('menu_id');

        $download = download::where('is_active', 1)->paginate(20);
        if ($request->ajax()) {
            $downloads = Download::where('is_active', 1)->get();
            return DataTables::of($downloads)
                ->addIndexColumn()
                ->make(true);
        }
        $menu = Menu::where('is_active', 1)->orderBy('urutan_menu', 'desc')->get();
        $media = sosmedinstansi::all();
        $app = Appnama::first();

        return view('front.download', compact('halaman','menu','grouphalaman','app','pengumuman','media', 'download','instansi','ip','kemarin','mingguan','bulanan','totalvisit','hariini'));

    }
}
