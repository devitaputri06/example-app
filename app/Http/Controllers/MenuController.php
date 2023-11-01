<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
 // Menggunakan Illuminate\Routing\Controller

class MenuController extends Controller
{
    public function getMenu()
    {
        $verifyPath = public_path('storage/cacert.pem');
        $response = Http::withOptions([
            'verify' => $verifyPath, // Menggunakan path lengkap ke cacert.pem
        ])->get('https://tes-web.landa.id/intermediate/menu');
    
        if ($response->successful()) {
            return $response->json();
        } else {
            // Tampilkan pesan kesalahan atau log pesan kesalahan
            Log::error('Error in getMenu request: ' . $response->body());
            return []; // atau respons kesalahan lainnya
        }
    }

public function getTransaction($year)
{
  
        $verifyPath = public_path('storage/cacert.pem');
        $response = Http::withOptions([
            'verify' => $verifyPath, // Menggunakan path lengkap ke cacert.pem
        ])->get('https://tes-web.landa.id/intermediate/transaksi?tahun=' . $year);
    
        if ($response->successful()) {
            return $response->json();
        } else {
            // Tampilkan pesan kesalahan atau log pesan kesalahan
            Log::error('Error in getMenu request: ' . $response->body());
            return []; // atau respons kesalahan lainnya
        }
    }


    public function index()
    {
        return view('menu')->with([
            'tahun' => null,
            'transaction' => null,
        ]);
    }

    public function getData($year)
    {
        $menu = $this->getMenu();
        $transaction = $this->getTransaction($year);

        return view('menu')->with([
            'tahun' => $year,
            'menu' => $menu,
            'transaction' => $transaction,
        ]);
    }
}

    
   
