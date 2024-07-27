<?php

use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use App\Access_tokens;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


/*-----------------------------------------------------
|                               
|  Conjunto de API End points de /products
|
|-----------------------------------------------------*/

Route::middleware('firebase.token')->group(function () {

Route::resource('products', 'tiendaApiController'); //API protegida con JWT

});


/*------------------------------------------------------------ 
|                               
|  - Ruta para la creación de tokens con vigencia 
|  de 1 hora.
|  - En este caso maneje el ejemplo para actualizar el token 
|  solo de mi usuario
|-------------------------------------------------------------*/

Route::get('/generate-token', function () {
  $key = 'nombreno'; // Cambia esto a tu clave secreta
	$token = [
	    'iss' => 'martin', 
	    'aud' => 'rivera', 
	    'iat' => time(), // Tiempo de emisión (timestamp actual)
	    'exp' => time() + 3600, // Tiempo de expiración (1 hora después)
	];

	$jwt = JWT::encode($token, $key, 'HS256'); 

	// Buscar el token del usuario con id=1 en este caso mi usuario.
	$token = Access_tokens::where('user_id', 1)->first();

	if ($token) {

	    // Si existe, solo actualizar el token
	    $token->token = $jwt;
	    $token->save();
	}else {
	    // Si no existe, crear un nuevo registro
	    $token = new Access_tokens();
	    $token->user_id = 1;
	    $token->token = $jwt;
	    $token->save();
    }

	return response()->json(['token' => $jwt]);
});


