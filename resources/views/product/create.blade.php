<!-- PAGE DE CREATION D'UN NOUVEAU PRODUIT (back office accessible uniquement aux membres administrateurs)-->

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

    <!-- affichage du formulaire vide  -->
    <div class="card card-formulaire mb-5">
        <div style="letter-spacing:2px" class="card-header text-info font-weight-bold py-4">Ajouter un produit</div>
        <ul class="card-body">
            <!-- envoi des données du formulaire vers admin.store pour validation -->
            <form method="POST" action="{{ route('admin.store') }}" enctype="multipart/form-data" novalidate>
                <!-- protection de la faille CSRF -->
                @csrf

                <div class="flex-formulaire">
                    <div class="flex-formulaire1">

                        <!-- champ titre -->
                        <div class="form-group row mb-5">                            
                            <label for="titre" class="col-sm-4 col-form-label">Titre*</label>
                            <div class="col-sm-8">
                                <input type="text" name="titre" class="form-control form-control-sm" id="titre" value="{{ old('titre') }}">
                            </div>
                        </div>

                        <!-- champ description -->
                        <div class="form-group mb-5">
                            <label class="mb-3" for="description">Description*</label>
                            <textarea name="description" class="form-control" id="description" rows="8">{{ old('description') }}</textarea>
                        </div>

                        <!-- champ prix -->
                        <div class="form-group row mb-5">
                            <label for="prix" class="col-sm-4 col-form-label">Prix*</label>
                            <div class="col-sm-8">
                                <input type="number" name="price" class="form-control form-control-sm" id="prix" value="{{ old('price') }}">
                            </div>
                        </div>

                        <!-- liste catégories -->
                        <div class="form-group row mb-5">
                            <label for="categorie" class="col-sm-4 col-form-label">Catégorie*</label>
                            <div class="col-sm-8">
                                <select id="categorie" name="categorie" class="form-control form-control-sm">
                                    <option value="">Sélectionnez catégorie</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                        <?= $catSelect = old('categorie') === $category->id ? 'selected' : '' ?>>{{ $category->title_category }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- liste tailles -->
                        <div class="form-group row mb-5">
                            <label for="taille" class="col-sm-4 col-form-label">Taille*</label>
                            <div class="col-sm-8">
                                <select id="taille" name="taille" class="form-control form-control-sm">
                                    <option value="" selected>Sélectionnez taille</option>
                                    @foreach($tailles as $taille)
                                        <option value="{{ $taille }}"
                                        <?= $tailleSelect = old('taille') === $taille ? 'selected' : '' ?>>{{ $taille }}</option>
                                    @endforeach
                                </select>
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
                                <?= $statSelect = old('status') === 'publie' ? 'checked' : '' ?> checked>
                                <label class="form-check-label ml-3" for="publie">Publié</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="brouillon" value="brouillon" 
                                <?= $statSelect = old('status') === 'brouillon' ? 'checked' : '' ?>>
                                <label class="form-check-label ml-3" for="brouillon">Brouillon</label>
                            </div> 
                        </fieldset>

                        <!-- liste code du produit -->
                        <div class="form-group mb-5">
                            <label for="code" class="col-form-label mb-3">Code produit*</label>
                            <select id="code" name="code" class="form-control form-control-sm">
                                <option value="">Sélectionnez code produit</option>
                                <option value="solde"
                                <?= $codeSelect = old('code') === 'solde' ? 'selected' : '' ?>>solde</option>
                                <option value="new"
                                <?= $codeSelect = old('code') === 'new' ? 'selected' : '' ?>>new</option>                                
                            </select>
                        </div>

                        <!-- champ référence -->
                        <div class="form-group mb-5">
                            <label for="reference" class="col-form-label mb-3">Référence produit*</label>
                            <input type="text" name="reference" class="form-control form-control-sm" id="reference" value="{{ old('reference') }}">
                        </div>

                    </div>
                </div>

                <!-- bouton de validation du formulaire -->
                <input class="btn btn-info px-5 py-3" type="submit" value="Ajouter">

                <p class="mt-4 font-italic" style="font-size:12px">* tous les champs sont obligatoires.</p>

            </form>                        
        </ul>
    </div>

</div>

@endsection