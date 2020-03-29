<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Database\Eloquent\Model;
use App\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Vendas extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function getSales(Request $request){
        
        if (isset($request->id) == true){
            return Sales::find($request->id);
        }
        return Sales::all();
    }


    public function insertVenda(Request $request){
        $arrDados = ( $request->all() );
        try {

            $arrDados['confirmed'] = 0;

            $validator = Validator::make($request->all(), [
                'cd_saler' => 'required',
                'total' => 'required',
                'confirmed' => ''
            ]);
            
            $result = Sales::create([
                'cd_saler' => $arrDados['cd_saler'],
                'total' => (float)$arrDados['total'],
                'confirmed' => (int)$arrDados['confirmed']
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

    public function updateSale(Request $request){
        $arrDados = ( $request->all() );
        try {
            $validator = Validator::make($request->all(), [
                'cd_saler' => 'required',
                'total' => 'required',
                'confirmed' => 'required',
                'id' => 'required'
            ]);

            unset($arrDados['id']);

            $affectedRows = Sales::where('id', '=', $request->all('id') )->update( $arrDados );
            
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

    public function deleteSale(Request $request){
        $arrDados = ( $request->all() );
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required'
            ]);

            $affectedRows = Sales::where('id', '=', $request->all('id') )->delete();
            
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
