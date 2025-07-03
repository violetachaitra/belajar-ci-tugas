<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\TransactionModel;
use App\Models\UserModel;
use Dompdf\Dompdf;

class Dashboard extends BaseController
{
    protected $product;
    protected $transaction;
    protected $user;

    public function __construct()
    {
        $this->product = new ProductModel();
        $this->transaction = new TransactionModel();
        $this->user = new UserModel();
    }

    protected function getApiData()
    {
        // Cek koneksi API, jika gagal return null agar tidak muter2
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://localhost:8080/api",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 3, // timeout 3 detik
            CURLOPT_CONNECTTIMEOUT => 2, // timeout koneksi 2 detik
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: random123678abcghi",
            ),
        ));
        $output = curl_exec($curl);
        if (curl_errno($curl) || !$output) {
            curl_close($curl);
            return null; // jika error atau tidak ada output, return null
        }
        curl_close($curl);
        $data = json_decode($output);
        return $data;
    }

    public function index()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('/');
        }
        $transactions = $this->transaction->orderBy('created_at', 'DESC')->findAll();
        $totalUser = $this->user->countAllResults();
        $totalTransaksi = $this->transaction->countAllResults();
        $totalPendapatan = $this->transaction->selectSum('total_harga')->first()['total_harga'] ?? 0;
        $apiData = $this->getApiData();
        return view('dashboard/index', [
            'transactions' => $transactions,
            'apiData' => $apiData,
            'totalUser' => $totalUser,
            'totalTransaksi' => $totalTransaksi,
            'totalPendapatan' => $totalPendapatan
        ]);
    }

    // public function cetak()
    // {
    //     if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
    //         return redirect()->to('login');
    //     }

    //     $transaksiModel = new TransactionModel();
    //     $data['transactions'] = $transaksiModel->findAll();
    //     return view('dashboard/cetak', $data);
    // }

    public function exportpdf()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('login');
        }

        $data['transactions'] = $this->transaction->findAll();
        $html = view('dashboard/cetak', $data);

        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('laporan_dashboard.pdf', ['Attachment' => false]);
    }
}