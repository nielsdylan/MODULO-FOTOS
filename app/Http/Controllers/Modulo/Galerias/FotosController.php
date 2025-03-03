<?php

namespace App\Http\Controllers\Modulo\Galerias;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FotosController extends Controller
{
    //
    public function lista(){
        $albumes = Album::where('usuario_id', Auth::user()->id)->get();

        $galeria = Image::where('user_id',Auth::user()->id)->get();
        return view('modulos.galerias.fotos.lista', get_defined_vars());
    }

    public function guardarFotos(Request $request){

        // $imagenes = new Image();
        // $imagenes->save();
        // return Auth::user();
        $imagenes = $request->fotos;
        // return $imagenes;
        if($imagenes){
            // return $imagenes;
            foreach ($imagenes as $key => $value) {

                $description = '-';
                if(array_key_exists($key, $request->descripcion)){
                    $description = ($request->descripcion[$key]?$request->descripcion[$key]:' ');
                }
                $titulo = '-';
                if(array_key_exists($key, $request->titulo)){
                    $titulo = ($request->titulo[$key]?$request->titulo[$key]:' ');
                }

                $imageName  = time(). '_' . uniqid().'.' . $value->extension();
                $name       = $value->getClientOriginalName();
                $weight     = $value->getSize();
                $extencion  = $value->extension();
                $path       = 'images/'.Auth::user()->id . '/'.$imageName;
                $value->move(public_path('images/'.Auth::user()->id), $imageName);

                $save = new Image();
                $save->name         = $name;
                $save->titulo       = $titulo;
                $save->description  = $description;
                $save->name_image   = $imageName;
                $save->weight       = $weight;
                $save->path         = $path;
                $save->extension    = $extencion;
                $save->user_id      = Auth::user()->id ;
                $save->album_id     = $request->album_id;
                $save->save();

            }
            return response()->json(["title"=>"Éxito","message"=>"Se guardo con éxito", "type"=>"success", "estado"=>true],200);
        }

        return response()->json(["title"=>"Alerta","message"=>"Ingrese una imagen como minimo.", "type"=>"warning", "estado"=>true],200);
    }
}
