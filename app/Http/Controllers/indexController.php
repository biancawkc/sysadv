<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;

class IndexController extends Controller
{
    public function addItem(Request $request)
    {
        $rules = array(
                'desc_est_processo' => 'required|alpha_num',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::json(array(

                    'errors' => $validator->getMessageBag()->toArray(),
            ));
        } else {
            $data = new App\Models\EtapaProcesso();
            $data->desc_est_processo = $request->name;
            $data->save();

            return response()->json($data);
        }
    }
    public function readItems(Request $req)
    {
        $data  = \App\Models\EstadoProcesso::all();

        return view('usuario.welcome')->withData($data);
    }
    public function editItem(Request $req)
    {
        $data = Data::find($req->id_estado_processo);
        $data->desc_est_processo = $req->desc_est_processo;
        $data->save();

        return response()->json($data);
    }
    public function deleteItem(Request $req)
    {
        Data::find($req->id_estado_processo)->delete();

        return response()->json();
    }
}
