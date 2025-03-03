<?php

namespace App\Http\Controllers\Modulo\Configuraciones;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class ClienteController extends Controller
{
    //
    public function lista(){
        return view('modulos.configuraciones.clientes.lista', get_defined_vars());
    }
    public function listar(){
        $data     = Customer::get();
        //$tipo_cambio = TipoCambio::orderBy('name', 'desc')->first();
        return DataTables::of($data)
            ->addColumn('habilitado', function ($data) {

                $color = ($data->estado == 1 ? 'success' : 'danger');
                $texto = ($data->estado == 1 ? 'Activo' : 'Inactivo');
                return
                '<span class="badge bg-'.$color.' badge-sm  me-1 mb-1 mt-1">'.$texto.'

                </span>';
            })->addColumn('accion', function ($data) {
                return
                '<div class="flex align-items-center list-user-action" >
                    <a href="#" class="btn btn-icon btn-sm ver"  data-id="' . $data->user_id . '" ><i class="fa fa-eye"></i></a>
                    <a href="#" class="btn btn-icon btn-sm editar"  data-id="' . $data->user_id . '" ><i class="fa fa-pencil"></i>
                    </a>
                    <a href="#" class="btn btn-icon btn-sm eliminar"  data-id="' . $data->user_id . '" ><i class="fa fa-trash"></i>
                    </a>

                </div>';
        })->rawColumns(['accion','habilitado'])->make(true);
    }
    public function guardar(Request $request){
        $user = User::firstOrNew([
            'email' => $request->email
        ]);
        $user->name = $request->apellidos . ' ' . $request->nombres;
        $user->email = $request->email;
        if($request->password){
            $user->password = Hash::make($request->password) ;
        }

        $user->save();

        $customer = Customer::firstOrNew(
            ['user_id' => $user->id],
            ['estado' => 1],
        );
        $customer->numero_documento = $request->numero_documento;
        $customer->nombres = $request->nombres;
        $customer->apellidos = $request->apellidos;
        $customer->email = $request->email;
        $customer->user_id = $user->id;
        $customer->save();

        return response()->json([
            "status"=>true,
            "titulo"=>"Éxito",
            "mensaje"=>"Se registor con éxito",
            "icon"=>"success",
        ],200);
    }
    public function editar($id) {
        $user = User::find($id);
        if(!$user){
            return response()->json([
                // "data"=>$id,
                "status"=>"error",
            ],200);
        }
        $customer = Customer::where('user_id',$user->id)->first();
        if(!$customer){
            return response()->json([
                // "data"=>$id,
                "status"=>"error",
            ],200);
        }
        return response()->json([
            "usuario"=>$user,
            "cliente"=>$customer,
            "status"=>"success",
        ],200);
    }
    public function eliminar($id) {
        $user = User::find($id);
        $user->estado = 2;
        $user->save();

        $customer = Customer::where('user_id',$user->id)->first();
        $customer->estado = 2;
        $customer->save();
        return response()->json([
            "usuario"=>$id,
            "status"=>true,
        ],200);
    }
}
