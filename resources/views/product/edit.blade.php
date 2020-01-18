@extends('layouts.admin')

@section('content')
<div class="container">
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    @foreach($errors->all() as $error)
        <div class="alert alert-danger">*
            {{ $error }}
        </div>
    @endforeach

    <div class="card card-formulaire mb-5">
        <div style="letter-spacing:2px" class="card-header text-info font-weight-bold py-4">Modifier un produit</div>
        <ul class="card-body">
            <form method="POST" action="{{ route('admin.update', $product->id) }}" enctype="multipart/form-data" novalidate>
                @csrf
                @method('PUT')

                <div class="flex-formulaire">
                    <div class="flex-formulaire1">
                        <div class="form-group row mb-5">
                            <label for="titre" class="col-sm-4 col-form-label">Titre</label>
                            <div class="col-sm-8">
                                <input type="text" name="titre" class="form-control form-control-sm" id="titre" value="{{ $product->title_product }}">
                            </div>
                        </div>

                        <div class="form-group mb-5">
                            <label class="mb-3" for="description">Description</label>
                            <textarea name="description" class="form-control" id="description" rows="8">{{ $product->description }}</textarea>
                        </div>

                        <div class="form-group row mb-5">
                            <label for="prix" class="col-sm-4 col-form-label">Prix</label>
                            <div class="col-sm-8">
                                <input type="number" name="price" class="form-control form-control-sm" id="prix" value="{{ $product->price }}">
                            </div>
                        </div>

                        <div class="form-group row mb-5">
                            <label for="categorie" class="col-sm-4 col-form-label">Catégorie</label>
                            <div class="col-sm-8">
                                <select id="categorie" name="categorie" class="form-control form-control-sm">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                        <?= $catSelect = $product->category_id === $category->id ? 'selected' : '' ?>>{{ $category->title_category }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-5">
                            <label for="taille" class="col-sm-4 col-form-label">Taille</label>
                            <div class="col-sm-8">
                                <select id="taille" name="taille" class="form-control form-control-sm">
                                    @foreach($tailles as $taille)
                                        <option value="{{ $taille }}" 
                                        <?= $taillleSelect = $product->size === $taille ? 'selected' : '' ?>>{{ $taille }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="card mb-5" style="width: 8rem;">
                            <img class="card-img-top img-fluid" src="{{ asset('images/'.$product->url_image) }}" alt="{{ $product->title_product }}">
                            <div class="card-body">
                                <p class="card-text text-center">Image actuelle</p>
                            </div>
                        </div> 

                        <div class="custom-file mb-5">
                            <input type="file" name="picture" class="custom-file-input" id="validatedCustomFile" required>
                            <label class="custom-file-label" for="validatedCustomFile">Téléchargez une nouvelle image</label>
                        </div>

                    </div>


                    <div class="flex-formulaire2">

                        <fieldset class="form-group mb-5">    
                            <legend class="col-form-label mb-3">Statut</legend>
                        
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


                        <div class="form-group mb-5">
                            <label for="code" class="col-form-label mb-3">Code produit</label>
                            <select id="code" name="code" class="form-control form-control-sm">
                                <option value="solde"
                                <?= $soldSelect = $product->code === 'solde' ? 'selected' : '' ?>>solde</option>
                                <option value="new"
                                <?= $newSelect = $product->code === 'new' ? 'selected' : '' ?>>new</option>                                
                            </select>
                        </div>

                        <div class="form-group mb-5">
                            <label for="reference" class="col-form-label mb-3">Référence produit</label>
                            <input type="text" name="reference" class="form-control form-control-sm" id="reference" value="{{ $product->reference }}">
                        </div>

                    </div>

                </div>

                <input class="btn btn-info px-5 py-3" type="submit" value="Mettre à jour">

            </form>
                        
        </ul>
    </div>

</div>

@endsection