<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Customer;
use App\Models\Sales;
use PDF;
class PdfController extends Controller
{

    public function genratepdf(){
            $data['title'] = 'Daftar Transaksi';
            $data['data'] = auth()->user()->sales;
        $pdf = PDF::loadView('pdf',$data);
        return $pdf->download(date('ymdhis').' Rekap Data.pdf');
    }

}
