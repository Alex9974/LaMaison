<?php

namespace App\Http\Controllers;

use App\Product;
use App\Categorie;
use App\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage; 

class ProductController extends Controller
{
    // pour afficher seulement 6 produits par pages
    protected $paginate = 6;

    public function __construct() {
        
        // application du middleware admin pour ne donner accès au CRAUD qu'aux membres administrateur (role = 1), sauf pour les pages front du site accessibles à tous (accueil du site, produits en solde, produits Homme, produits Femme)
        $this->middleware('admin')->except('index', 'show', 'showMen', 'showWomen', 'showSolds', 'updatePicture', 'switchPicture');
    }

////// Pour afficher la liste de tous les produits en ligne sur la page d'accueil du site (front du site accessible par tous)
    public function index()
    {     
        // liaison des tables products et categories par la clé secondaire  category_id (affiche du nom de la catégorie)
        // liaison des tables products et pictures par la clé secondaire  product_id (affiche des 4 images) 
        $products = DB::table('products')
                        ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
                        ->leftJoin('pictures', 'products.id', '=', 'pictures.product_id')
                        ->select('products.*', 'categories.title_category', 'pictures.picture')
                        ->where('pictures.order', 1)
                        ->where('products.status', 'publie')
                        ->orderBy('products.id', 'desc')
                        ->paginate($this->paginate);
        $user = Auth::user(); 
        // pour affiche du nombre de produits en ligne
        $productsCount = Product::where('status', 'publie')->get();
        // pour affiche du nombre de produits en brouillon (uniquement visible par membre administateur)
        $productsCountBr = Product::where('status', 'brouillon')->get();
        return view('product.index', [
            'products' => $products, 
            'user' => $user, 
            'productsCount' => $productsCount,
            'productsCountBr' => $productsCountBr, 
        ]); 
    }

////// Pour afficher la liste des produits en ligne de la catégorie Hommes (front du site accessible par tous)
    public function showMen()
    {
        // liaison des tables products et categories par la clé secondaire  category_id (affiche du nom de la catégorie)
        // liaison des tables products et pictures par la clé secondaire  product_id (affiche des 4 images) 
        $products = DB::table('products')
                        ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
                        ->leftJoin('pictures', 'products.id', '=', 'pictures.product_id')
                        ->select('products.*', 'categories.title_category', 'pictures.picture')
                        ->where('pictures.order', 1)
                        ->where('products.status', 'publie')
                        ->where('categories.title_category', 'Homme')
                        ->orderBy('products.id', 'desc')
                        ->paginate($this->paginate);
        $user = Auth::user(); 
         // pour affiche du nombre de produits Homme en ligne
        $productsCount = DB::table('products')
                        ->join('categories', 'products.category_id', '=', 'categories.id')
                        ->where('categories.title_category', 'Homme')
                        ->where('status', 'publie')->get();
        // pour affiche du nombre de produits Homme en brouillon (uniquement visible par membre administateur)
        $productsCountBr = DB::table('products')
                        ->join('categories', 'products.category_id', '=', 'categories.id')
                        ->where('categories.title_category', 'Homme')
                        ->where('status', 'brouillon')->get();
        return view('product.index', [
            'products' => $products, 
            'productsCount' => $productsCount,
            'productsCountBr' => $productsCountBr, 
            'user' => $user,
        ]);
    }

    // pour afficher la liste des produits en ligne de la catégorie Femmes (front du site accessible par tous)
    public function showWomen()
    {
        // liaison des tables products et categories par la clé secondaire  category_id (affiche du nom de la catégorie)
        // liaison des tables products et pictures par la clé secondaire  product_id (affiche des 4 images) 
        $products = DB::table('products')
                        ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
                        ->leftJoin('pictures', 'products.id', '=', 'pictures.product_id')
                        ->select('products.*', 'categories.title_category', 'pictures.picture')
                        ->where('pictures.order', 1)
                        ->where('products.status', 'publie')
                        ->where('categories.title_category', 'Femme')
                        ->orderBy('products.id', 'desc')
                        ->paginate($this->paginate);
        $user = Auth::user(); 
         // pour affiche du nombre de produits Femme en ligne
        $productsCount = DB::table('products')
                        ->join('categories', 'products.category_id', '=', 'categories.id')
                        ->where('categories.title_category', 'Femme')
                        ->where('status', 'publie')->get();
        // pour affiche du nombre de produits Femme en brouillon (uniquement visible par membre administateur)
        $productsCountBr = DB::table('products')
                        ->join('categories', 'products.category_id', '=', 'categories.id')
                        ->where('categories.title_category', 'Femme')
                        ->where('status', 'brouillon')->get();
        return view('product.index', [
            'products' => $products, 
            'productsCount' => $productsCount, 
            'productsCountBr' => $productsCountBr, 
            'user' => $user,
        ]);
    }

