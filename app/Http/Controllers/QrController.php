<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Table;   

class QrController extends Controller
{
    public function show($table)
    {
    $url = url("/table/$table");

    return view('qr.show', [
            'table' => $table,
            'url' => $url
        ]);
    }

    public function generatePdf()
    {
        $tables = Table::orderBy('id')->get();

        foreach ($tables as $table) {
            
         $result = Builder::create()
         ->writer(new PngWriter())
         ->data(url('/table/' . $table->id))
         ->size(300)
         ->margin(10)
         ->build();

         $table->qr_base64 = base64_encode($result->getString());
        }

        $pdf = Pdf::loadView('admin.qr-pdf', [
            'tables' => $tables
        ])->setPaper('a4', 'portrait');

        return $pdf->stream('QR-Meja-Restoran.pdf');
    }
}
