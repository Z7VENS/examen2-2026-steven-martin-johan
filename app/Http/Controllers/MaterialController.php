<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Categoria;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Insertar un material con su categoría asociada.
     * POST /api/materiales
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'unidadMedida' => 'required|string',
            'descripcion'  => 'required|string',
            'ubicacion'    => 'required|string',
            'idCategoria'  => 'required|integer|exists:categorias,idCategoria',
        ]);

        $material = Material::create([
            'unidadMedida' => $request->input('unidadMedida'),
            'descripcion'  => $request->input('descripcion'),
            'ubicacion'    => $request->input('ubicacion'),
            'idCategoria'  => $request->input('idCategoria'),
        ]);

        // Cargar la relación categoría para devolverla en la respuesta
        $material->load('categoria');

        return response()->json($material, 201);
    }
}
