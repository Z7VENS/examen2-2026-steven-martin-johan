<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\Material;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MaterialControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Valida que el endpoint encargado de insertar nuevos registros de materiales,
     * para el escenario en el cual el material no existe, lo hace correctamente.
     */
    public function test_dadoUnMaterialQueNoExiste_insertarMaterial_funcionaCorrectamente(): void
    {
        // Arrange: Crear una categoría asociada
        $categoria = Categoria::create([
            'nombre' => 'Papelería',
        ]);

        $datosMaterial = [
            'unidadMedida' => 'Unidad',
            'descripcion'  => 'Resma de papel bond',
            'ubicacion'    => 'Bodega A - Estante 3',
            'idCategoria'  => $categoria->idCategoria,
        ];

        // Act: Llamar al endpoint POST /api/materiales
        $response = $this->postJson('/api/materiales', $datosMaterial);

        // Assert: Verificar que se creó correctamente
        $response->assertStatus(201);

        $response->assertJsonStructure([
            'codigo',
            'unidadMedida',
            'descripcion',
            'ubicacion',
            'idCategoria',
            'categoria' => [
                'idCategoria',
                'nombre',
            ],
        ]);

        $response->assertJsonFragment([
            'unidadMedida' => 'Unidad',
            'descripcion'  => 'Resma de papel bond',
            'ubicacion'    => 'Bodega A - Estante 3',
            'idCategoria'  => $categoria->idCategoria,
        ]);

        // Verificar que el material existe en la base de datos
        $this->assertDatabaseHas('materiales', [
            'unidadMedida' => 'Unidad',
            'descripcion'  => 'Resma de papel bond',
            'ubicacion'    => 'Bodega A - Estante 3',
            'idCategoria'  => $categoria->idCategoria,
        ]);
    }
}
