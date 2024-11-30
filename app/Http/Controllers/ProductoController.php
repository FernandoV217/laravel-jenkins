<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductoController extends Controller
{
    public function getProductos() {
        $productos = Producto::all();

        if ($productos->isEmpty()) {
            $data = [
                'mensaje' => 'No hay productos disponibles',
                'status' => 404
            ];

            return response()->json($data, 404);
        }

        $data = [
            'productos' => $productos,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function createProducto(Request $request) {
        $validation = Validator::make($request->all(), [
                        'idCategoria' => 'required',
                        'nombre' => 'required|min:5|unique:producto',
                        'cantidad' => 'required'
                    ]);      
                    
        if ($validation->fails()) {
            $data = [
                'mensaje' => 'Error en la validacion',
                'errors' => $validation->errors(),
                'status' => 400
            ];

            return response()->json($data, 400);
        }

        $producto = Producto::create([
            'idCategoria' => $request->idCategoria,
            'nombre' => $request->nombre,
            'cantidad' => $request->cantidad,
            'precio' => $request->precio
        ]);

        if (!$producto) {
            $data = [
                'mensaje' => 'Error al crear el producto',
                'status' => 500
            ];

            return response()->json($data, 500);            
        }

        $data = [
            'mensaje' => 'Producto creado correctamente',
            'producto' => $producto,
            'status' => 201
        ];

        return response()->json($data, 201);
    }
}
