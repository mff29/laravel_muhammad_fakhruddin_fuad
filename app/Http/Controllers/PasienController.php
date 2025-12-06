<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\RumahSakit;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            return DataTables::of(Pasien::with('rs')->get())
                ->addIndexColumn()
                ->addColumn('action', function ($row){
                    $btn  = '<button type="button" class="btn btn-warning btn-sm me-1 btn-edit" 
                                data-id="' . e($row->id) . '" 
                                data-nama="' . e($row->nama_pasien) . '"
                                data-alamat="' . e($row->alamat) . '"
                                data-email="' . e($row->email) . '"
                                data-telepon="' . e($row->telepon) . '"
                                data-rs="'.$row->rumah_sakit_id.'"
                                title="Edit">
                                <i class="bi bi-pencil"></i>
                            </button>';
                    $btn .= '<button type="button" onclick="alert_delete(\'' . $row->id . '\')" class="btn btn-danger btn-sm" title="Hapus"><i class="bi bi-trash"></i></button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $data['rs'] = RumahSakit::all();
        return view('pasien.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rumah_sakit_id' => 'required',
            'nama_pasien' => 'required|string',
            'alamat' => 'required|string',
            'telepon' => ['required', 'regex:/^(\+?62|0)[0-9]{8,15}$/'],
        ]);

        Pasien::create($request->all());

        // return redirect(route('pasien.index'));
        return response()->json(['message' => 'Berhasil disimpan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'rumah_sakit_id' => 'required',
            'nama_pasien' => 'required|string',
            'alamat' => 'required|string',
            'telepon' => ['required', 'regex:/^(\+?62|0)[0-9]{8,15}$/'],
        ]);

        $student = Pasien::findOrFail($id);
        $student->update($request->all());

        // return redirect(route('pasien.index'));
        return response()->json(['message' => 'Berhasil diperbarui']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mhs = Pasien::findOrFail($id);
        return $mhs->delete();
    }
}
