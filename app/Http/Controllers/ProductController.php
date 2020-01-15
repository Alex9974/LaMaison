<?php

namespace App\Http\Controllers;

use App\Product;
use App\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    protected $paginate = 6;

    public function __construct() {
        
        // mise en place du middleware 'admin' qui ne donne accès au CRUD qu'aux membres administrateur
        $this->middleware('admin')->except('index', 'show', 'showMen', 'showWomen', 'showSolds');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // Page d'accueil du site : tapissage des produits
    public function index()
    {      
        $products = Product::where('status', 'publié')->orderBy('id', 'desc')->paginate($this->paginate);
        $user = Auth::user(); 
        $productsCount = Product::where('status', 'publié')->get();
        $productsCountBr = Product::where('status', 'brouillon')->get();
        $category = Categorie::all();
        return view('product.index', [
            'products' => $products, 
            'user' => $user, 
            'productsCount' => $productsCount,
            'productsCountBr' => $productsCountBr, 
            'category' => $category,
        ]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Pour la créaction d'un nouveau produit
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // Pour enregistrer le nouveau produit créé sur la page administrateur (la page d'accueil de l'espace membre de l'admin)
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */

    // pour afficher la fiche d'un produit en particulier
    public function show(Product $product)
    {
        $user = Auth::user(); 
        $categories = Categorie::all();
        return view('product.show', [
            'product' => $product, 
            'user' => $user,
            'categories' => $categories,
        ]);
    }

    // pour afficher la liste des produits des Hommes
    public function showMen()
    {        
        $user = Auth::user(); 
        $productsMen = Product::where('category_id', 1)->orderBy('id', 'desc')->paginate($this->paginate);
        $productsMenCount = Product::where('category_id', 1)->where('status', 'publié')->get();
        $productsMenCountBr = Product::where('category_id', 1)->where('status', 'brouillon')->get(); 
        return view('product.showmen', [
            'productsMen' => $productsMen, 
            'productsMenCount' => $productsMenCount,
            'productsMenCountBr' => $productsMenCountBr, 
            'user' => $user
        ]);
    }

    // pour afficher la liste des produits des Femmes
    public function showWomen()
    {
        $user = Auth::user(); 
        $productsWomen = Product::where('category_id', 2)->orderBy('id', 'desc')->paginate($this->paginate);
        $productsWomenCount = Product::where('category_id', 2)->where('status', 'publié')->get();
        $productsWomenCountBr = Product::where('category_id', 2)->where('status', 'brouillon')->get();
        return view('product.showwomen', [
            'productsWomen' => $productsWomen, 
            'productsWomenCount' => $productsWomenCount, 
            'productsWomenCountBr' => $productsWomenCountBr, 
            'user' => $user
        ]);
    }

    // pour afficher la liste des produits en soldes
    public function showSolds()
    {
        $user = Auth::user(); 
        $productsSolds = Product::where('code', 'solde')->orderBy('id', 'desc')->paginate($this->paginate);
        $productsSoldsCount = Product::where('code', 'solde')->where('status', 'publié')->get();
        $productsSoldsCountBr = Product::where('code', 'solde')->where('status', 'brouillon')->get();
        return view('product.showsolds', [
            'productsSolds' => $productsSolds, 
            'productsSoldsCount' => $productsSoldsCount,
            'productsSoldsCountBr' => $productsSoldsCountBr, 
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */

     // Pour avoir le formulaire d'édition au clique sur une des ressources l'espace admin
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */

     // Pour mettre à jour le produit via le formulaire d'édition
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */

    // Pour le lien suppression de l'article sour le formulaire d'édition
    public function destroy(Product $product)
    {
        //
    }
}
