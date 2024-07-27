<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Productos;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class tiendaApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    /*
       Constructor para aplicar la seguridad a los endpoints de la aplicación.
       
       la clave ultrasecreta para autentificar el token, se almacena en las variables de entorno de la aplicación
       en el archivo .env en la variable FIREBASE_JWT_SECRE
    */
    public function __construct()
    {

        $this->middleware(function ($request, $next)
        {

            $token = $request->header('Authorization');
            
            // Obtén la clave secreta desde tus variables de entorno
            $secretKey = env('FIREBASE_JWT_SECRET');

            // Crea una instancia de Key
            $key = new Key($secretKey, 'HS256');

            if (!$token)
            {
                // Maneja el caso en que no se proporciona un token
                return response()->json(['message' => 'Token no proporcionado'], 401);
            }

            try
            {
                // Verifica y decodifica el token
                $decoded = JWT::decode($token, new Key($secretKey, 'HS256'));

                // Puedes acceder a los datos del token como $decoded->sub, $decoded->exp, etc.
                
            }
            catch(\Exception $e)
            {
                // Maneja errores de token inválido
                
                return response()->json(['message' => 'Token invalido'], 401);
            }

            return $next($request);
        });
    }

    /* Función que obtiene y lista tosa la colección de los productos - METODO GET*/
    public function index()
    {
        $productos = Productos::get();

        if ($productos->isEmpty())
        {
            return response()
                ->json(['error' => 'No hay productos en el inventario'], 404);
        }

        $formattedData = [];

        foreach ($productos as $producto)
        {
            $formattedData[] = ['name' => $producto->name, 'description' => $producto->description, 'height' => (float)$producto->height, 'length' => (float)$producto->length, 'width' => (float)$producto->width, ];
        }

        return response()
            ->json($formattedData);
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /* Resgistra un nuevo producto en el inventario - METODO POST */
    public function store(Request $request)
    {
        try
        {
            // Define las reglas de validación
            $rules = ['name' => 'required|string', 'description' => 'required|string', 'height' => 'required|numeric', 'length' => 'required|numeric', 'width' => 'required|numeric', ];

            // Valida los datos recibidos
            $validator = Validator::make($request->all() , $rules);

            if ($validator->fails())
            {
                return response()
                    ->json(['error' => $validator->errors() ], 422);
            }

            // Crea un nuevo producto
            $producto = new Productos();
            $producto->name = $request->name;
            $producto->description = $request->description;
            $producto->height = $request->height;
            $producto->length = $request->length;
            $producto->width = $request->width;
            $producto->save();

            // Devuelve una respuesta con código 200
            return response()
                ->json(['message' => 'Producto creado correctamente'], 200);
        }
        catch(\Exception $e)
        {
            // En caso de otro error, devuelve una respuesta con código 500
            return response()->json(['error' => 'Error al crear el producto'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /* Actualiza o edita un producto - METODO PUT */
    public function update(Request $request, $id)
    {

        try
        {
            // Busca el producto por su ID
            $producto = Productos::find($id);

            if (!$producto)
            {
                return response()->json(['error' => 'Producto no encontrado'], 404);
            }

            // Define las reglas de validación
            $rules = ['name' => 'required|string', 'description' => 'required|string', 'height' => 'required|numeric', 'length' => 'required|numeric', 'width' => 'required|numeric', ];

            // Valida los datos recibidos
            $validator = Validator::make($request->all() , $rules);

            if ($validator->fails())
            {
                return response()
                    ->json(['error' => $validator->errors() ], 422);
            }

            // Actualiza los campos del producto
            $producto->update($request->all());

            return response()
                ->json(['message' => 'Producto actualizado correctamente'], 200);
        }
        catch(\Exception $e)
        {
            return response()->json(['error' => 'Error al actualizar el producto'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /* Elimina un producto, aqui aplique la baja fisica, pero en ambientes reales debería ser
       una baja logica para dejar evidencia para un log de sucesos - METODO DELETE*/
    public function destroy($id)
    {
        try
        {
            $producto = Productos::find($id);

            if (!$producto)
            {
                return response()->json(['error' => 'Producto no encontrado'], 404);
            }

            $producto->delete();
            return response()
                ->json(['message' => 'Producto eliminado correctamente'], 200);
        }
        catch(\Exception $e)
        {
            return response()->json(['error' => 'Error al eliminar el producto'], 500);
        }
    }

}

