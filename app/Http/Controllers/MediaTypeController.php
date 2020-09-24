<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\MediaType;
use App\Http\Controllers\make;
use Illuminate\Validation\Validator as ValidationValidator;

class MediaTypeController extends Controller
{
    public function showmas(){
        return view('mediaTypes.insert_mas');
    }

    public function storemas(Request $r){

        //media types repetidos

        $repetidos = [];

        //reglas de validacion

        $reglas = [
            'mediaTypes' => 'required|mimes:csv,txt'
        ];

        $mensajes = [
            'mimes' => 'tipo de archivo no correspondiente',
            'required' => 'debes subir el archivo'
        ];

        //Realizar validacion

        $vr = Validator::make($r->all(),$reglas,$mensajes);

        if($vr->fails()){
            return redirect('media-types/insert')->with("errors",$vr->errors());
        }else{
        //trasadar el proyecto para guardar una copia
        $r->file('mediaTypes')->storeAs("media-types",$r->file('mediaTypes')->getClientOriginalName());
        //abrir el archivo a para la letura
        $rut = base_path()."\\storage\\app\\media-types\\".$r->file('mediaTypes')->getClientOriginalName();
        
        if(($puntero = fopen($rut,'r')) != false){
            //recorrer el archivo
            $contador = 0;
            $contador_errors = 0;
            $tabla = array(
                "Nombre" => array(

                ),
                "Va" => array(

                )
            );
            while(($linea = fgetcsv($puntero,100,',')) != false) { 
                
                $conteo = MediaType::where('Name', $linea[0])->get()->count();
                if($conteo == 0){
                    $mediatype = new MediaType();
                    $mediatype->Name = $linea[0];
                    $tabla["Nombre"][$contador] = $linea[0];
                    $mediatype->save();
                }else{
                    $repetidos[] = $linea[0]; 
                    $contador_errors++;
                }

                $contador ++;
            }
            $archivos_c = $contador - $contador_errors;

            if($archivos_c == 0){
                $mes = "carga masiva no realizada $contador archivos ya existentes";
                return redirect('media-types/insert')->with("exito", $mes)->with("repetidos",$repetidos);
            }else{            
                $mes = "carga masiva realizada, se cargaron $archivos_c / $contador archivos no existentes";
                return redirect('media-types/insert')->with("exito", $mes)->with("repetidos",$repetidos);
            }

        }else{
            return redirect('media-types/insert')->with("errors","Algo salio mal");
        }

        }
        
    }

}