<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function getAll()  {
        $service = Service::all();

        if ($service->isEmpty()) {
            return response()->json(['error' => 'Nenhum registro encontrado'], 404);
        }
        
        return response()->json($service);
    }

    public function getById($id) {

        $service = Service::find($id);
        if (!$service) {
            return response()->json(['error' => 'Registro não encontrado'], 404);
        }

        return response()->json($service); 
    }

    public function insert(Request $request)  {

        $service = new Service();
        $data = $request->all(); 

        $this->validate($request, $service->getRules());
        $service = Service::create($data);

        return response()->json(['id' => $service->id], 200);
        
    }

    public function update(Request $request, $id)  {

        $service = Service::find($id);

        if (!$service) {
            return response()->json(['error' => 'Registro não encontrado'], 404);
        }

        $data = $request->all();

        $this->validate($request, $service->getRules());

        $service->update($data);

        return response()->json(['message' => 'Registro atualizado com sucesso'], 200);

    }

    public function delete($id)  {
        
        $service = Service::find($id);

        if (!$service) {
            return response()->json(['error' => 'Registro não encontrado'], 404);
        }


        $service->update(['deleted' => true]);
        return response()->json(['message' => 'Registro excluído com sucesso'], 200);

    }

}
