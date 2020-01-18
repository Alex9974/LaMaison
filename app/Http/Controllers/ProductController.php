<?php

namespace App\Http\Controllers;

use App\Product;
use App\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage; 

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
        $categories = Categorie::all();
        $tailles = ['46', '46 48', '46 48 50', '46 48 50 52', '48', '48 50', '48 50 52', '50', '50 52', '52']; 
        $user = Auth::user();
         return view('product.create', [
            'user' => $user,
            'categories' => $categories, 
            'tailles' => $tailles,
         ]);
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
        $validator = Validator::make($request->all(), [
            'titre' => 'bail|required|string|min:8',
            'description' => 'bail|required|string|min:15',
            'price' => 'bail|required|numeric',
            'categorie' => 'bail|required',
            'taille' => 'bail|required',
            'picture' => 'bail|required|image|mimes:jpeg, png',
            'status' => 'bail|required',
            'code' => 'bail|required',
            'reference' => 'bail|required|numeric',
        ]);
        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $link = Str::random(12) . '.jpg'; // hash de lien pour la sécurité (injection de scripts protection)
        $file = file_get_contents($request->picture); // flux
        Storage::disk('local')->put($link, $file);

        $product = new Product;
        $product->title_product = $request->titre;
        $product->description = $request->description;
        $product->price = $request->price; 
        $product->category_id = $request->categorie;
        $product->size = $request->taille;
        $product->url_image = $link;
        $product->status = $request->status;
        $product->code = $request->code;
        $product->reference = $request->reference;
        $product->save();

        return redirect()->route('compte')->withStatus('Le produit a bien été ajouté !');        
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
        $productsMen = Product::where('category_id', 1)->where('status', 'publié')->orderBy('id', 'desc')->paginate($this->paginate);
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
        $productsWomen = Product::where('category_id', 2)->where('status', 'publié')->orderBy('id', 'desc')->paginate($this->paginate);
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
        $productsSolds = Product::where('code', 'solde')->where('status', 'publié')->orderBy('id', 'desc')->paginate($this->paginate);
        $productsSoldsCount = Product::where('code', 'solde')->where('status', 'publié')->get();
        $productsSoldsCountBr = Product::where('code', 'solde')->where('status', 'brouillon')->get();
        return view('product.showsolds', [
            'productsSolds' => $productsSolds, 
            'productsSoldsCount' => $productsSoldsCount,
            'productsSoldsCountBr' => $productsSoldsCountBr, 
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */

     // Pour avoir le formulaire d'édition au clique sur une des ressources l'espace admin
     public function edit($id)
     {
        $tailles = ['46', '46 48', '46 48 50', '46 48 50 52', '48', '48 50', '48 50 52', '50', '50 52', '52']; 
        $product = Product::find($id);
        $products = Product::all();
        $user = Auth::user();
        $categories = Categorie::all();
         return view('product.edit', [
            'product' => $product,
            'products' => $products,
            'user' => $user,
            'categories' => $categories,
            'tailles' => $tailles,
         ]);
     }


     public function editDestroy($id)
     { 
        $product = Product::find($id);
        $user = Auth::user();
        $categories = Categorie::all();
         return view('product.editdestroy', [
            'product' => $product,
            'user' => $user,
            'categories' => $categories,
         ]);
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */

     // Pour mettre à jour le produit via le formulaire d'édition
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        $validator = Validator::make($request->all(), [
            'titre' => 'bail|required|string|min:8',
            'description' => 'bail|required|string|min:15',
            'price' => 'bail|required|numeric',
            'reference' => 'bail|required|numeric',
            'picture' => 'bail|required|image|mimes:jpeg, png',

        ]);
        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $link = Str::random(12) . '.jpg'; // hash de lien pour la sécurité (injection de scripts protection)
        $file = file_get_contents($request->picture); // flux
        Storage::disk('local')->put($link, $file);

        $product->title_product = $request->titre;
        $product->description = $request->description;
        $product->price = $request->price; 
        $product->category_id = $request->categorie;
        $product->size = $request->taille;
        $product->url_image = $link;
        $product->status = $request->status;
        $product->code = $request->code;
        $product->reference = $request->reference;

        $product->save();
        return back()->withStatus('Le produit a bien été modifié !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */

    // Pour le lien suppression de l'article sour le formulaire d'édition
    public function destroy($id)
    {
        $product = Product::find($id);
        Storage::delete($product->url_image);
        $product->delete();
        return redirect()->route('compte')->withStatus('Le produit a bien été supprimé !');
    }
}
