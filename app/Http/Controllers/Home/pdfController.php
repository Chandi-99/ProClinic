<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF;
use App\Http\Controllers\Controller;

class pdfController extends Controller
{
    public function index()
    {
        //$products = Product::all();

        //$pdf = new PDF();
        //$pdf->loadView('products', compact('products'));
        //$pdf->save('products.pdf');

        return response()->download('products.pdf');
    }
}
