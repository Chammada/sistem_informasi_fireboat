<?php

namespace App\Http\Controllers;

use App\Models\Berkas;
use App\Models\JenisBerkas;
use App\Models\Role;
use App\Models\SubJenisBerkas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use File;
use setasign\Fpdi\Fpdi;

class BerkasController extends Controller
{
  public function index()
  {
    $data = [];
    return $this->view('berkas.dashboard', $data);
  }

  public function chooseCategory(Request $request)
  {
    if ($request->sub_jenis_modal == 1) {
      return redirect()->route('read_berkas', ['id_sub_jenis' => $request->id_sub_jenis]);
    } elseif ($request->sub_jenis_modal == 2) {
      $sub_jenis = SubJenisBerkas::where('id', $request->id_sub_jenis)->first();
      $jenis_berkas = JenisBerkas::where('id', $sub_jenis->jenis_surat)->first();
      return redirect()->route('create_berkas_page', ['id_sub_jenis' => $request->id_sub_jenis, 'id_jenis' => $jenis_berkas->id]);
    } elseif ($request->sub_jenis_modal == 3) {
      return redirect()->route('approved_berkas', ['id_sub_jenis' => $request->id_sub_jenis]);
    } elseif ($request->sub_jenis_modal == 4) {
      return redirect()->route('unapproved_berkas', ['id_sub_jenis' => $request->id_sub_jenis]);
    }
  }

  public function readData(Request $request)
  {

    if (!SubJenisBerkas::find($request->id_sub_jenis)) {
      abort(404);
    }

    try {
      $this->surat = Berkas::where('sub_jenis_surat', $request->id_sub_jenis)->get();
      $this->sub_jenis = SubJenisBerkas::where('id', $request->id_sub_jenis)->first();
      $this->jenis = JenisBerkas::where('id', $this->sub_jenis->jenis_surat)->first();

      $this->page = [
        'title' => $this->jenis->nama,
        'sub_title' => $this->sub_jenis->nama,
        'id_jenis' => $this->jenis->id,
        'id_sub_jenis' => $this->sub_jenis->id
      ];

      $data = ['surat', 'sub_jenis', 'jenis', 'page'];

      return $this->view('berkas.read', $data)->with('error', 'Error during the creation!');
    } catch (\Throwable $th) {
      dd('error', $th);
    }
  }

  public function createBerkasPage(Request $request)
  {
    if (!SubJenisBerkas::find($request->id_sub_jenis)) {
      abort(404);
    }

    try {
      $this->sub_jenis = SubJenisBerkas::where('id', $request->id_sub_jenis)->first();
      $this->jenis = JenisBerkas::where('id', $request->id_jenis)->first();

      $this->page = [
        'jenis' => $this->jenis->nama,
        'sub_jenis' => $this->sub_jenis->nama,
        'id_jenis' => $request->id_jenis,
        'id_sub_jenis' => $request->id_sub_jenis,
      ];

      $data = ['sub_jenis', 'jenis', 'page'];

      return $this->view('berkas.create', $data);
    } catch (\Throwable $th) {
      dd("Error : ", $th);
    }
  }

  public function createBerkasData(Request $request)
  {
    DB::beginTransaction();

    try {

      $validatedData = $request->validate([
        'kode_surat' => 'required|max:255',
        'jenis_surat' => 'required|max:255',
        'sub_jenis_surat' => 'required|max:255',
        'tgl_terima_surat' => 'required|max:255',
        'asal_surat' => 'max:255',
        'tgl_masuk_surat' => 'required|max:255',
        'nomor_surat' => 'required|max:255',
        'tujuan_surat' => 'max:255',
        'perihal_surat' => 'required|max:255',
        'file' => 'required'
      ]);

      $Berkas = new Berkas;

      $Berkas->kode_surat = $validatedData['kode_surat'];
      $Berkas->jenis_surat = $validatedData['jenis_surat'];
      $Berkas->sub_jenis_surat = $validatedData['sub_jenis_surat'];
      $Berkas->tgl_terima_surat = $validatedData['tgl_terima_surat'];
      $Berkas->tgl_masuk_surat = $validatedData['tgl_masuk_surat'];
      $Berkas->nomor_surat = $validatedData['nomor_surat'];
      $Berkas->perihal_surat = $validatedData['perihal_surat'];
      $Berkas->status = 0; //status dokumen belum fiksasi

      if (!$request->asal_surat) {
        $Berkas->tujuan_surat = $validatedData['tujuan_surat'];
      } elseif (!$request->tujuan_surat) {
        $Berkas->asal_surat = $validatedData['asal_surat'];
      }

      $datenow = date('Y-m-d H.i.s');
      $file = $request->file('file');
      $Berkas->file = $request->kode_surat . "_" . $datenow . "_" . $file->getClientOriginalName();

      $direktori_upload = 'data_file\berkas_upload';
      $file->move($direktori_upload, $request->kode_surat . "_" . $datenow . "_" . $file->getClientOriginalName());

      if (!$Berkas->save()) {
        throw new Exception("Gagal Menyimpan Data");
      }

      DB::commit();

      return redirect()->route('read_berkas', ['id_sub_jenis' => $request->sub_jenis_surat])->with('success', 'Task Created Successfully!');
    } catch (\Exception $e) {
      DB::rollBack();
      return back()->with(['error' => $e->getMessage(), 'title' => 'Membuat Data Berkas Gagal']);
    }
  }

