<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Apicontroller extends Controller
{
    public function login(Request $request)
    {
        try {
            $response = Http::post('http://devpresensi.bukittinggikota.go.id/api/login', [
                'userinfo_id' => $request->userinfo_id,
                'password' => $request->password
            ]);

            $data = $response->json();
            return response()->json($data);
        } catch (Exception $error) {
            return response()->json($error->getMessage(), 500);
        }
    }

    public function absen(Request $request)
    {
        try {
            $token = $request->header('authorization');
            $response = Http::withHeaders([
                'Authorization' => $token
            ])->get('http://devpresensi.bukittinggikota.go.id/api/checkin-today');
            $data = $response->json();

            return response()->json($data);
        } catch (Exception $error) {
            return response()->json($error->getMessage(), 500);
        }
    }

    public function absenMasuk(Request $request)
    {
        try {
            $token = $request->header('authorization');
            $response = Http::withHeaders([
                'Authorization' => $token
            ])->post('http://devpresensi.bukittinggikota.go.id/api/checkin', [
                'lat' => $request->lat,
                'lng' => $request->lng,
                'type' => $request->type,
                'user_id' => $request->user_id,
                'photo' => $request->photo
            ]);
            $data = $response->json();

            return response()->json($data);
        } catch (Exception $error) {
            return response()->json($error->getMessage(), 500);
        }
    }

    public function absenPulang(Request $request)
    {
        try {
            $token = $request->header('authorization');
            $response = Http::withHeaders([
                'Authorization' => $token
            ])->post('http://devpresensi.bukittinggikota.go.id/api/checkin', [
                'lat' => $request->lat,
                'lng' => $request->lng,
                'type' => $request->type,
                'user_id' => $request->user_id,
                'photo' => $request->photo
            ]);
            $data = $response->json();

            return response()->json($data);
        } catch (Exception $error) {
            return response()->json($error->getMessage(), 500);
        }
    }
}
