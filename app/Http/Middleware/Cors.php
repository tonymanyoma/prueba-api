<?php
namespace App\Http\Middleware;

use Closure;

class Cors
{
  public function handle($request, Closure $next)
  {

   
      $headers = [
          'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE, OPTIONS' ,
          'Access-Control-Allow-Headers' => ' Origin, Content-Type, Authorization, X-Auth-Token',
          'Access-Control-Allow-Origin' => '*',
          'Access-Control-Allow-Credential' => 'true',
          'Access-Control-Allow-Headers' =>  'Authorization, x-xsrf-token, x_csrftoken, Cache-Control, X-Requested-With',
          'Content-Type' => 'application/json;charset=UTF-8',
          'Content-Type' => 'application/xml',


      ] ;
      if ( $request->getMethod() == "OPTIONS" ) {
          return response()->json('OK', 200, $headers );
      }
      $response = $next( $request ) ;
      foreach ( $headers as $key => $value ) {
          $response->header( $key, $value ) ;
      }
      return $response ;
  }


}
