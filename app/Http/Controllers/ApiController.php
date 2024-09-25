<?php

namespace App\Http\Controllers;

use App\Models\current;
use Illuminate\Http\Request;
use League\CommonMark\Extension\CommonMark\Node\Inline\Code;
use App\Models\eco;
use App\Models\power;
use App\Models\tagihan;
use App\Models\vol;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function storePower(Request $request)
    {
        $power = power::create([
            'code' => $request->code,
            'val_power' => $request->power,
            'tgl'=>  date("Y-m-d") ,
        ]);
        return response()->json([
            'message' => 'success',
            'data' => $power,
        ]);
        // $code = new power;
        // $code->code = $request->code;
        // $code->save();
        // return response()->json([
        //     "message" => "success",
        //     "data"=> $code,
        // ]);

    }
    public function storeVal(Request $request)
    {
        $val = current::create([
            'code' => $request->code,
            'val_current' => $request->current,
            'tgl'=>  date("Y-m-d") ,
        ]);
        return response()->json([
            'message' => 'success',
            'data' => $val,
        ]);

    }
    public function storeVolt(Request $request)
    {
        $volt = vol::create([
            'code' => $request->code,
            'val_vol' => $request->voltage,
            'tgl'=>  date("Y-m-d") ,
        ]);
        return response()->json([
            'message' => 'success',
            'data' => $volt,
        ]);
        // Simpan data val_vol

        // Simpan data code
        // $code = new vol;
        // $code->code = $request->code;
        // $code->save();

        // $vol = new vol;
        // $vol->val_vol = $request->val_vol;
        // $vol->save();
        // return response()->json([
        //     'message' => 'success',
        //     'data' => [
        //         'code' => $code,
        //         'val_vol' => $vol,

        //     ],
        // ]);

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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
