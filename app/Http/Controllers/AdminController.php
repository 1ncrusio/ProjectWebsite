<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Auth ;
use App\Models\User;
use App\Models\Alat;
use App\Models\StatusAlat;
use App\Models\eco;
use App\Models\current;
use App\Models\power;
use App\Models\vol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexAdmin(request $request)
    {
        $user = User::count();
        $alat = alat::count();
        $nyala = alat::where('id_status','2')->count();
        $off = alat::where('id_status','1')->count();

        
           // Contoh pengambilan data dari tabel current, power, dan vol
$currentData = Current::select('val_current', 'tgl')->latest('tgl')->get();
$powerData = Power::select('val_power', 'tgl')->latest('tgl')->get();
$volData = Vol::select('val_vol', 'tgl')->latest('tgl')->get();

// Ubah data menjadi format yang sesuai untuk digunakan dalam Chart.js
$labels = []; // Wadah untuk tanggal
$dataCurrent = []; // Wadah untuk nilai arus
$dataPower = []; // Wadah untuk nilai daya
$dataVoltage = []; // Wadah untuk nilai voltase

foreach ($currentData as $current) {
    $labels[] = $current->tgl;
    $dataCurrent[] = $current->val_current;
}

foreach ($powerData as $power) {
    $dataPower[] = $power->val_power;
}

foreach ($volData as $vol) {
    $dataVoltage[] = $vol->val_vol;
}

// Kemudian, kirim data ini ke tampilan (View) Anda untuk digunakan dalam script Chart.js


       return view('admin.indexC', compact('dataCurrent','dataPower', 'labels','dataVoltage','user','alat','nyala','off'));
    }
    // Misalnya dalam controller atau route handler Anda

public function getLatestData() {
    $currentData = Current::select('val_current', 'tgl')->latest('tgl')->get();
    $powerData = Power::select('val_power', 'tgl')->latest('tgl')->get();
    $volData = Vol::select('val_vol', 'tgl')->latest('tgl')->get();

    $response = [
        'currentData' => $currentData,
        'powerData' => $powerData,
        'volData' => $volData,
    ];

    return response()->json($response);
}

    public function tabelIndex(request $request)
    {
        $code = $request->get('code', 'default_code');

        // Ambil data dari masing-masing model
        $data = Alat::pluck('code')->toArray();
        $dataLt = Alat::pluck('lt')->toArray();
        $dataR = Alat::pluck('ruangan')->toArray();
        $data1 = Current::pluck('val_current')->toArray();
        $data2 = Power::pluck('val_power')->toArray();
        $data3 = Vol::pluck('val_vol')->toArray();
        $labels = Current::pluck('tgl')->toArray();
        
        // Gabungkan data ke dalam satu array
        $mergedData = [
            'dataset' => [
                'data1' => [
                    'label' => $labels,
                    'data' => $data,
                    'data1' => $data1,
                    'data2' => $data2,
                    'data3' => $data3,
                    'warningLimit' => 200,
                ]
            ]
        ];
    
        // Periksa apakah permintaan adalah permintaan AJAX
        if ($request->ajax()) {
            // Jika ya, kembalikan data dalam bentuk JSON
            return response()->json($mergedData);
        } else {
            // Jika tidak, render tampilan dengan menggunakan data yang telah diambil
            return view('admin.index', compact('mergedData'));
        }
    }
    
    public function login()
    {
        return view('auth/login');
    }
    public function landing()
    {
        return view('landing');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $item = auth()->user();
       return view('user.profile', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }
    public function list()
    {
        $user = user::all();
        return view('user.data-user', compact('user'));
    }

    public function admin(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', 'in:user,admin'], // Validasi untuk kolom 'level'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request['password']),
            'role' => $request->level, // Gunakan nilai dari input 'level'
        ]);

        return redirect()->back()->with('success', 'Data Successfully');
    }
    /**
     * Update the specified resource in storage.
     */
    public function updateData(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'password' => 'nullable|string|min:8|confirmed', // Konfirmasi password harus cocok
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Jika ada, gambar harus sesuai
        // 'role' => 'required', 'string', 'in:user,admin', // Konfirmasi password harus cocok
    ]);

    // Mengambil semua data dari request
    $item = $request->all();

    // Menggunakan Eloquent untuk mencari pengguna berdasarkan ID
    $user = User::findOrFail($id);

    // Mengupdate nama dan email
    $user->name = $item['name'];
    $user->email = $item['email'];
    // $user->role = $item['role'];

    // Memperbarui password jika ada input password baru
    if ($request->filled('password')) {
        $user->password = bcrypt($item['password']);
    }

    // Memperbarui gambar jika ada file gambar yang diunggah
    if ($request->hasFile('gambar')) {
        $user->gambar = $request->file('gambar')->store('post-gambar');
        
        // Menghapus gambar lama jika ada
        if ($request->oldImage) {
            Storage::delete($request->oldImage);
        }
    }

    // Menyimpan perubahan pada pengguna
    $user->save();

    // Redirect kembali ke halaman sebelumnya dengan pesan sukses
    return redirect()->back()->with('success', 'Data Successfully');
}

public function updateAdmin(Request $request, $id)
    {
        $request->validate([
            
            'role' => 'required', 'string', 'in:user,admin', // Konfirmasi password harus cocok

        ]);
        $item = $request->all();
        $user = User::findOrFail($id);

    // Mengupdate nama dan email
    $user->name = $item['name'];
    $user->email = $item['email'];
    $user->role = $item['role'];

    // Memperbarui password jika ada input password baru
    if ($request->filled('password')) {
        $user->password = bcrypt($item['password']);
    }

    // Memperbarui gambar jika ada file gambar yang diunggah
    if ($request->hasFile('gambar')) {
        $user->gambar = $request->file('gambar')->store('post-gambar');
        
        // Menghapus gambar lama jika ada
        if ($request->oldImage) {
            Storage::delete($request->oldImage);
        }
    }

    // Menyimpan perubahan pada pengguna
    $user->save();

    // Redirect kembali ke halaman sebelumnya dengan pesan sukses

        return redirect()->back()->with('success', 'Data Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_user)
    {
        
        $user = user::where('id', $id_user)->first();
        
        if ($user && $user->gambar) {
            Storage::delete($user->gambar);
        }
        if ($user) {
            user::where('id', $id_user)->delete();
        }
        return back()->with('destroy', 'Data Successfully');
    }
}
