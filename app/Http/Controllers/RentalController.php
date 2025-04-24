<?php

namespace App\Http\Controllers;

use App\Models\MahasiswaModel;
use Illuminate\Http\Request;
use App\Models\RentalModel;
use App\Models\KategoriModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class RentalController extends Controller
{
    // menampilkan halaman awal rental
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Rental',
            'list' => ['Home', 'Rental']
        ];
        $page = (object) [
            'title' => 'Rental barang yang terdaftar dalam sistem'
        ];
        $activeMenu = 'rental'; //set menu yang sedang aktif

        $rental = RentalModel::all(); //ambil data rental untuk filter rental
        $kategori = KategoriModel::all(); //ambil data rental untuk filter rental
        $mahasiswa = MahasiswaModel::all(); //ambil data rental untuk filter rental
        return view('rental.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'rental' => $rental, 'kategori' => $kategori, 'mahasiswa' => $mahasiswa, 'activeMenu' => $activeMenu]);
    }
    
    public function destroy(string $id)
    {
        $check = RentalModel::find($id);
        if (!$check) { //untuk mengecek apakah data rental dengan id yang sedang dihapus ada atau tidak
            return redirect('/rental')->with('error', 'Data rental tidak ditemukan');
        }

        try {
            RentalModel::destroy($id); //hapus data rental
            return redirect('/rental')->with('success', 'Data rental berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            //jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
            return redirect('/rental')->with('error', 'Data rental gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
    // jobsheet 6
    public function create_ajax()
    {
        $kategori = KategoriModel::select('kategori_id', 'kategori_nama')->get();
        $mahasiswa = MahasiswaModel::select('id_mahasiswa', 'nim')->get();
        return view(
            'rental.create_ajax',
            [
                'kategori' => $kategori,
                'mahasiswa' => $mahasiswa
            ]);
    }

    public function store_ajax(Request $request)
    {
        //cek apakah request berupa ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'id_mahasiswa' => 'required|string',
                'kategori_id' => 'required|string',
                'total_pinjam' => 'required|string',
                'tgl_pinjam' => 'required|date',
                'tgl_kembali' => 'required|date',
            ];

            // use Illiminate\Support\Facades\Validator
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false, //response status, false: error/gagal, true: berhasil
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(), //pesan error validasi
                ]);
            }
            RentalModel::create(
                [
                    'id_mahasiswa' => $request->id_mahasiswa,
                    'kategori_id' => $request->kategori_id,
                    'total_pinjam' => $request->total_pinjam,
                    'tgl_pinjam' => $request->tgl_pinjam,
                    'tgl_kembali' => $request->tgl_kembali,
                ]
            );
            return response()->json([
                'status' => true, //response status, false: error/gagal, true: berhasil
                'message' => 'Data rental Berhasil Disimpan',
            ]);
        }
        redirect('/');
    }

    // Ambil data rental dalam bentuk json untuk datatables
    public function list(Request $request)
    {
        $rental = RentalModel::select('id_rental','id_mahasiswa', 'kategori_id', 'total_pinjam', 'tgl_pinjam', 'tgl_kembali')
        ->with('kategori', 'mahasiswa');
        // filter data rental brdasarkan id_rental
        if ($request->id_mahasiswa) {
            $rental->where('id_mahasiswa', $request->id_mahasiswa);
        }
        if ($request->kategori_id) {
            $rental->where('kategori_id', $request->kategori_id);
        }
        if ($request->id_rental) {
            $rental->where('id_rental', $request->id_rental);
        }

        return DataTables::of($rental)
            // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addIndexColumn()
            ->addColumn('aksi', function ($rental) { // menambahkan kolom aksi
                $btn  = '<button onclick="modalAction(\'' . url('/rental/' . $rental->id_rental .
                    '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/rental/' . $rental->id_rental .
                    '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/rental/' . $rental->id_rental .
                    '/delete_ajax') . '\')"  class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }

    public function edit_ajax(string $id)
    {
        $rental = RentalModel::find($id);
        $mahasiswa = MahasiswaModel::select('id_mahasiswa', 'nim')->get();
        $kategori = KategoriModel::select('kategori_id', 'kategori_nama')->get();

        return view('rental.edit_ajax', ['rental' => $rental, 'mahasiswa' => $mahasiswa, 'kategori' => $kategori]);
    }

    public function update_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'id_mahasiswa' => 'required|string|max:10',
                'kategori_id' => 'required|string',
                'total_pinjam' => 'required|string',
                'tgl_pinjam' => 'required|date',
                'tgl_kembali' => 'required|date',
            ];
            // use Illuminate\Support\Facades\Validator; 
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status'   => false,    // respon json, true: berhasil, false: gagal 
                    'message'  => 'Validasi gagal.',
                    'msgField' => $validator->errors()  // menunjukkan field mana yang error 
                ]);
            }

            $check = RentalModel::find($id);
            if ($check) {
                $check->update($request->all());
                return response()->json([
                    'status'  => true,
                    'message' => 'Data berhasil diupdate'
                ]);
            } else {
                return response()->json([
                    'status'  => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }

    public function confirm_ajax(string $id)
    {
        $rental = RentalModel::find($id);
        return view('rental.confirm_ajax', ['rental' => $rental]);
    }

    public function show_ajax(string $id)
    {
        $rental = RentalModel::find($id);
        return view('rental.show_ajax', ['rental' => $rental]);
    }

    public function delete_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rental = RentalModel::find($id);
            if ($rental) {
                $rental->delete();
                return response()->json([
                    'status'  => true,
                    'message' => 'Data berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status'  => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }
}
