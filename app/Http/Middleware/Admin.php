<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    // middleware Admin qui vérifie si le membre est administrateur (role renseigné à 1) pour pouvoir modifier le contenu de la boutique
    public function handle($request, Closure $next)
    {
        // verification que le membre est bien authentifié
        if(Auth::check()) {
            $user = Auth::user(); 
            // vérification que le membre authentifié a son role renseigné à 1
            if($user->role === 1) {
                return $next($request);
            }            
        }
        // si membre n'est pas authentifié ou si le membre est authentifié mais a son role renseigné autre chose que 1
        return redirect()->route('product.index');     
    }
}