    // pour afficher la liste des produits en ligne soldés (front du site accessible par tous)
    public function showSolds()
    {
        // liaison des tables products et categories par la clé secondaire  category_id (affiche du nom de la catégorie)
        // liaison des tables products et pictures par la clé secondaire  product_id (affiche des 4 images) 
        $products = DB::table('products')
                        ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
                        ->leftJoin('pictures', 'products.id', '=', 'pictures.product_id')
                        ->select('products.*', 'categories.title_category', 'pictures.picture')
                        ->where('pictures.order', 1)
                        ->where('products.status', 'publie')
                        ->where('products.code', 'solde')
                        ->orderBy('products.id', 'desc')
                        ->paginate($this->paginate);        
        $user = Auth::user(); 
        // pour affiche du nombre de produits soldés en ligne
        $productsCount = Product::where('code', 'solde')->where('status', 'publie')->get();
        // pour affiche du nombre de produits soldés en brouillon (uniquement visible par membre administateur)
        $productsCountBr = Product::where('code', 'solde')->where('status', 'brouillon')->get();
        
        return view('product.index', [
            'products' => $products, 
            'productsCount' => $productsCount,
            'productsCountBr' => $productsCountBr, 
            'user' => $user,
            
        ]);
    }

    // pour afficher la fiche d'un produit en particulier (front du site accessible par tous)
    public function show(Product $product)
    {
        $user = Auth::user(); 
        // pour affiche le nom de la categorie du produit
        $category = Categorie::where('id', $product->category_id)->get();

        // pour afficher les images dans un ordre défini sur la page (1 = image principale, 2-4 = images secondaires)
        // image principale avec un order = 1
        $picture1 = Picture::where('product_id', $product->id)
                    ->where('order', 1)
                    ->get();
        // image secondaire
        $picture2 = Picture::where('product_id', $product->id)
                    ->where('order', 2)
                    ->get();        
        // image secondaire
        $picture3 = Picture::where('product_id', $product->id)
                    ->where('order', 3)
                    ->get();        
        // image secondaire
        $picture4 = Picture::where('product_id', $product->id)
                    ->where('order', 4)
                    ->get();  
            
        return view('product.show', [
            'product' => $product, 
            'user' => $user,
            'category' => $category,
            'picture1' => $picture1,
            'picture2' => $picture2,
            'picture3' => $picture3,
            'picture4' => $picture4,
        ]);
    }

    // pour modifier affichage de la photo principale (front du site accessible par tous)
    public function switchPicture($id)
    {
        $user = Auth::user(); 
        // pointe vers l'image cliquée
        $picture = Picture::find($id);
        // pointe vers l'image principale (order = 1) de la série des 4 images du produit et fait passer son ordre à l'ordre de l'image cliquée  
        $picturePrinc = Picture::where('product_id', $picture->product_id)
                        ->where('order', 1)
                        ->update(['order' => $picture->order]);
        // modifie l'ordre de l'image cliquée à 1
        $pictureRemove = Picture::where('id', $id)
                        ->update(['order' => 1]);
        return back();
    }

    // Pour la créaction d'un nouveau produit (back office accessible uniquement aux membres administrateurs)
    public function create()
    {
        // retourne toutes les catégories pour afficher les titles sur le page de création
        $categories = Categorie::all();
        // pour afficher toutes les tailles possibles pour les produits 
        $tailles = ['46', '46 48', '46 48 50', '46 48 50 52', '48', '48 50', '48 50 52', '50', '50 52', '52']; 
        $user = Auth::user();
         return view('product.create', [
            'user' => $user,
            'categories' => $categories, 
            'tailles' => $tailles,
         ]);
    }

