<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Database\Eloquent\Model;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Produto extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function getProduct(Request $request){
        
        if (isset($request->id) == true){
            return Product::find($request->id);
        }
        return Product::all();
    }

    public function insertProduct(Request $request){
        $arrDados = ( $request->all() );
        try {
            $validator = Validator::make($request->all(), [
                'description' => 'required',
                'price' => 'required',
            ]);
            
            $result = Product::create([
                'description' => $arrDados['description'],
                'price' => (float)$arrDados['price']
            ]);
            
            
            return response(json_encode([
                "sn_erro" => false,
                "dados" => $arrDados
            ]), 200); 

        } catch (\Exception $e) {
            return response(json_encode([
                "sn_erro" => true,
                "mensagem" => $validator->errors()->all()
            ]), 400); 
            
        }
 
    }

    public function updateProduct(Request $request){
        $arrDados = ( $request->all() );
        try {
            $validator = Validator::make($request->all(), [
                'description' => 'required',
                'price' => 'required',
                'id' => 'required',
            ]);

            unset($arrDados['id']);

            $affectedRows = Product::where('id', '=', $request->all('id') )->update( $arrDados );
            
            return response(json_encode([
                "sn_erro" => false,
                "dados" => $arrDados
            ]), 200); 

        } catch (\Exception $e) {
            $error_msg = ( !empty($validator->errors()->all() ) ? $validator->errors()->all() : $e->getMessage() );
            return response(json_encode([
                "sn_erro" => true,
                "mensagem" => $error_msg
            ]), 400); 
            
        }
 
    }

    public function deleteProduct(Request $request){
        $arrDados = ( $request->all() );
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required'
            ]);

            $affectedRows = Product::where('id', '=', $request->all('id') )->delete();
            
            return response(json_encode([
                "sn_erro" => false,
                "dados" => $arrDados
            ]), 200); 

        } catch (\Exception $e) {
            $error_msg = ( !empty($validator->errors()->all() ) ? $validator->errors()->all() : $e->getMessage() );
            return response(json_encode([
                "sn_erro" => true,
                "mensagem" => $error_msg
            ]), 400); 
            
        }
 
    }
}
