<?php

namespace App\Http\Controllers;

use App\Models\sumberdana;
use App\Models\transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('setUserRole');
    }

    public function index(Request $request)
    {

        $danapertahun = sumberdana::selectRaw('YEAR(tanggal) as tahun, SUM(total) as total')
        ->groupBy('tahun')
        ->get();

        $sumberdana = sumberdana::all();
        $role = $request->role;
        return view('form.sumberdana.dana', compact('sumberdana', 'role','danapertahun'));
    }

    public function create_dana(Request $request)
    {
        $role = $request->role;

        return view('form.sumberdana.create', compact('role'));
    }

    public function store_dana(Request $request)
    {
        try {
            $request->validate([
                'nama_dana' => 'required|string|max:255',
                'tanggal_dana' => 'required|date',
                'dana_total' => 'required|numeric',
                'dana_deskripsi' => 'nullable|string',
                'file_dana' => 'required|mimes:pdf,doc,docx,jpeg,png,gif|max:2048',
            ], [
                'nama_dana.required' => 'Nama sumber dana wajib diisi.',
                'nama_dana.max' => 'Nama sumber dana tidak boleh melebihi :max karakter.',
                'tanggal_dana.required' => 'Tanggal wajib diisi.',
                'tanggal_dana.date' => 'Format tanggal tidak valid.',
                'dana_total.required' => 'Jumlah dana wajib diisi.',
                'dana_total.numeric' => 'Jumlah dana harus berupa angka.',
                'file_dana' => 'Wajib memasukan File maksimal 2 MB',

            ]);
            $role = $request->role;

            $nama_dana = $request->nama_dana;
            $tanggal = $request->tanggal_dana;
            $total = $request->dana_total;
            $deskripsi = $request->dana_deskripsi;

            $sumberDana = new SumberDana();
            $sumberDana->sumber_dana = $nama_dana;
            $sumberDana->tanggal = $tanggal;
            $sumberDana->user_id = Auth::user()->id;

            if ($request->hasFile('file_dana')) {
                $file = $request->file('file_dana');
                $rand = rand(10, 999);
                $fileName = $file->getClientOriginalName();
                $filePath = 'file/sumberdana/' . $rand . $fileName;
                $file->move(public_path('file/sumberdana/'), $rand . $fileName);
                $sumberDana->file_dana = $filePath;
            }


            $formattedTotal = str_replace(',', '', $total);
            $formattedTotal = str_replace('.', '', $formattedTotal);
            $sumberDana->total = intval($formattedTotal);

            $sumberDana->deskripsi = $deskripsi;
            $sumberDana->save();

            return redirect()->route($role . '.sumber_dana')->with('success', 'Data berhasil disimpan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function update_dana(Request $request, $id)
    {
        try {
            $role = $request->role;

            $nama_dana = $request->nama_dana;
            $tanggal = $request->tanggal_dana;
            $total = $request->dana_total;
            $deskripsi = $request->dana_deskripsi;

            $sumberDana = sumberdana::findOrFail($id);

            $sumberDana->sumber_dana = $nama_dana;
            $sumberDana->tanggal = $tanggal;

            if ($request->hasFile('file_dana')) {
                $file = $request->file('file_dana');
                $rand = rand(10, 999);
                $fileName = $file->getClientOriginalName();
                $filePath = 'file/sumberdana/' . $rand . $fileName;
                $file->move(public_path('file/sumberdana/'), $rand . $fileName);
                $sumberDana->file_dana = $filePath;
            }
            $sumberDana->user_id = Auth::user()->id;
            $formattedTotal = str_replace(',', '', $total);
            $formattedTotal = str_replace('.', '', $formattedTotal);
            $sumberDana->total = intval($formattedTotal);

            $sumberDana->deskripsi = $deskripsi;
            $sumberDana->update();

            return redirect()->route($role . '.sumber_dana')->with('success', 'Data berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    public function delete_dana($id)
    {

        $sumberdana = sumberdana::find($id);
        if ($sumberdana->file_dana) {
            $filePath = public_path($sumberdana->file_dana);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        $sumberdana->delete();

        return back()->with('success', 'data berhasil di delete');
    }


    public function transaksi(Request $request)
    {
        $role = $request->role;
        $transaksi = Transaksi::with('dana')
            ->join('sumber_dana', 'sumber_dana.id', '=', 'transaksi.id_dana')
            ->select(
                'transaksi.id_dana',
                'transaksi.id',
                DB::raw('SUM(transaksi.total_transaksi) as total_transaksi_data'),
                'transaksi.deskripsi',
                'transaksi.tanggal',
                'transaksi.total_transaksi',
                'transaksi.jenis_transaksi',
                'transaksi.status',
                'transaksi.file_transaksi',
                'sumber_dana.total'
            )
            ->groupBy('transaksi.id_dana', 'transaksi.id',  'transaksi.file_transaksi', 'transaksi.deskripsi',  'sumber_dana.total', 'transaksi.status','transaksi.tanggal', 'transaksi.total_transaksi', 'transaksi.jenis_transaksi')->get();

            $danapertahun = Transaksi::join('sumber_dana', 'transaksi.id_dana', '=', 'sumber_dana.id')
            ->selectRaw('YEAR(transaksi.tanggal) as tahun, SUM(total_transaksi) as total, SUM(total) as totalmasuk')
            ->where('status', 1)
            ->groupBy('tahun')
            ->get();




        $sumberdana = sumberdana::all();
        // dd($transaksi);

        return view('form.transaksi.index', compact('transaksi', 'sumberdana', 'role','danapertahun'));
    }

    public function transaksimasuk($tahun){
        $danapertahun = sumberdana::selectRaw('YEAR(tanggal) as tahun, SUM(total) as total')
        ->whereYear('tanggal', $tahun)
        ->groupBy('tahun')
        ->get();
        return response($danapertahun);
    }

    public function transaksitahunan($tahun){



        $danapertahun = Transaksi::join('sumber_dana', 'transaksi.id_dana', '=', 'sumber_dana.id')
            ->selectRaw('YEAR(transaksi.tanggal) as tahun, SUM(total_transaksi) as total, SUM(total) as totalmasuk')
            ->whereYear('transaksi.tanggal', $tahun)
            ->where('status', 1)
            ->groupBy('tahun')
            ->get();

        return response($danapertahun);
    }



    public function store_transaksi(Request $request)
    {
        try {

            $this->validate($request, [
                'jenis_transaksi' => 'required',
                'nama_pengeluaran' => 'required|string|max:255',
                'total_pengeluaran' => 'required|numeric',
                'transaksi_deskripsi' => 'required',
                'tanggal_transaksi' => 'required|date',
                'status' => 'required',
                'file_transaksi' => 'required|mimes:pdf,doc,docx,jpeg,png,gif|max:2048',
            ], [
                'jenis_transaksi.required' => 'Jenis transaksi wajib diisi.',
                'nama_pengeluaran.required' => 'Nama pengeluaran wajib diisi.',
                'nama_pengeluaran.max' => 'Nama pengeluaran tidak boleh lebih dari :max karakter.',
                'total_pengeluaran.required' => 'Total pengeluaran wajib diisi.',
                'total_pengeluaran.numeric' => 'Total pengeluaran harus berupa angka.',
                'tanggal_transaksi.required' => 'Tanggal transaksi wajib diisi.',
                'tanggal_transaksi.date' => 'Tanggal transaksi harus dalam format tanggal yang valid.',
                'status.required' => 'Status wajib diisi.',
                'file_transaksi' => 'Harap unggah file maksimal 2 MB.',
            ]);

            $role = $request->role;
            $jenis_transaksi = $request->jenis_transaksi;
            $nama_pengeluaran = $request->nama_pengeluaran;
            $total_pengeluaran = $request->total_pengeluaran;
            $deskripsi = $request->transaksi_deskripsi;

            $tanggal = $request->tanggal_transaksi;
            $status = $request->status;
            $pengeluaran = new transaksi();
            $pengeluaran->user_id = Auth::user()->id;

            $pengeluaran->id_dana = $jenis_transaksi;
            $pengeluaran->jenis_transaksi = $nama_pengeluaran;
            $pengeluaran->tanggal = $tanggal;
            $pengeluaran->status = $status;

            if ($request->hasFile('file_transaksi')) {
                $file = $request->file('file_transaksi');
                $rand = rand(10, 999);
                $time = time();
                $fileName = $file->getClientOriginalName();
                $filePath = 'file/pengeluaran/' . $time . '_' . $rand . '_' . $fileName;
                $file->move(public_path('file/pengeluaran/'), $time . '_' . $rand . '_' . $fileName);
                $pengeluaran->file_transaksi = $filePath;
            }


            $formattedTotal = str_replace(',', '', $total_pengeluaran);
            $formattedTotal = str_replace('.', '', $formattedTotal);
            $pengeluaran->total_transaksi = intval($formattedTotal);

            $pengeluaran->deskripsi = $deskripsi;
            $pengeluaran->save();

            return redirect()->route($role . '.transaksi')->with('success', 'Data berhasil disimpan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function update_transaksi(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'jenis_transaksi' => 'required',
                'nama_pengeluaran' => 'required|string|max:255',
                'total_pengeluaran' => 'required|numeric',
                'transaksi_deskripsi' => 'nullable|string',
                'tanggal_transaksi' => 'required|date',
                'status' => 'required',
                'file_transaksi' => 'nullable|mimes:pdf,doc,docx,jpeg,png,gif|max:2048',
            ], [
                'jenis_transaksi.required' => 'Jenis transaksi wajib diisi.',
                'nama_pengeluaran.required' => 'Nama pengeluaran wajib diisi.',
                'nama_pengeluaran.max' => 'Nama pengeluaran tidak boleh lebih dari :max karakter.',
                'total_pengeluaran.required' => 'Total pengeluaran wajib diisi.',
                'total_pengeluaran.numeric' => 'Total pengeluaran harus berupa angka.',
                'tanggal_transaksi.required' => 'Tanggal transaksi wajib diisi.',
                'tanggal_transaksi.date' => 'Tanggal transaksi harus dalam format tanggal yang valid.',
                'status.required' => 'Status wajib diisi.',
                'file_transaksi' => 'Harap unggah file maksimal 2 MB.',
            ]);

            $pengeluaran = Transaksi::findOrFail($id);

            $pengeluaran->id_dana = $request->jenis_transaksi;
            $pengeluaran->jenis_transaksi = $request->nama_pengeluaran;
            $pengeluaran->tanggal = $request->tanggal_transaksi;
            $pengeluaran->status = $request->status;
            $pengeluaran->user_id = Auth::user()->id;

            if ($request->hasFile('file_transaksi')) {
                $file = $request->file('file_transaksi');
                $rand = rand(10, 999);
                $time = time();
                $fileName = $file->getClientOriginalName();
                $filePath = 'file/pengeluaran/' . $time . '_' . $rand . '_' . $fileName;
                $file->move(public_path('file/pengeluaran/'), $time . '_' . $rand . '_' . $fileName);
                $pengeluaran->file_transaksi = $filePath;
            }

            $formattedTotal = str_replace(',', '', $request->total_pengeluaran);
            $formattedTotal = str_replace('.', '', $formattedTotal);
            $pengeluaran->total_transaksi = intval($formattedTotal);

            $pengeluaran->deskripsi = $request->transaksi_deskripsi;
            $pengeluaran->update();

            return redirect()->route($request->role . '.transaksi')->with('success', 'Data berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function delete_transaksi($id)
    {

        $transaksi = transaksi::find($id);
        if ($transaksi->file_transaksi) {
            $filePath = public_path($transaksi->file_transaksi);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        $transaksi->delete();

        return back()->with('success', 'data berhasil di delete');
    }
}
