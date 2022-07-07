<?php

namespace App\Http\Controllers;

use App\Models\SuratModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use File;

class SuratController extends Controller
{
    public function index()
    {
        return view('berkas.dashboard')->with([
            'title' => 'Data Berkas',
            'subtitle1' => 'Data Berkas',
            'subtitle2' => 'Pilih Jenis dan Sub Jenis'
        ]);
    }

    public function readData(Request $request)
    {
        if (!DB::table('surat')->where('sub_jenis_surat', $request->id_data)->first()) {
            abort(404);
        }

        try {
            $surat = DB::table('surat')->where('sub_jenis_surat', $request->id_data)->get();
            $sub_jenis = DB::table('subjenis_surat')->where('id', $request->id_data)->first();
            return view('data.read')->with([
                'surat' => $surat,
                'title' => 'Surat Masuk',
                'id_jenis' => $request->id_data,
                'id_sub_jenis' => $sub_jenis->jenis_surat
            ]);
        } catch (\Throwable $th) {
            dd('error', $th);
        }
    }

    public function createBerkasPage(Request $request)
    {
        try {
            $jenis = DB::table('jenis_surat')->where('id', $request->id_jenis)->first();

            return view('data.create')->with([
                'jenis' => $jenis->nama,
                'id_jenis' => $request->id_jenis,
                'id_sub_jenis' => $request->id_sub_jenis,
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function chooseCategory()
    {
        return view('berkas.choose_category');
    }

    public function createBerkasData(Request $request)
    {
        DB::beginTransaction();


        try {
            $SuratModel = new SuratModel;

            $SuratModel->kode_surat = $request->kode_surat;
            $SuratModel->jenis_surat = $request->jenis_surat;
            $SuratModel->sub_jenis_surat = $request->sub_jenis_surat;
            $SuratModel->tgl_terima_surat = $request->tgl_terima_surat;
            $SuratModel->asal_surat = $request->asal_surat;
            $SuratModel->tgl_masuk_surat = $request->tgl_masuk_surat;
            $SuratModel->nomor_surat = $request->nomor_surat;
            $SuratModel->tujuan_surat = "2";
            $SuratModel->perihal_surat = $request->perihal_surat;

            $datenow = date('Y-m-d H.i.s');
            $file = $request->file('file');
            $SuratModel->file = $request->kode_surat . "_" . $datenow . "_" . $file->getClientOriginalName();

            $direktori_upload = 'data_file\berkas_upload';
            $file->move($direktori_upload, $request->kode_surat . "_" . $datenow . "_" . $file->getClientOriginalName());

            if (!$SuratModel->save()) {
                throw new Exception("Gagal Menyimpan Data");
            }

            DB::commit();

            return redirect()->route('read_data_berkas', ['id_data' => $request->sub_jenis_surat])->with('toast_success', 'Task Created Successfully!');
        } catch (\Throwable $th) {
            DB::rollback();
            dd("Error : ", $th);
        }
    }

    public function detailData(Request $request)
    {
        if (!DB::table('surat')->where('id', $request->id_data)->first()) {
            abort(404);
        }

        try {
            $berkas = DB::table('surat')->where('id', $request->id_data)->first();
            $jenis_surat = DB::table('jenis_surat')->where('id', $berkas->jenis_surat)->first();
            $sub_jenis_surat = DB::table('subjenis_surat')->where('id', $berkas->sub_jenis_surat)->first();

            return view('data.detail_berkas')->with([
                'berkas' => [
                    'id' => $berkas->id,
                    'kode_surat' => $berkas->kode_surat,
                    'jenis_surat' => $jenis_surat->nama,
                    'sub_jenis_surat' => $sub_jenis_surat->nama,
                    'tgl_terima_surat' => $berkas->tgl_terima_surat,
                    'tgl_masuk_surat' => $berkas->tgl_masuk_surat,
                    'nomor_surat' => $berkas->nomor_surat,
                    'asal_surat' => $berkas->asal_surat,
                    'tujuan_surat' => $berkas->tujuan_surat,
                    'perihal_surat' => $berkas->perihal_surat,
                    'file' => $berkas->file,
                ],
                'title' => 'Detail Berkas'
            ]);
        } catch (\Throwable $th) {
            dd("error : ", $th);
        }
    }

    public function editBerkasPage(Request $request)
    {
        if (!DB::table('surat')->where('id', $request->id_data)->first()) {
            abort(404);
        }

        try {
            $berkas = DB::table('surat')->where('id', $request->id_data)->first();
            $jenis_surat = DB::table('jenis_surat')->where('id', $berkas->jenis_surat)->first();
            $sub_jenis_surat = DB::table('subjenis_surat')->where('id', $berkas->sub_jenis_surat)->first();

            return view('data.edit')->with([
                'berkas' => [
                    'id' => $request->id_data,
                    'kode_surat' => $berkas->kode_surat,
                    'jenis_surat' => $jenis_surat->nama,
                    'sub_jenis_surat' => $sub_jenis_surat->nama,
                    'tgl_terima_surat' => $berkas->tgl_terima_surat,
                    'tgl_masuk_surat' => $berkas->tgl_masuk_surat,
                    'nomor_surat' => $berkas->nomor_surat,
                    'asal_surat' => $berkas->asal_surat,
                    'tujuan_surat' => $berkas->tujuan_surat,
                    'perihal_surat' => $berkas->perihal_surat,
                    'file' => $berkas->file,
                ],
                'title' => 'Detail Berkas'
            ]);
        } catch (\Throwable $th) {
            dd('Error : ', $th);
        }
    }

    public function downloadFile(Request $request)
    {
        if (!DB::table('surat')->where('id', $request->id_data)->first()) {
            abort(404);
        }

        try {
            $surat = DB::table('surat')->where('id', $request->id_data)->first();

            $file_name = explode(".", $surat->file);

            $myFile = public_path("/data_file/berkas_upload/" . $surat->file);
            $headers = ['Content-Type: application/pdf'];
            $newName = time() . $surat->file;

            return response()->download($myFile, $newName, $headers);
            // return response()->download(public_path('\data_file\Logo FBI png.png'));
        } catch (\Throwable $th) {
            dd('Error : ', $th);
        }
    }

    public function deleteData(Request $request)
    {
        if (!DB::table('surat')->where('id', $request->id_data)->first()) {
            abort(404);
        }

        DB::beginTransaction();
        try {

            $berkas = SuratModel::find($request->id_data);
            $berkas->delete();

            if (File::exists(public_path('data_file/berkas_upload/' . $berkas->file))) {
                File::delete(public_path('data_file/berkas_upload/' . $berkas->file));
            } else {
                dd('File does not exists.');
            } 

            DB::commit();

            return redirect()->route('read_data_berkas', ['id_data' => $request->id_sub_jenis])->with('toast_success', 'Task Created Successfully!');
        } catch (\Throwable $th) {

            DB::rollback();
            dd("error cuy gatau :(");
        }
    }
}
