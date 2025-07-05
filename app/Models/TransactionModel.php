<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table = 'transaction';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'username', 'total_harga', 'alamat', 'ongkir', 'status', 'created_at', 'updated_at'
    ];
    
    public function updateStatus($id, $status)
    {
        return $this->update($id, ['status' => $status]);
    }

    // public function updateStatus($id) 
    // { 
    //     $status = $this->request->getPost('status'); 
         
    //     if ($this->transaction->updateStatus($id, $status)) { 
    //         return redirect()->back()->with('success', 'Status transaksi berhasil diperbarui.'); 
    //     } else { 
    //         return redirect()->back()->with('error', 'Gagal memperbarui status transaksi.'); 
    //     } 
    // } 
}