  public function detailData(Request $request)
  {
    if (!Berkas::find($request->id_data)) {
      abort(404);
    }

    try {
      $this->berkas = Berkas::find($request->id_data);
      // $berkas = DB::table('berkas')->where('id', $request->id_data)->first();
      $this->jenis_surat = DB::table('jenis_berkas')->where('id', $this->berkas->jenis_surat)->first();
      $this->sub_jenis_surat = DB::table('sub_jenis_berkas')->where('id', $this->berkas->sub_jenis_surat)->first();

      $this->page = [
        'berkas' => [
          'id' => $this->berkas->id,
          'kode_surat' => $this->berkas->kode_surat,
          'jenis_surat' => $this->jenis_surat->nama,
          'sub_jenis_surat' => $this->sub_jenis_surat->nama,
          'tgl_terima_surat' => $this->berkas->tgl_terima_surat,
          'tgl_masuk_surat' => $this->berkas->tgl_masuk_surat,
          'nomor_surat' => $this->berkas->nomor_surat,
          'asal_surat' => $this->berkas->asal_surat,
          'tujuan_surat' => $this->berkas->tujuan_surat,
          'perihal_surat' => $this->berkas->perihal_surat,
          'file' => $this->berkas->file,
        ],
        'title' => 'Detail Berkas'
      ];

      $data = ['berkas', 'jenis_surat', 'sub_jenis_surat', 'page'];

      return $this->view('berkas.detail_berkas', $data);
    } catch (\Throwable $th) {
      dd("error : ", $th);
    }
  }

  public function editBerkasPage(Request $request)
  {
    if (!Berkas::find($request->id_data)) {
      abort(404);
    }

    try {
      $this->berkas = Berkas::find($request->id_data);
      $this->jenis_surat = DB::table('jenis_berkas')->where('id', $this->berkas->jenis_surat)->first();
      $this->sub_jenis_surat = DB::table('sub_jenis_berkas')->where('id', $this->berkas->sub_jenis_surat)->first();

      $this->page = [
        'berkas' => [
          'id' => $this->berkas->id,
          'kode_surat' => $this->berkas->kode_surat,
          'jenis_surat' => $this->jenis_surat->nama,
          'sub_jenis_surat' => $this->sub_jenis_surat->nama,
          'tgl_terima_surat' => $this->berkas->tgl_terima_surat,
          'tgl_masuk_surat' => $this->berkas->tgl_masuk_surat,
          'nomor_surat' => $this->berkas->nomor_surat,
          'asal_surat' => $this->berkas->asal_surat,
          'tujuan_surat' => $this->berkas->tujuan_surat,
          'perihal_surat' => $this->berkas->perihal_surat,
          'file' => $this->berkas->file,
          'status' => $this->berkas->status,
        ],
        'title' => 'Detail Berkas'
      ];

      $data = ['berkas', 'page'];

      return $this->view('berkas.edit', $data);
    } catch (\Exception $e) {
      DB::rollBack();
      return back()->with(['error' => $e->getMessage(), 'title' => 'Edit Data Berkas Gagal']);
    }
  }

  public function viewFile(Request $request)
  {
    if (!Berkas::find($request->id_data)) {
      abort(404);
    }

    try {
      $berkas = Berkas::find($request->id_data);

      $this->myFile = asset("/data_file/berkas_upload/" . $berkas->file);

      // dd($myFile);

      return $this->view('berkas.pdf_viewer', ['myFile']);
    } catch (\Throwable $th) {
      dd('Error : ', $th);
    }
  }

