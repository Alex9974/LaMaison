<?php

namespace App\Http\Controllers;

use App\Product;
use App\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    protected $paginate = 10;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {        
        $user = Auth::user(); 
        $products = Product::orderBy('id', 'desc')->paginate($this->paginate);
        $productsTotal = Product::all();
        $productsCount = Product::where('status', 'publié')->get();
        $productsCountBr = Product::where('status', 'brouillon')->get();
        $categories = Categorie::all(); 
        return view('admin/home', [            
            'user' => $user, 
            'products' => $products,
            'productsCount' => $productsCount,
            'productsCountBr' => $productsCountBr, 
            'productsTotal' => $productsTotal,
            'categories' => $categories,            
        ]); 

        
        
    }
}
