<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $transactions = Transaction::all();
        $categories = Category::all();
        // $kategoriPemasukan = Category::where('type', 'pemasukan')->get('id');
        // $kategoriPengeluaran = Category::where('type', 'pengeluaran')->get('id');
        // $pemasukan = Transaction::where('category_id', )->get();
        // dd($kategoriPemasukan);
        return view('home', compact('transactions', 'categories'));
    }

    public function admin()
    {
        return view('admin.home');
    }
}