  public function downloadFile(Request $request)
  {
    if (!Berkas::find($request->id_data)) {
      abort(404);
    }

    try {
      $berkas = Berkas::find($request->id_data);

      $file_name = explode(".", $berkas->file);

      $myFile = public_path("/data_file/berkas_upload/" . $berkas->file);
      $headers = ['Content-Type: application/pdf'];
      $newName = time() . $berkas->file;

      return response()->download($myFile, $newName, $headers);
      // return response()->download(public_path('\data_file\Logo FBI png.png'));
    } catch (\Throwable $th) {
      dd('Error : ', $th);
    }
  }

  public function deleteData(Request $request)
  {
    if (!Berkas::find($request->id_data)) {
      abort(404);
    }

    DB::beginTransaction();
    try {

      $berkas = Berkas::find($request->id_data);
      $berkas->delete();

      if (File::exists(public_path('data_file/berkas_upload/' . $berkas->file))) {
        File::delete(public_path('data_file/berkas_upload/' . $berkas->file));
      } else {
        dd('File does not exists.');
      }

      DB::commit();

      return redirect()->route('read_berkas', ['id_sub_jenis' => $request->id_sub_jenis]);
    } catch (\Exception $e) {
      DB::rollBack();
      return back()->with(['error' => $e->getMessage(), 'title' => 'Hapus Data Gagal']);
    }
  }

  public function editBerkasData(Request $request)
  {
    if (!Berkas::find($request->id_data)) {
      abort(404);
    }

    DB::beginTransaction();
    try {

      $validatedData = $request->validate([
        'kode_surat' => 'required|max:255',
        'jenis_surat' => 'required|max:255',
        'sub_jenis_surat' => 'required|max:255',
        'tgl_terima_surat' => 'required|max:255',
        'asal_surat' => 'max:255',
        'tgl_masuk_surat' => 'required|max:255',
        'nomor_surat' => 'required|max:255',
        'tujuan_surat' => 'max:255',
        'perihal_surat' => 'required|max:255',
        'file' => 'required'
      ]);

      $berkas = Berkas::find($request->id_data);

      $berkas->kode_surat = $validatedData['kode_surat'];
      $berkas->jenis_surat = $validatedData['jenis_surat'];
      $berkas->sub_jenis_surat = $validatedData['sub_jenis_surat'];
      $berkas->tgl_terima_surat = $validatedData['tgl_terima_surat'];
      $berkas->tgl_masuk_surat = $validatedData['tgl_masuk_surat'];
      $berkas->nomor_surat = $validatedData['nomor_surat'];
      $berkas->perihal_surat = $validatedData['perihal_surat'];
      $berkas->status = 0; //status dokumen belum fiksasi

      if (!$request->asal_surat) {
        $berkas->tujuan_surat = $validatedData['tujuan_surat'];
      } elseif (!$request->tujuan_surat) {
        $berkas->asal_surat = $validatedData['asal_surat'];
      }

      if ($request->file) {

        File::delete(public_path('data_file/berkas_upload/' . $berkas->file));

        $datenow = date('Y-m-d H.i.s');
        $file = $request->file('file');
        $berkas->file = $request->kode_surat . "_" . $datenow . "_" . $file->getClientOriginalName();

        $direktori_upload = 'data_file\berkas_upload';
        $file->move($direktori_upload, $request->kode_surat . "_" . $datenow . "_" . $file->getClientOriginalName());
      }


      if (!$berkas->save()) {
        throw new Exception("Gagal Menyimpan Data");
      }

      DB::commit();

      // return $this->view('read_berkas', ['id_data' => $request->sub_jenis_surat])->with('success', 'Data Berhasil Diubah!');
      return redirect()->route('read_berkas', ['id_sub_jenis' => $request->sub_jenis_surat])->with('success', 'Data Berhasil Diubah!');
    } catch (\Exception $e) {
      DB::rollBack();
      return back()->with(['error' => $e->getMessage(), 'title' => 'Edit Data Berkas Gagal']);
    }
  }

