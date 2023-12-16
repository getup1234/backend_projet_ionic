<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnoncesController extends Controller
{

    public function propres_annonces(){
        $annonces = Annonce::where('user_id',Auth::id())->get();
        return response()->json($annonces);
    }
    public function index()
    {
        $annonces = Annonce::all();
        return response()->json($annonces);
    }

    public function show($id)
    {
        $annonce = Annonce::find($id);
        if (!$annonce) {
            return response()->json(['message' => 'Annonce not found'], 404);
        }
        return response()->json($annonce);
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required',
            'description' => 'required',
            'location' => 'required',
            'categorie' => 'required',
            'price' => 'required|numeric',
        ]);

        $annonce = Annonce::create(array_merge($request->all(), ['user_id' => Auth::id()]));
        return response()->json($annonce, 201);
    }

    public function update(Request $request, $id)
    {
        $annonce = Annonce::find($id);
        if (!$annonce) {
            return response()->json(['message' => 'Annonce not found'], 404);
        }

        $request->validate([
            'titre' => 'required',
            'description' => 'required',
            'location' => 'required',
            'categorie' => 'required',
            'price' => 'required|numeric',
        ]);

        $annonce->update(array_merge($request->all(), ['user_id' => Auth::id()]));
        return response()->json($annonce, 200);
    }

    public function destroy($id)
    {
        $annonce = Annonce::find($id);
        if (!$annonce) {
            return response()->json(['message' => 'Annonce not found'], 404);
        }

        $annonce->delete();
        return response()->json(['message' => 'Annonce deleted'], 200);
    }
}
