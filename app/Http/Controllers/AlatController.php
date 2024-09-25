<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alat;
use App\Models\StatusAlat;
use App\Models\current;
use App\Models\eco;
use App\Models\power;
use App\Models\tagihan;
use App\Models\vol;
use Illuminate\Pagination\Paginatable;
use Illuminate\Support\Facades\DB;
use App\Models\ChartData;

class AlatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Alat::pluck('value', 'code')->toArray();
        $data1 = current::pluck('value', 'val_current')->toArray();
        $data2 = power::pluck('value', 'val_power')->toArray();
        $data3 = vol::pluck('value', 'val_vol')->toArray();
        return view('monitoring/mlantai', compact('data', 'data1', 'data2', 'data3'));

    }
    public function monitoringLantai(request $request)
    {
        $code = $request->get('code', 'default_code');

        $data = alat::pluck('code')->toArray();
        $dataLt = alat::pluck('lt')->toArray();
        $dataR = alat::pluck('ruangan')->toArray();
        $data1 = current::pluck('val_current')->toArray();
        $data2 = power::pluck('val_power')->toArray();
        $data3 = vol::pluck('val_vol')->toArray();
        $labels = current::pluck('tgl');

        $mergedData = [
            'data' => $data,
            'data1' => $data1,
            'data2' => $data2,
            'data3' => $data3,
            'dataLt' => $dataLt,
            'dataR' => $dataR,
            'label' => $labels
        ];
        //     $labels = $data->pluck('label')->toArray();
        // $dataset1 = $data->pluck('dataset1')->toArray();

        $list_alat = Alat::all()
            ->sortBy('code');

        $alatOpsi = Alat::all()->pluck('lt')->unique()->sortBy('code');


        $lantai = DB::table('alat')
            ->join('current', 'alat.code', '=', 'current.code')
            ->join('power', 'current.code', '=', 'power.code')
            ->join('vol', 'power.code', '=', 'vol.code')
            ->select(
                'alat.code',
                'current.val_current as current_value',
                'power.val_power as power_value',
                'vol.val_vol as vol_value'
            )
            ->where('alat.code', $code)
            ->first();

            $search = $request->get('search');
            $alat = [];
            $alat = Alat::where('lt', 'like', '%' . $search . '%')
            ->paginate(10);

        return view('monitoring/mlantai', compact('data', 'data1', 'data2', 'data3', 'dataLt', 'dataR', 'mergedData', 'code', 'lantai', 'labels', 'list_alat', 'alat', 'search', 'alatOpsi'));

    }
    public function monitoringPeralat(request $request)
    {
        $code = $request->get('code', 'default_code');

        $data = alat::pluck('code')->toArray();
        $dataLt = alat::pluck('lt')->toArray();
        $dataR = alat::pluck('ruangan')->toArray();
        $data1 = current::pluck('val_current')->toArray();
        $data2 = power::pluck('val_power')->toArray();
        $data3 = vol::pluck('val_vol')->toArray();
        $labels = current::pluck('tgl');

        $mergedData = [
            'data' => $data,
            'data1' => $data1,
            'data2' => $data2,
            'data3' => $data3,
            'dataLt' => $dataLt,
            'dataR' => $dataR,
            'label' => $labels
        ];
        //     $labels = $data->pluck('label')->toArray();
        // $dataset1 = $data->pluck('dataset1')->toArray();

        $list_alat = Alat::all()
            ->sortBy('code');

        $alatOpsi = Alat::all()->pluck('code');


        $lantai = DB::table('alat')
            ->join('current', 'alat.code', '=', 'current.code')
            ->join('power', 'current.code', '=', 'power.code')
            ->join('vol', 'power.code', '=', 'vol.code')
            ->select(
                'alat.code',
                'current.val_current as current_value',
                'power.val_power as power_value',
                'vol.val_vol as vol_value'
            )
            ->where('alat.code', $code)
            ->first();

            $search = $request->get('search');
            $alat = [];
            $alat = Alat::where('code', 'like', '%' . $search . '%')
            ->paginate(10);

        return view('monitoring/malat', compact('data', 'data1', 'data2', 'data3', 'dataLt', 'dataR', 'mergedData', 'code', 'lantai', 'labels', 'list_alat', 'alat', 'search', 'alatOpsi'));

    }
    public function fetchData(Request $request)
    {
        // Ambil data sesuai pilihan lantai yang dipilih
        $alatOpsi = $request->input('lt'); // Ambil nilai lt dari permintaan

        // Misalnya, kita ambil data dari model Alat dengan lantai yang sesuai
        $data = Alat::where('lt', $alatOpsi)->get();

        // Menyiapkan struktur data yang sesuai dengan apa yang diharapkan oleh grafik
        $labels = $data->pluck('tgl')->toArray();
        $dataset1 = $data->pluck('code')->toArray();
        $dataset2 = $data->pluck('lt')->toArray();
        $dataset3 = $data->pluck('ruangan')->toArray();

        // Menyusun data dalam bentuk array
        $responseData = [
            'labels' => $labels,
            'data1' => $dataset1,
            'data2' => $dataset2,
            'data3' => $dataset3,
        ];

        // Kirim data sebagai respons JSON
        return response()->json($responseData);
    }
    public function cariData(Request $request, $floor)
    {
        // Ambil semua data untuk lantai yang dipilih
        $alat = Alat::where('lt', $floor)->get();
    
        // Inisialisasi array untuk menyimpan data chart
        $chartsData = [];
    
        // Loop melalui setiap alat (device) untuk lantai yang dipilih
        foreach ($alat as $data) {
            $code = $data->code;
    
            // Ambil data dari tabel current, power, dan vol sesuai dengan code
            $labels = current::where('code', $code)->pluck('tgl')->toArray();
            $data1 = current::where('code', $code)->pluck('val_current')->toArray();
            $data2 = power::where('code', $code)->pluck('val_power')->toArray();
            $data3 = vol::where('code', $code)->pluck('val_vol')->toArray();
    
            // Tambahkan data chart untuk code ini ke dalam array chartsData
            $chartData = [
                'code' => $code,
                'labels' => $labels,
                'data1' => $data1,
                'data2' => $data2,
                'data3' => $data3,
            ];
    
            $chartsData[] = $chartData;
        }
    
        // Kirim data chart sebagai respons JSON
        return response()->json($chartsData);
    }
    public function Alat(Request $request, $alat)
    {// Ambil semua data untuk lantai yang dipilih
        $alat = Alat::where('code', $alat)->get();
    
        // Inisialisasi array untuk menyimpan data chart
        $chartsData = [];
    
        // Loop melalui setiap alat (device) untuk lantai yang dipilih
        foreach ($alat as $data) {
            $code = $data->code;
    
            // Ambil data dari tabel current, power, dan vol sesuai dengan code
            $labels = current::where('code', $code)->pluck('tgl')->toArray();
            $data1 = current::where('code', $code)->pluck('val_current')->toArray();
            $data2 = power::where('code', $code)->pluck('val_power')->toArray();
            $data3 = vol::where('code', $code)->pluck('val_vol')->toArray();
    
            // Tambahkan data chart untuk code ini ke dalam array chartsData
            $chartData = [
                'code' => $code,
                'labels' => $labels,
                'data1' => $data1,
                'data2' => $data2,
                'data3' => $data3,
            ];
    
            $chartsData[] = $chartData;
        }
    
        // Kirim data chart sebagai respons JSON
        return response()->json($chartsData);
    }
    public function monitoringAlat()
    {
        $data = Alat::all();
        $status = StatusAlat::all();
        return view('monitoring/perangkat', compact('data','status'));
    }
    public function monitoringCurrent()
    {
        $data = current::all();
        return view('monitoring/current', compact('data'));
    }
    public function monitoringPower()
    {
        $data = power::all();
        return view('monitoring/power', compact('data'));
    }
    public function monitoringVolt()
    {
        $data = vol::all();
        return view('monitoring/voltage', compact('data'));
    }

    public function pVolt()
    {
        $data = vol::latest()->paginate(10);
        return view('monitoring.voltage', compact('data'));
    }

    public function cari(Request $request)
{
    $search = $request->get('search');
    $startDate = $request->get('startDate');
    $endDate = $request->get('endDate');

    $alat = Alat::where('code', 'like', '%' . $search . '%');

    // Filter berdasarkan rentang tanggal jika tanggal mulai dan tanggal selesai disediakan
    if ($startDate && $endDate) {
        $alat->whereBetween('created_at', [$startDate, $endDate]);
    }

    $alat = $alat->paginate(10);

    return view('monitoring.cari', compact('alat', 'search'));
}


    public function getData(Request $request)
{
    // Ambil nilai alat dari request
    $alat = $request->input('alat');

    // Periksa apakah nilai alat tidak kosong
    if ($alat) {
        // Query database untuk mendapatkan data alat berdasarkan pilihan yang dibuat
        $data = Alat::where('code', $alat)->get();
        
        foreach ($data as $item) {
            if ($item->id_status == 1) {
                $item->status_alat = 'offline';
            } elseif ($item->id_status == 2) {
                $item->status_alat = 'online';
            }
        }
        // Kembalikan data dalam bentuk JSON
        return response()->json($data);
    } else {
        // Jika nilai alat kosong, kembalikan respons kosong
        return response()->json([]);
    }
}
public function getLantai(Request $request)
{
    // Ambil nilai alat dari request
    $floor = $request->input('floor');

    // Periksa apakah nilai floor tidak kosong
    if ($floor) {
        // Query database untuk mendapatkan data floor berdasarkan pilihan yang dibuat
        $data = Alat::where('lt', $floor)->get();
        
        // Ubah nilai id_status menjadi 'offline' atau 'online'
        foreach ($data as $item) {
            if ($item->id_status == 1) {
                $item->status_alat = 'offline';
            } elseif ($item->id_status == 2) {
                $item->status_alat = 'online';
            }
        }

        // Kembalikan data dalam bentuk JSON
        return response()->json($data);
    } else {
        // Jika nilai alat kosong, kembalikan respons kosong
        return response()->json([]);
    }
}