  public function approvedBerkas(Request $request)
  {
    if (!SubJenisBerkas::find($request->id_sub_jenis)) {
      abort(404);
    }

    try {
      $this->surat = Berkas::where([['sub_jenis_surat', '=', $request->id_sub_jenis], ['status', '=', 1]])->get();
      // $this->sub_jenis = Berkas::where('id', $request->id_sub_jenis)->first();
      $this->sub_jenis = SubJenisBerkas::where('id', $request->id_sub_jenis)->first();
      $this->jenis = DB::table('jenis_berkas')->where('id', $this->sub_jenis->jenis_surat)->first();

      $this->page = [
        'surat' => $this->surat,
        'title' => $this->jenis->nama,
        'sub_title' => $this->sub_jenis->nama,
        'id_jenis' => $request->id_sub_jenis,
        'id_sub_jenis' => $this->sub_jenis->jenis_surat
      ];

      $data = ['surat', 'sub_jenis', 'jenis', 'page'];

      return $this->view('berkas.berkas_disetujui', $data);
    } catch (\Throwable $th) {
      dd('error', $th);
    }
  }

  public function unApprovedBerkas(Request $request)
  {
    if (!SubJenisBerkas::find($request->id_sub_jenis)) {
      abort(404);
    }

    try {
      $this->surat = Berkas::where([['sub_jenis_surat', '=', $request->id_sub_jenis], ['status', '=', 2]])->get();
      // $this->sub_jenis = Berkas::where('id', $request->id_sub_jenis)->first();
      $this->sub_jenis = SubJenisBerkas::where('id', $request->id_sub_jenis)->first();
      $this->jenis = DB::table('jenis_berkas')->where('id', $this->sub_jenis->jenis_surat)->first();

      $this->page = [
        'surat' => $this->surat,
        'title' => $this->jenis->nama,
        'sub_title' => $this->sub_jenis->nama,
        'id_jenis' => $request->id_sub_jenis,
        'id_sub_jenis' => $this->sub_jenis->jenis_surat
      ];

      $data = ['surat', 'sub_jenis', 'jenis', 'page'];

      return $this->view('berkas.berkas_disetujui', $data);
    } catch (\Throwable $th) {
      dd('error', $th);
    }
  }

  public function validateBerkas(Request $request)
  {
    if (!Berkas::find($request->id_berkas)) {
      abort(404);
    }

    DB::beginTransaction();
    try {
      $this->berkas = Berkas::find($request->id_berkas);
      $this->jenis_surat = DB::table('jenis_berkas')->where('id', $this->berkas->jenis_surat)->first();
      $this->sub_jenis_surat = DB::table('sub_jenis_berkas')->where('id', $this->berkas->sub_jenis_surat)->first();

      $this->berkas->status = $request->status; //status dokumen belum fiksasi
      if (!$this->berkas->save()) {
        throw new Exception("Gagal Menyimpan Data");
      }

      $this->page = [
        'berkas' => [
          'id' => $this->berkas->id,
          'kode_surat' => $this->berkas->kode_surat,
          'jenis_surat' => $this->jenis_surat->nama,
          'sub_jenis_surat' => $this->sub_jenis_surat->nama,
          'tgl_terima_surat' => $this->berkas->tgl_terima_surat,
          'tgl_masuk_surat' => $this->berkas->tgl_masuk_surat,
          'nomor_surat' => $this->berkas->nomor_surat,
          'asal_surat' => $this->berkas->asal_surat,
          'tujuan_surat' => $this->berkas->tujuan_surat,
          'perihal_surat' => $this->berkas->perihal_surat,
          'file' => $this->berkas->file,
          'status' => $this->berkas->status,
        ],
        'title' => 'Detail Berkas'
      ];

      $data = ['berkas', 'page'];
      DB::commit();

      return $this->view('berkas.detail_berkas', $data);
    } catch (\Exception $e) {
      DB::rollBack();
      return back()->with(['error' => $e->getMessage(), 'title' => 'Validasi Berkas Gagal']);
    }
  }

  public function test()
  {
    // Source file and watermark config 
    $file = 'data_file/test.pdf';
    $text_image = 'data_file/ttd.png';

    // Set source PDF file 
    $pdf = new Fpdi();
    if (file_exists("./" . $file)) {
      $pagecount = $pdf->setSourceFile($file);
    } else {
      die('Source PDF not found!');
    }

    // Add watermark image to PDF pages 
    for ($i = 1; $i <= $pagecount; $i++) {
      $tpl = $pdf->importPage($i);
      $size = $pdf->getTemplateSize($tpl);
      $pdf->addPage();
      $pdf->useTemplate($tpl, 1, 1, $size['width'], $size['height'], TRUE);

      //Put the watermark 
      $xxx_final = ($size['width'] - 90);
      $yyy_final = ($size['height'] - 55);
      $pdf->Image($text_image, $xxx_final, $yyy_final, 0, 0, 'png');
    }

    // Output PDF with watermark 
    $pdf->Output();
  }
}
