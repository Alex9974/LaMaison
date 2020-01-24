<?php

namespace App\Http\Controllers;

use App\Product;
use App\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //pour afficher seulement 10 produits par page d'accueil du back office
    protected $paginate = 10;
    
    public function __construct()
    {
        // application du middleware admin pour ne donner accès au back office qu'aux membres administrateur (role = 1)
        $this->middleware('admin');
    }

    // pour afficher tous les produits sur la page d'accueil du back office
    public function index()
    {
        // liaision des tables products et categories par la clé secondaire  category_id (affiche du nom de la catégorie)
        $products = DB::table('products')
                        ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
                        ->select('products.*', 'categories.title_category')
                        ->orderBy('products.id', 'desc')
                        ->paginate($this->paginate);
        $user = Auth::user(); 
        // pour affiche du nombre total de produits
        $productsTotal = Product::all();
        // pour affiche du nombre de produits en ligne
        $productsCount = Product::where('status', 'publié')->get();
        // pour affiche du nombre de produits en brouillon
        $productsCountBr = Product::where('status', 'brouillon')->get();
        
        return view('admin/home', [            
            'user' => $user, 
            'products' => $products,
            'productsCount' => $productsCount,
            'productsCountBr' => $productsCountBr, 
            'productsTotal' => $productsTotal,
        ]); 

        
        
    }
}
