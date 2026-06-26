<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;

class RealtimeSessionController extends Controller
{
    /**
     * Crea una nueva sesión realtime llamando a la API de OpenAI.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        // Obtener la configuración definida en config/services.php
        $key = config('services.openai.key');
        $url = config('services.openai.url');
        $model = config('services.openai.model');
        $timeout = config('services.openai.timeout');

        try {
            // Realizar la petición POST a OpenAI usando la facade Http
            $response = Http::withToken($key)
                ->timeout($timeout)
                ->post($url, [
                    'model' => $model,
                    'voice' => 'verse',
                ]);

            // Lanzar una excepción si ocurre un error HTTP (4xx o 5xx)
            $response->throw();

            // Retornar la respuesta JSON de OpenAI con código de estado HTTP 200
            return response()->json($response->json(), 200);

        } catch (RequestException $e) {
            // Manejar errores de petición HTTP de la API externa (retorna 502)
            return response()->json([
                'error' => 'Error al conectar con el servicio externo de OpenAI.',
                'message' => $e->getMessage(),
            ], 502);
        } catch (\Exception $e) {
            // Manejar cualquier otro tipo de error inesperado (retorna 502)
            return response()->json([
                'error' => 'Ocurrió un error inesperado al procesar la solicitud.',
                'message' => $e->getMessage(),
            ], 502);
        }
    }
}
