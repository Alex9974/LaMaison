<!-- PAGE DE MISE A JOUR D'UN PRODUIT (back office accessible uniquement aux membres administrateurs)-->

@extends('layouts.admin')

@section('content')
<div class="container">
    <!-- message de validation du formulaire -->
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif   
    <!-- message retourné en cas d'erreur dans l'envoi des données du formulaire --> 
    @foreach($errors->all() as $error)
        <div class="alert alert-danger">*
            {{ $error }}
        </div>
    @endforeach

    <!-- affichage du formulaire prérempli  -->
    <div class="card card-formulaire mb-5">
        <div style="letter-spacing:2px" class="card-header text-info font-weight-bold py-4">Modifier un produit</div>
        <ul class="card-body">
            <!-- envoi des données du formulaire vers admin.update pour validation -->
            <form method="POST" action="{{ route('admin.update', $product) }}" enctype="multipart/form-data" novalidate>
                <!-- protection de la faille CSRF -->
                @csrf
                @method('PUT')

                <div class="flex-formulaire">
                    <div class="flex-formulaire1">

                        <!-- champ titre -->
                        <div class="form-group row mb-5"> 
                            <label for="titre" class="col-sm-4 col-form-label">Titre*</label>
                            <div class="col-sm-8">
                                <input type="text" name="titre" class="form-control form-control-sm" id="titre" value="{{ $product->title_product }}">
                            </div>
                        </div>
                        
                        <!-- champ description -->
                        <div class="form-group mb-5">
                            <label class="mb-3" for="description">Description*</label>
                            <textarea name="description" class="form-control" id="description" rows="8">{{ $product->description }}</textarea>
                        </div>

                        <!-- champ prix -->                        
                        <div class="form-group row mb-5">
                            <label for="prix" class="col-sm-4 col-form-label">Prix*</label>
                            <div class="col-sm-8">
                                <input type="number" name="price" class="form-control form-control-sm" id="prix" value="{{ $product->price }}">
                            </div>
                        </div>
                        
                        <!-- liste catégories -->
                        <div class="form-group row mb-5">
                            <label for="categorie" class="col-sm-4 col-form-label">Catégorie*</label>
                            <div class="col-sm-8">
                                <select id="categorie" name="categorie" class="form-control form-control-sm">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                        <?= $catSelect = $product->category_id === $category->id ? 'selected' : '' ?>>{{ $category->title_category }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <!-- liste tailles -->
                        <div class="form-group row mb-5">
                            <label for="taille" class="col-sm-4 col-form-label">Taille*</label>
                            <div class="col-sm-8">
                                <select id="taille" name="taille" class="form-control form-control-sm">
                                    @foreach($tailles as $taille)
                                        <option value="{{ $taille }}" 
                                        <?= $taillleSelect = $product->size === $taille ? 'selected' : '' ?>>{{ $taille }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- affichage des images du produit sélectioné -->
                        <div class="row">
                            <!-- image principale -->
                            <div class="col-sm-12 col-md-6 col-lg-9 card mb-5  border-info" style="width: 8rem;">
                                <img class="card-img-top img-fluid" src="{{ asset('images/'.$pictures[0]->picture) }}" alt="{{ $product->title_product }}">
                                <div class="card-body">
                                    <p class="card-text text-center">Image principale</p>
                                </div>
                            </div>
                            <!-- image secondaire 1 -->
                            <div class="col-sm-12 col-md-6 col-lg-4 card mb-5" style="width: 8rem;">
                                <img class="card-img-top img-fluid" src="{{ asset('images/'.$pictures[1]->picture) }}" alt="{{ $product->title_product }}">
                                <div class="card-body">
                                    <p class="card-text text-center">Image secondaire 1</p>
                                </div>
                            </div> 
                            <!-- image secondaire 2 -->
                            <div class="col-sm-12 col-md-6 col-lg-4 card mb-5" style="width: 8rem;">
                                <img class="card-img-top img-fluid" src="{{ asset('images/'.$pictures[2]->picture) }}" alt="{{ $product->title_product }}">
                                <div class="card-body">
                                    <p class="card-text text-center">Image secondaire 2</p>
                                </div>
                            </div> 
                            <!-- image secondaire 3 -->
                            <div class="col-sm-12 col-md-6 col-lg-4 card mb-5" style="width: 8rem;">
                                <img class="card-img-top img-fluid" src="{{ asset('images/'.$pictures[3]->picture) }}" alt="{{ $product->title_product }}">
                                <div class="card-body">
                                    <p class="card-text text-center">Image secondaire 3</p>
                                </div>
                            </div>  
                        </div>   
                        
                        <!-- téléchargement des images -->
                        <!-- image principale -->
                        <div class="d-flex align-items-center border border-muted rounded mb-3">
                            <label for="exampleFormControlFile1" class="col-4">Image principale*</label>
                            <input type="file" name="picture_princ" class="form-control-file col-8 py-3 text-info" id="exampleFormControlFile1">
                        </div>
                        
                        <!-- image secondaire 1 -->
                        <div class="d-flex align-items-center border border-muted rounded mb-3">
                            <label for="exampleFormControlFile1" class="col-4">Image secondaire 1*</label>
                            <input type="file" name="picture_sec1" class="form-control-file col-8 py-3 text-info" id="exampleFormControlFile1">
                        </div>
                        
                        <!-- image secondaire 2 -->
                        <div class="d-flex align-items-center border border-muted rounded mb-3">
                            <label for="exampleFormControlFile1" class="col-4">Image secondaire 2*</label>
                            <input type="file" name="picture_sec2" class="form-control-file col-8 py-3 text-info" id="exampleFormControlFile1">
                        </div>
                        
                        <!-- image secondaire 3 -->
                        <div class="d-flex align-items-center border border-muted rounded mb-5">
                            <label for="exampleFormControlFile1" class="col-4">Image secondaire 3*</label>
                            <input type="file" name="picture_sec3" class="form-control-file col-8 py-3 text-info" id="exampleFormControlFile1">
                        </div>

                    </div>

                    <div class="flex-formulaire2">
                    
                        <!-- sélection du statut -->
                        <fieldset class="form-group mb-5">    
                            <legend class="col-form-label mb-3">Statut*</legend>
                        
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="radio" name="status" id="publie" value="publie" 
                                <?= $publie = $product->status === 'publie' ? 'checked' : '' ?>>
                                <label class="form-check-label ml-3" for="publie">Publié</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="brouillon" value="brouillon" 
                                <?= $brouillon = $product->status === 'brouillon' ? 'checked' : '' ?>>
                                <label class="form-check-label ml-3" for="brouillon">Brouillon</label>
                            </div> 
                        </fieldset>

                        <!-- liste code du produit -->
                        <div class="form-group mb-5">
                            <label for="code" class="col-form-label mb-3">Code produit*</label>
                            <select id="code" name="code" class="form-control form-control-sm">
                                <option value="solde"
                                <?= $soldSelect = $product->code === 'solde' ? 'selected' : '' ?>>solde</option>
                                <option value="new"
                                <?= $newSelect = $product->code === 'new' ? 'selected' : '' ?>>new</option>                                
                            </select>
                        </div>

                        <!-- champ référence -->
                        <div class="form-group mb-5">
                            <label for="reference" class="col-form-label mb-3">Référence produit*</label>
                            <input type="text" name="reference" class="form-control form-control-sm" id="reference" value="{{ $product->reference }}">
                        </div>
                    </div>
                </div>

                <!-- bouton de validation du formulaire -->
                <input class="btn btn-info px-5 py-3" type="submit" value="Mettre à jour">
                
                <p class="mt-4 font-italic" style="font-size:12px">* tous les champs sont obligatoires.</p>

            </form>
                        
        </ul>
    </div>
</div>

@endsection