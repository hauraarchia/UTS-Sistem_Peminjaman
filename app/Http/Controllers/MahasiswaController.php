<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MahasiswaModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    // menampilkan halaman awal mahasiswa
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Mahasiswa',
            'list' => ['Home', 'Mahasiswa']
        ];
        $page = (object) [
            'title' => 'Mahasiswa yang terdaftar dalam sistem'
        ];
        $activeMenu = 'mahasiswa'; //set menu yang sedang aktif

        $mahasiswa = MahasiswaModel::all(); //ambil data mahasiswa untuk filter mahasiswa
        return view('mahasiswa.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'mahasiswa' => $mahasiswa, 'activeMenu' => $activeMenu]);
    }

    public function create_ajax()
    {
        $mahasiswa = MahasiswaModel::select('nim', 'nama', 'jurusan', 'no_hp')->get();

        return view('mahasiswa.create_ajax')
            ->with('mahasiswa', $mahasiswa);
    }

    public function store_ajax(Request $request)
    {
        //cek apakah request berupa ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nim' => 'required|string|min:10|max:10|unique:data_mahasiswa,nim',
                'nama' => 'required|string|max:100', // nama mahasiswa harus diisi, berupa string, dan maksimal 100 karakter  
                'jurusan' => 'required|string|max:100',
                'no_hp' => 'required|string|min:12|max:13',
            ];

            // use Illiminate\Support\Facades\Validator
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false, //responAse status, false: error/gagal, true: berhasil
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(), //pesan error validasi
                ]);
            }
            MahasiswaModel::create(
                [
                    'nim' => $request->nim,
                    'nama' => $request->nama,
                    'jurusan' => $request->jurusan,
                    'no_hp' => $request->no_hp,
                ]
            );
            return response()->json([
                'status' => true, //response status, false: error/gagal, true: berhasil
                'message' => 'Data mahasiswa Berhasil Disimpan',
            ]);
        }
        redirect('/');
    }

    // Ambil data mahasiswa dalam bentuk json untuk datatables
    public function list(Request $request)
    {
        $mahasiswa = MahasiswaModel::select('id_mahasiswa','nim', 'nama', 'jurusan', 'no_hp');

        // filter data mahasiswa brdasarkan id_mahasiswa
        if ($request->id_mahasiswa) {
            $mahasiswa->where('id_mahasiswa', $request->id_mahasiswa);
        }

        return DataTables::of($mahasiswa)
            // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addIndexColumn()
            ->addColumn('aksi', function ($mahasiswa) { // menambahkan kolom aksi
                $btn  = '<button onclick="modalAction(\'' . url('/mahasiswa/' . $mahasiswa->id_mahasiswa .
                    '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/mahasiswa/' . $mahasiswa->id_mahasiswa .
                    '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/mahasiswa/' . $mahasiswa->id_mahasiswa .
                    '/delete_ajax') . '\')"  class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }

    public function edit_ajax(string $id)
    {
        $mahasiswa = MahasiswaModel::find($id);
        // $mahasiswa = MahasiswaModel::select('id_mahasiswa', 'mahasiswa_nama')->get();

        return view('mahasiswa.edit_ajax', ['mahasiswa' => $mahasiswa]);
    }

    public function update_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nim' => 'required|string|min:10|max:10|unique:data_mahasiswa,nim,' . $id . ',id_mahasiswa',
                'nama' => 'required|string|max:100', // nama mahasiswa harus diisi, berupa string, dan maksimal 100 karakter  
                'jurusan' => 'required|string|max:100',
                'no_hp' => 'required|string|min:12|max:13',
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

            $check = MahasiswaModel::find($id);
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
        $mahasiswa = MahasiswaModel::find($id);
        return view('mahasiswa.confirm_ajax', ['mahasiswa' => $mahasiswa]);
    }

    public function show_ajax(string $id)
    {
        $mahasiswa = MahasiswaModel::find($id);
        return view('mahasiswa.show_ajax', ['mahasiswa' => $mahasiswa]);
    }

    public function delete_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $mahasiswa = MahasiswaModel::find($id);
            if ($mahasiswa) {
                $mahasiswa->delete();
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
