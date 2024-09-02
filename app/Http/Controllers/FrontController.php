<?php

namespace App\Http\Controllers;

use App\Models\album;
use App\Models\artikel;
use App\Models\artikeltag;
use App\Models\Gallery;
use App\Models\halaman;
use App\Models\instansi;
use App\Models\kategori;
use App\Models\kategori_tag;
use App\Models\menu;
use App\Models\pelayanan;
use App\Models\Slide;
use App\Models\Appnama;
use App\Models\slider;
use App\Models\sosmedinstansi;
use App\Models\tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Jenssegers\Agent\Agent;
use Jorenvh\Share\Share;
use App\Models\Visit;
use Carbon\Carbon;
use App\Models\Pengumuman;
use App\Models\Download;

class FrontController extends Controller
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
    }

    public function beranda(Request $request)
    {

        $ip = $this->getip;
        $kemarin = $this->kemarin;
        $mingguan = $this->mingguan;
        $bulanan = $this->bulanan;
        $totalvisit = $this->totalvisit;
        $hariini = $this->today;
        $pelayanan = Pelayanan::where('is_active', 1)->orderBy('tanggal', 'ASC')->get();
        // dd($pelayanan);
        $pengumuman = pengumuman::where('is_active', 1)->get();
        $halaman = Halaman::leftJoin('menu', 'halaman.menu_id', '=', 'menu.id')
            ->where('menu.is_active', 1)
            ->where('halaman.is_active', 1)
            ->where('halaman.page_halaman', '>', 0)
            ->select('menu.*', 'halaman.*')
            ->orderBy('halaman.page_halaman', 'ASC')
            ->get();
        $download = Download::where('is_active', 1)->get();

        $grouphalaman = $halaman->groupBy('menu_id');

        $berita_populer = Artikel::orderBy('views', 'desc')->take(4)->get();
             $menu = Menu::where('is_active', 1)->orderBy('urutan_menu', 'desc')->get();

        $instansi = instansi::first();
        $media = sosmedinstansi::all();
        $galeri = album::all();
        $berita = Artikel::latest()->take(10)->get();
        $video = Slide::orderBy('id', 'desc')->where('is_active', 1)->get();
        $berita_terbaru = Artikel::orderByDesc('tanggal')->take(6)->get();

        $slidertampil = slider::all();
        $app = Appnama::first();

        return view('front.beranda', compact('halaman', 'ip', 'mingguan','download','media', 'pelayanan', 'hariini', 'bulanan', 'kemarin','pengumuman', 'totalvisit', 'berita', 'menu', 'video', 'grouphalaman', 'galeri', 'berita_populer', 'instansi', 'berita_terbaru', 'slidertampil','app'));
    }
    public function index($slug)
    {

        $ip = $this->getip;
        $kemarin = $this->kemarin;
        $mingguan = $this->mingguan;
        $bulanan = $this->bulanan;
        $totalvisit = $this->totalvisit;
        $hariini = $this->today;
        $pengumuman = pengumuman::where('is_active', 1)->get();
        $download = Download::where('is_active', 1)->get();

        $halaman = Halaman::leftJoin('menu', 'halaman.menu_id', '=', 'menu.id')
            ->where('menu.is_active', 1)
            ->where('halaman.is_active', 1)
            ->where('halaman.page_halaman', '>', 0)
            ->select('menu.*', 'halaman.*')
            ->orderBy('halaman.page_halaman', 'ASC')
            ->get();
        $grouphalaman = $halaman->groupBy('menu_id');
        $instansi = instansi::first();
        $media = sosmedinstansi::all();

             $menu = Menu::where('is_active', 1)->orderBy('urutan_menu', 'desc')->get();
        $artikel = Artikel::with('users')
            ->leftJoin('kategori_tag', 'kategori_tag.artikel_id', '=', 'artikels.id')
            ->leftJoin('kategori', 'kategori.id', '=', 'kategori_tag.kategori_id')
            ->leftjoin('artikels_tag', 'artikels_tag.artikel_id', '=', 'artikels.id')
            ->leftjoin('tag', 'tag.id', '=', 'artikels_tag.tag_id')
            ->select('artikels.*', 'kategori.nama_kategori', 'tag.nama_tag', 'tag.slug as slugtag')
            ->where('artikels.slug', $slug)
            ->first();


        // dd($artikel);
        $kat_lop = kategori_tag::join('kategori', 'kategori.id', '=', 'kategori_tag.kategori_id')->whereIn('artikel_id', [$artikel->id])->get();

        // foreach($kat_lop as $i){
        //     echo $i->nama_kategori;
        // }

        $tag_lop = artikeltag::query()->join(
            'tag',
            'tag.id',
            '=',
            'artikels_tag.tag_id'
        )->whereIn('artikel_id', [$artikel->id])->get();


        // foreach($tag_lop as $i){
        //     echo $i->nama_tag;
        // }
        if ($artikel) {
            $artikel->increment('views');
        }

        $berita_baru = artikel::latest()->take(5)->get();

        $berita_populer = Artikel::orderBy('views', 'desc')->take(5)->get();
        $app = Appnama::first();

        return view('front.detail_berita', compact('artikel', 'instansi','media','pengumuman','download', 'app','ip', 'hariini', 'mingguan', 'bulanan', 'kemarin', 'totalvisit', 'tag_lop', 'kat_lop', 'halaman', 'berita_baru', 'menu', 'grouphalaman', 'berita_populer', 'slug'));
    }



    public function halaman($slug)
    {

        $ip = $this->getip;
        $kemarin = $this->kemarin;
        $mingguan = $this->mingguan;
        $bulanan = $this->bulanan;
        $totalvisit = $this->totalvisit;
        $hariini = $this->today;
        $pengumuman = pengumuman::where('is_active', 1)->get();
        $download = Download::where('is_active', 1)->get();

        //halaman urut
        $halaman = Halaman::leftJoin('menu', 'halaman.menu_id', '=', 'menu.id')
            ->where('menu.is_active', 1)
            ->where('halaman.is_active', 1)
            ->where('halaman.page_halaman', '>', 0)
            ->select('menu.*', 'halaman.*')
            ->orderBy('halaman.page_halaman', 'ASC')
            ->get();
        $instansi = instansi::first();
        // Mengelompokkan berdasarkan menu_id
        $grouphalaman = $halaman->groupBy('menu_id');
             $menu = Menu::where('is_active', 1)->orderBy('urutan_menu', 'desc')->get();
        $halaman_detail = Halaman::with('author_halaman')->where('slug', $slug)->first();

        $media = sosmedinstansi::all();

        if (!$halaman_detail) {
            $halaman_detail = Menu::where('slug', $slug)->first();
        }
        // dd($halaman_detail);

        // hitung perclick halaman
        if (isset($halaman_detail->view)) {
            $halaman_detail->increment('view');
        }

        $berita_populer = Artikel::orderBy('views', 'desc')->get();
        $berita_baru = artikel::latest()->take(5)->get();
        $app = Appnama::first();

        // dd($berita_baru);
        return view('front.halaman', compact('halaman_detail','app', 'ip','media','pengumuman','download', 'mingguan', 'hariini', 'bulanan', 'kemarin', 'totalvisit', 'instansi', 'halaman', 'berita_baru', 'berita_populer', 'menu', 'grouphalaman', 'slug'));
    }

    public function search_berita(Request $request)
    {
        $ip = $this->getip;
        $kemarin = $this->kemarin;
        $mingguan = $this->mingguan;
        $bulanan = $this->bulanan;
        $totalvisit = $this->totalvisit;
        $hariini = $this->today;
        $download = Download::where('is_active', 1)->get();

        $pengumuman = pengumuman::where('is_active', 1)->get();

        //halaman urut
        $halaman = Halaman::leftJoin('menu', 'halaman.menu_id', '=', 'menu.id')
            ->where('menu.is_active', 1)
            ->where('halaman.is_active', 1)
            ->where('halaman.page_halaman', '>', 0)
            ->select('menu.*', 'halaman.*')
            ->orderBy('halaman.page_halaman', 'ASC')
            ->get();
        $instansi = instansi::first();
        // Mengelompokkan berdasarkan menu_id
        $grouphalaman = $halaman->groupBy('menu_id');

             $menu = Menu::where('is_active', 1)->orderBy('urutan_menu', 'desc')->get();
        $berita_baru = artikel::latest()->get();

        $berita_populer = Artikel::orderBy('views', 'desc')->get();
        $cari = $request->cari_berita;
        $berita = Artikel::where('judul', 'like', '%' . $cari . '%')
            ->orWhere('slug', 'like', '%' . $cari . '%')
            ->orWhere('body', 'like', '%' . $cari . '%')
            ->paginate(20);
            $media = sosmedinstansi::all();
            $app = Appnama::first();

        return view('front.berita_search', compact('cari','berita', 'app','instansi','media','pengumuman','download', 'ip', 'mingguan', 'bulanan', 'kemarin', 'totalvisit', 'hariini', 'berita_baru', 'berita_populer', 'menu', 'grouphalaman',));
    }

    public function berita_lengkap()
    {

        $ip = $this->getip;
        $kemarin = $this->kemarin;
        $mingguan = $this->mingguan;
        $bulanan = $this->bulanan;
        $totalvisit = $this->totalvisit;
        $hariini = $this->today;
        $pengumuman = pengumuman::where('is_active', 1)->get();
        $download = Download::where('is_active', 1)->get();

        //halaman urut
        $halaman = Halaman::leftJoin('menu', 'halaman.menu_id', '=', 'menu.id')
            ->where('menu.is_active', 1)
            ->where('halaman.is_active', 1)
            ->where('halaman.page_halaman', '>', 0)
            ->select('menu.*', 'halaman.*')
            ->orderBy('halaman.page_halaman', 'ASC')
            ->get();
        $instansi = instansi::first();
        // Mengelompokkan berdasarkan menu_id
        $grouphalaman = $halaman->groupBy('menu_id');

             $menu = Menu::where('is_active', 1)->orderBy('urutan_menu', 'desc')->get();

        $berita = artikel::latest()->paginate(20);
        $berita_baru = artikel::latest()->get();
        $kategori = Kategori::join('kategori_tag as kat', 'kat.kategori_id', '=', 'kategori.id')
        ->select('kategori.id', 'kategori.nama_kategori','kategori.slug')
        ->groupBy('kategori.id', 'kategori.nama_kategori','kategori.slug')
        ->get();
        $berita_populer = Artikel::orderBy('views', 'desc')->get();
        $media = sosmedinstansi::all();
        $app = Appnama::first();

        return view('front.berita_selengkapnya', compact('berita','app', 'menu','pengumuman','media','download', 'ip', 'mingguan', 'bulanan', 'kemarin', 'hariini', 'totalvisit', 'instansi', 'grouphalaman', 'berita_baru', 'berita_populer', 'kategori'));
    }

    public function kategori_tampil($category)
    {

        $ip = $this->getip;
        $kemarin = $this->kemarin;
        $mingguan = $this->mingguan;
        $bulanan = $this->bulanan;
        $totalvisit = $this->totalvisit;
        $hariini = $this->today;
        $pengumuman = pengumuman::where('is_active', 1)->get();
        $download = Download::where('is_active', 1)->get();

        $halaman = Halaman::leftJoin('menu', 'halaman.menu_id', '=', 'menu.id')
            ->where('menu.is_active', 1)
            ->where('halaman.is_active', 1)
            ->where('halaman.page_halaman', '>', 0)
            ->select('menu.*', 'halaman.*')
            ->orderBy('halaman.page_halaman', 'ASC')
            ->get();
        $instansi = instansi::first();
        // Mengelompokkan berdasarkan menu_id
        $grouphalaman = $halaman->groupBy('menu_id');

             $menu = Menu::where('is_active', 1)->orderBy('urutan_menu', 'desc')->get();

        $berita = artikel::latest()->paginate(20);
        $berita_baru = artikel::latest()->get();
        //    $kategori = kategori::all();
        $berita_populer = Artikel::orderBy('views', 'desc')->get();

        $kategori = kategori::join('kategori_tag', 'kategori_tag.kategori_id', '=', 'kategori.id')
            ->join('artikels as a', 'a.id', '=', 'kategori_tag.artikel_id')
            ->leftjoin('users', 'users.id', '=', 'a.user_id')
            ->where('kategori.slug', $category)
            ->select('a.*', 'kategori.nama_kategori', 'a.slug as slugartikel', 'kategori.slug', 'users.name')
            ->distinct('a.id')
            ->get();


        $artikelid = $kategori->pluck('id')->toArray();


        $kategori_data = kategori::join('kategori_tag', 'kategori_tag.kategori_id', '=', 'kategori.id')
            ->join('artikels as a', 'a.id', '=', 'kategori_tag.artikel_id')
            ->where('kategori_tag.artikel_id', $artikelid)
            ->select('a.*', 'kategori.nama_kategori', 'kategori.slug')
            ->distinct('a.id')
            ->get();
        // kategori_tag berdasarkan artikel
        $kat_lop = kategori_tag::join('kategori', 'kategori.id', '=', 'kategori_tag.kategori_id')
            ->whereIn('artikel_id', $artikelid)

            ->get();

        $groupKatLop = [];
        foreach ($kat_lop as $d) {
            $groupKatLop[$d->artikel_id][] = $d->nama_kategori;
        }

        //tampil berdasarkan kategori
        $tag_lop = artikeltag::query()
            ->leftjoin('tag', 'tag.id', '=', 'artikels_tag.tag_id')
            ->whereIn('artikels_tag.artikel_id', $artikelid)
            ->get();

        //tag group kategori
        $tag_cek = artikeltag::query()
            ->leftjoin('tag', 'tag.id', '=', 'artikels_tag.tag_id')
            ->whereIn('artikels_tag.artikel_id', $artikelid)
            ->select('artikels_tag.tag_id', 'tag.nama_tag', 'tag.slug')->groupBy('artikels_tag.tag_id', 'tag.nama_tag', 'tag.slug')
            ->get();



        $grouptagLop = [];
        foreach ($tag_lop as $d) {
            $grouptagLop[$d->artikel_id][] = $d->nama_tag;
        }
        $categories = Kategori::pluck('slug', 'nama_kategori');
        $tags = tag::pluck('slug', 'nama_tag');



        $kategori_group = $kategori->groupBy('nama_kategori');
        $media = sosmedinstansi::all();
        $app = Appnama::first();

        // dd($kategori);
        return view('front.kategori', compact('berita','app', 'instansi','pengumuman', 'media','download','kategori_data', 'ip', 'mingguan', 'bulanan', 'kemarin', 'totalvisit', 'hariini', 'categories', 'tags', 'menu', 'kat_lop', 'tag_lop', 'tag_cek', 'grouptagLop', 'groupKatLop', 'grouphalaman', 'kategori_group', 'berita_baru', 'berita_populer', 'kategori', 'category'));
    }

    public function tag_tampil($tag)
    {

        $ip = $this->getip;
        $kemarin = $this->kemarin;
        $mingguan = $this->mingguan;
        $bulanan = $this->bulanan;
        $totalvisit = $this->totalvisit;
        $hariini = $this->today;
        $pengumuman = pengumuman::where('is_active', 1)->get();
        $download = Download::where('is_active', 1)->get();

        $halaman = Halaman::leftJoin('menu', 'halaman.menu_id', '=', 'menu.id')
            ->where('menu.is_active', 1)
            ->where('halaman.is_active', 1)
            ->where('halaman.page_halaman', '>', 0)
            ->select('menu.*', 'halaman.*')
            ->orderBy('halaman.page_halaman', 'ASC')
            ->get();
        $instansi = instansi::first();
        // Mengelompokkan berdasarkan menu_id
        $grouphalaman = $halaman->groupBy('menu_id');
             $menu = Menu::where('is_active', 1)->orderBy('urutan_menu', 'desc')->get();

        $berita = artikel::latest()->paginate(20);
        $berita_baru = artikel::latest()->take(5)->get();
        //    $kategori = kategori::all();
        $berita_populer = Artikel::orderBy('views', 'desc')->get();

        $tag_data = tag::join('artikels_tag', 'artikels_tag.tag_id', '=', 'tag.id')
            ->join('artikels as c', 'artikels_tag.artikel_id', '=', 'c.id')
            ->join('users', 'users.id', '=', 'c.user_id')
            ->where('tag.slug', $tag)
            ->select('c.*', 'tag.nama_tag', 'users.name', 'c.slug as slugartikel', 'tag.slug')
            ->distinct('c.id')
            ->get();
        // dd($tag_data);



        $tagid = $tag_data->pluck('id')->toArray();


        $kategori = kategori::join('kategori_tag', 'kategori_tag.kategori_id', '=', 'kategori.id')
            ->join('artikels as a', 'a.id', '=', 'kategori_tag.artikel_id')
            ->where('kategori_tag.artikel_id', $tagid)
            ->select('a.*', 'kategori.nama_kategori', 'kategori.slug')
            ->distinct('a.id')
            ->get();
        // dd($kategori);
        $kat_lop = kategori_tag::query()->join('kategori', 'kategori.id', '=', 'kategori_tag.kategori_id')
            ->whereIn('artikel_id', $tagid)
            ->get();

        $groupKatLop = [];
        foreach ($kat_lop as $d) {
            $groupKatLop[$d->artikel_id][] = $d->nama_kategori;

        }


        $tag_lop = artikeltag::query()
            ->leftjoin('tag', 'tag.id', '=', 'artikels_tag.tag_id')
            ->whereIn('artikels_tag.artikel_id', $tagid)
            ->get();


        $tag_cek = artikeltag::query()
            ->leftjoin('tag', 'tag.id', '=', 'artikels_tag.tag_id')
            ->whereIn('artikels_tag.artikel_id', $tagid)
            ->select('artikels_tag.tag_id', 'tag.nama_tag', 'tag.slug')->groupBy('artikels_tag.tag_id', 'tag.nama_tag', 'tag.slug')
            ->get();

        $grouptagLop = [];
        foreach ($tag_lop as $d) {
            $grouptagLop[$d->artikel_id][] = $d->nama_tag;
        }

        $categories = Kategori::pluck('slug', 'nama_kategori');
        $tags = tag::pluck('slug', 'nama_tag');
        $media = sosmedinstansi::all();

        $app = Appnama::first();

        return view('front.detail_tag', compact('tag', 'app','kategori','pengumuman','media','download', 'instansi', 'ip', 'mingguan', 'bulanan', 'kemarin', 'totalvisit', 'hariini', 'grouptagLop', 'tags', 'categories', 'tag_data', 'tag_cek', 'tag_lop', 'groupKatLop', 'halaman', 'grouphalaman', 'menu', 'berita', 'berita_baru', 'berita_populer'));
    }


    public function halaman_menu($slug)
    {

        $ip = $this->getip;
        $kemarin = $this->kemarin;
        $mingguan = $this->mingguan;
        $bulanan = $this->bulanan;
        $totalvisit = $this->totalvisit;
        $hariini = $this->today;
        $pengumuman = pengumuman::where('is_active', 1)->get();

        $download = Download::where('is_active', 1)->get();

        $halaman = Halaman::leftJoin('menu', 'halaman.menu_id', '=', 'menu.id')
        ->where('menu.is_active', 1)
        ->where('halaman.is_active', 1)
        ->where('halaman.page_halaman', '>', 0)
            ->select('menu.*', 'halaman.*')
            ->orderBy('halaman.page_halaman', 'ASC')
            ->get();
        $instansi = instansi::first();

        $grouphalaman = $halaman->groupBy('menu_id');
             $menu = Menu::where('is_active', 1)->orderBy('urutan_menu', 'desc')->get();
        $halaman_detail = Halaman::with('author_halaman')->where('slug', $slug)->first();


        if (isset($halaman_detail->view)) {
            $halaman_detail->increment('view');
        }

        $media = sosmedinstansi::all();

        $app = Appnama::first();

        return view('front.halaman', compact('halaman_detail', 'app','ip','pengumuman', 'media','download','mingguan', 'bulanan', 'kemarin', 'totalvisit', 'hariini', 'instansi', 'halaman', 'menu', 'grouphalaman', 'slug'));
    }

    public function layanan(Request $request, $slug)
    {
        $ip = $this->getip;
        $kemarin = $this->kemarin;
        $mingguan = $this->mingguan;
        $bulanan = $this->bulanan;
        $totalvisit = $this->totalvisit;
        $hariini = $this->today;
        $pelayanan = pelayanan::where('slug', $slug)->first();
        $download = Download::where('is_active', 1)->get();

        $pengumuman = pengumuman::where('is_active', 1)->get();

        $halaman = Halaman::leftJoin('menu', 'halaman.menu_id', '=', 'menu.id')
            ->where('menu.is_active', 1)
            ->where('halaman.is_active', 1)
            ->where('halaman.page_halaman', '>', 0)
            ->select('menu.*', 'halaman.*')
            ->orderBy('halaman.page_halaman', 'ASC')
            ->get();

                $menu = Menu::where('is_active', 1)->orderBy('urutan_menu', 'desc')->get();
            $halaman_detail = Halaman::with('author_halaman')->where('slug', $slug)->first();

        $grouphalaman = $halaman->groupBy('menu_id');
        $media = sosmedinstansi::all();
        $app = Appnama::first();

        return view('front.pelayanan', compact('slug','ip','app','pengumuman','download','media', 'mingguan', 'bulanan', 'kemarin', 'totalvisit', 'hariini','pelayanan','halaman', 'grouphalaman','menu', 'halaman_detail'));
    }
}