    // Pour enregistrer le nouveau produit créé sur la page administrateur (la page d'accueil de l'espace membre de l'admin) (back office accessible uniquement aux membres administrateurs)
    public function store(Request $request)
    {
        // vérification de la validité des champs du formulaire
        $validator = Validator::make($request->all(), [
            'titre' => 'bail|required|string|min:8',
            'description' => 'bail|required|string|min:15',
            'price' => 'bail|required|numeric',
            'categorie' => 'bail|required',
            'taille' => 'bail|required',
            'status' => 'bail|required',
            'code' => 'bail|required',
            'reference' => 'bail|required|numeric',
            'picture_princ' => 'bail|required|image|mimes:jpeg, png',
            'picture_sec1' => 'bail|required|image|mimes:jpeg, png',
            'picture_sec2' => 'bail|required|image|mimes:jpeg, png',
            'picture_sec3' => 'bail|required|image|mimes:jpeg, png',
        ]);

        // retourne vers la page du formulaire avec message(s) d'erreur si champ(s) non valide(s)
        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // si tous les champs sont valides : 
        // - enregistrement des images dans le dossier public > images 
        $link0 = Str::random(12) . 'link0.jpg';
        $file0 = file_get_contents($request->picture_princ);
        Storage::disk('local')->put($link0, $file0);

        $link1 = Str::random(12) . 'link1.jpg';
        $file1 = file_get_contents($request->picture_sec1);
        Storage::disk('local')->put($link1, $file1);

        $link2 = Str::random(12) . 'link02.jpg';
        $file2 = file_get_contents($request->picture_sec2);
        Storage::disk('local')->put($link2, $file2);

        $link3 = Str::random(12) . 'link03.jpg';
        $file3 = file_get_contents($request->picture_sec3);
        Storage::disk('local')->put($link3, $file3);

        // - création d'un nouveau produit
        $product = new Product;

        // - injection des nouvelles données dans la table products
        $product->title_product = $request->titre;
        $product->description = $request->description;
        $product->price = $request->price; 
        $product->category_id = $request->categorie;
        $product->size = $request->taille;
        $product->status = $request->status;
        $product->code = $request->code;
        $product->reference = $request->reference;
        // - sauvegarde des nouvelles données dans la table products
        $product->save();

        // - création de la 1ère image associée au produit créé
        $picture0 = new Picture;         
        // - injection des nouvelles données de la 1ère image dans la table pictures     
        $picture0->product_id = $product->id;
        $picture0->picture = $link0; 
        // - la première image envoyée (champ avec label image principale dans le formulaire)
        $picture0->order = 1;  
        // - sauvegarde des nouvelles données de la 1ère image dans la table pictures      
        $picture0->save();

        // - création de la 2e image associée au produit créé
        $picture1 = new Picture;         
        // - injection des nouvelles données de la 2e image dans la table pictures           
        $picture1->product_id = $product->id;
        $picture1->picture = $link1; 
        $picture1->order = 2;    
        // - sauvegarde des nouvelles données de la 2e image dans la table pictures
        $picture1->save();

        // - création de la 3e image associée au produit créé
        $picture2 = new Picture;         
        // - injection des nouvelles données de la 3e image dans la table pictures   
        $picture2->product_id = $product->id;
        $picture2->picture = $link2;
        $picture2->order = 3;     
        // - sauvegarde des nouvelles données de la 3e image dans la table pictures
        $picture2->save();

        // - création de la 4e image associée au produit créé
        $picture3 = new Picture;         
        // - injection des nouvelles données de la 4e image dans la table pictures   
        $picture3->product_id = $product->id;
        $picture3->picture = $link3;        
        $picture3->order = 4;    
        // - sauvegarde des nouvelles données de la 4e image dans la table pictures
        $picture3->save(); 

        // redirection vers la page d'accueil du back office avec message de validation
        return redirect()->route('compte')->withStatus('Le produit a bien été ajouté !');        
    }

     // pour afficher le formulaire d'édition prérempli d'un produit pour une mise à jour (back office accessible uniquement aux membres administrateurs)
     public function edit($id)
     {
        // pour afficher toutes les tailles possibles pour les produits 
        $tailles = ['46', '46 48', '46 48 50', '46 48 50 52', '48', '48 50', '48 50 52', '50', '50 52', '52']; 
        // cible un produit en particulier par son id
        $product = Product::find($id);
        $user = Auth::user();
        // retourne toutes les catégories pour afficher les titles sur le page de mise à jour
        $categories = Categorie::all();
        // pour afficher les 4 images du produit en particulier
        $pictures = Picture::where('product_id', $product->id)->get(); 

        return view('product.edit', [
            'product' => $product,
            'user' => $user,
            'categories' => $categories,
            'tailles' => $tailles,
            'pictures' => $pictures,
         ]);
     }

