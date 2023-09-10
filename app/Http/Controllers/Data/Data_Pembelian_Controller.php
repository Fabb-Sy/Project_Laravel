<?php

namespace App\Http\Controllers;

use App\Models\Data_Pembelian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Data_Pembelian_Controller extends Controller
{
    public function createData_Pembelian () {
        return view('web.create.pembelian');
    }
    public function updateData_Pembelian ($id) {
        $data = Data_Pembelian::readData_PembelianById($id);
        return view('web.update.pembelian', ['pembelian' => $data]);
    }
    public function create(Request $request)
    {
        $data = [
            'pembelian_user_id' => $request->input('user'),
            'pembelian_metode_pembayaran_id' => $request->input('metode_pembayaran'),
            'pembelian_tanggal' => $request->input('tanggal'),
            'pembelian_total_harga' => $request->input('total_harga'),
            'pembelian_status' => $request->input('status'),
        ];
        Data_Pembelian::create($data);
        Log::info('🟢 Data_Pembelian ' . $request->input('nama') . ' berhasil ditambahkan');
        return redirect()->route('pembelian')->with('success', 'Data pembelian berhasil ditambahkan!');
    }
    public function update (Request $request, $id)
    {
        $ids = Data_Pembelian::find($id);
        if (!$ids) {
            return redirect()->route('pembelian')->with('error', 'Data pembelian tidak ditemukan.');
        }
        $data = [
            'pembelian_id' => $id,
            'pembelian_user_id' => $request->input('user'),
            'pembelian_metode_pembayaran_id' => $request->input('metode_pembayaran'),
            'pembelian_tanggal' => $request->input('tanggal'),
            'pembelian_total_harga' => $request->input('total_harga'),
            'pembelian_status' => $request->input('status'),
        ];
        $ids->update($data);
        Log::notice('🟡 Data_Pembelian ' . $request->input('nama') . ' berhasil diubah');
        return redirect()->route('pembelian')->with('success', 'Data pembelian berhasil diperbarui!');
    }
    public function delete($id)
    {
        $pembelian = Data_Pembelian::find($id);
        if ($pembelian) {
            Log::alert('🔴 Data_Pembelian dengan ID : ' . $id . ' berhasil dihapus');
            $pembelian->delete();
            return redirect()->route('pembelian')->with('deleted', 'Data pembelian berhasil dihapus!');
        } else {
            Log::error('🔴 Data_Pembelian dengan ID : ' . $id . ' gagal dihapus');
            return redirect()->route('pembelian')->with('error', 'Data pembelian tidak ditemukan.');
        }
    }
}