public function edit(Request $request, $id_alat)
{
    // Temukan alat berdasarkan id_alat
    $alat = Alat::find($id_alat);

    if (!$alat) {
        return redirect()->back()->with('error', 'Alat not found');
    }

    // Tentukan id_status baru berdasarkan kondisi status saat ini
    $currentStatus = StatusAlat::find($alat->id_status);
    $newStatusId = null;

    if ($currentStatus->status_alat == 'offline') {
        $newStatus = StatusAlat::where('status_alat', 'online')->first();
        $newStatusId = $newStatus->id_status;
    } elseif ($currentStatus->status_alat == 'online') {
        $newStatus = StatusAlat::where('status_alat', 'offline')->first();
        $newStatusId = $newStatus->id_status;
    }

    if ($newStatusId) {
        // Update id_status alat dengan id_status baru
        $alat->id_status = $newStatusId;
        $alat->save();

        return redirect()->back()->with('success', 'Status updated successfully');
    }

    return redirect()->back()->with('error', 'Unable to update status');
}
    public function hapus($id_alat)
    {

        $alat = Alat::where('id_alat', $id_alat)->first();

        if ($alat) {
            Alat::where('id_alat', $id_alat)->delete();
        }
        return back()->with('destroy', 'Data Successfully');
    }
    public function update(Request $request, $id_alat)
{
    $request->validate([
        'code' => 'required',
        'lantai' => 'required',
        'ruangan' => 'required|string',
        'id_status' => 'required|exists:status_alat,id_status', // Menambahkan validasi untuk id_status
    ]);

    $item = $request->all();

    Alat::where(['id_alat' => $id_alat])->update([
        'code' => $item['code'],
        'lt' => $item['lantai'],
        'ruangan' => $item['ruangan'],
        'id_status' => $item['id_status'], // Menambahkan pembaruan id_status
    ]);

    return redirect()->back()->with('success', 'Data updated successfully');
}

    /**
     * Show the form for creating a new resource.
     */
    public function store()
    {
        $alat = alat::all();
        return view('monitoring.tambah', compact('alat'));
    }
    public function tambah(Request $request)
    { {
            $request->validate([
                'code' => 'required|max:255',
                'lantai' => 'required',
                'ruangan' => 'required|string',

            ]);

            $alat = Alat::create([
                'code' => $request->code,
                'lt' => $request->lantai,
                'ruangan' => $request->ruangan,
                'status' => 'online',

            ]);

            return redirect()->back()->with('success', 'Data Successfully');
        }
    }

    /**
     * Store a newly created resource in storage.
     */


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


    /**
     * Update the specified resource in storage.
     */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
