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



	// Miembro 2 - Johann Fonseca
    /**
     * Actualizar un material existente.
     * PUT /api/materiales/{codigo}
     */
    public function update(Request $request, int $codigo): JsonResponse
    {
        $material = Material::findOrFail($codigo);

        $request->validate([
            'unidadMedida' => 'sometimes|required|string',
            'descripcion'  => 'sometimes|required|string',
            'ubicacion'    => 'sometimes|required|string',
            'idCategoria'  => 'sometimes|required|integer|exists:categorias,idCategoria',
        ]);

        $material->update($request->only([
            'unidadMedida',
            'descripcion',
            'ubicacion',
            'idCategoria',
        ]));

        $material->load('categoria');

        return response()->json($material, 200);
    }

    /**
     * Obtener la lista de materiales con sus categorías asociadas.
     * GET /api/materiales
     */
    public function index(): JsonResponse
    {
        $materiales = Material::with('categoria')->get();

        return response()->json($materiales, 200);
    }
}