    // pour afficher la fiche d'un produit en particulier avant sa suppression (back office accessible uniquement aux membres administrateurs)
    public function editDestroy($id)
    {
        // cible un produit en particulier par son id
        $product = Product::find($id);
        // cible la catégorie du produit en particulier
        $category = Categorie::where('id', $product->category_id)->get();
        // pour afficher les 4 images du produit en particulier
        $pictures = Picture::where('product_id', $product->id)->get();         
        $user = Auth::user();
        
        return view('product.editdestroy', [
            'product' => $product,
            'user' => $user,
            'category' => $category,
            'pictures' => $pictures,
        ]);
    }
    
    // Pour mettre à jour un produit en particulier via le formulaire d'édition (back office accessible uniquement aux membres administrateurs)
    public function update(Request $request, $id)
    {
        // cible un produit en particulier par son id
        $product = Product::find($id);
        // pour afficher les 4 images du produit en particulier
        $picture = Picture::where('product_id', $id)->get();

        // vérification de la validité des champs
        $validator = Validator::make($request->all(), [
            'titre' => 'bail|required|string|min:8',
            'description' => 'bail|required|string|min:15',
            'price' => 'bail|required|numeric',
            'reference' => 'bail|required|numeric',
            'picture_princ' => 'bail|required|image|mimes:jpeg, png',
            'picture_sec1' => 'bail|required|image|mimes:jpeg, png',
            'picture_sec2' => 'bail|required|image|mimes:jpeg, png',
            'picture_sec3' => 'bail|required|image|mimes:jpeg, png',
        ]);
        
        // retourne vers la page du formulaire avec message(s) d'erreur si champ(s) non valide(s)
        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        // si tous les champs sont valides : 
        // - enregistrement des images dans le dossier public > images 
        $link0 = Str::random(12) . '.jpg';
        $file0 = file_get_contents($request->picture_princ);
        Storage::disk('local')->put($link0, $file0);

        $link1 = Str::random(12) . '.jpg';
        $file1 = file_get_contents($request->picture_sec1);
        Storage::disk('local')->put($link1, $file1);

        $link2 = Str::random(12) . '.jpg';
        $file2 = file_get_contents($request->picture_sec2);
        Storage::disk('local')->put($link2, $file2);

        $link3 = Str::random(12) . '.jpg';
        $file3 = file_get_contents($request->picture_sec3);
        Storage::disk('local')->put($link3, $file3);
        
        // - injection des nouvelles données dans la table products 
        $product->title_product = $request->titre;
        $product->description = $request->description;
        $product->price = $request->price; 
        $product->category_id = $request->categorie;
        $product->size = $request->taille;        
        $product->status = $request->status;
        $product->code = $request->code;
        $product->reference = $request->reference;
        // - sauvegarde des nouvelles données dans la table products
        $product->save();

        //suppression des anciennes images dans le dossier public > images
        foreach ($picture as $pic) {
            Storage::delete($pic->picture);
        }
        
        // - injection des nouvelles données dans la table pictures
        $picture[0]->picture = $link0;
        $picture[1]->picture = $link1; 
        $picture[2]->picture = $link2; 
        $picture[3]->picture = $link3;
        // - sauvegarde des nouvelles données dans la table products         
        $picture[0]->save();
        $picture[1]->save();
        $picture[2]->save();
        $picture[3]->save();        
        
        // redirection vers la page d'édition du formulaire avec message de validation
        return back()->withStatus('Le produit a bien été modifié !');
    }

    // Pour supprimer un produit via lien suppression (back office accessible uniquement aux membres administrateurs)
    public function destroy($id)
    {
        // cible un produit en particulier par son id
        $product = Product::find($id);
        // cible les 4 images du produit en particulier
        $pictures = Picture::where('product_id', $id)->get();
        // boucle sur les 4 images ciblées pour les supprimer du dossier public > images et de la table pictures
        foreach ($pictures as $picture) {
            Storage::delete($picture->picture);
            $picture->delete();
        }   
        // suppression du produit ciblé dans la table products     
        $product->delete();
        // redirection vers la d'accueil du back office avec message de validation
        return redirect()->route('compte')->withStatus('Le produit a bien été supprimé !');
    }
}
