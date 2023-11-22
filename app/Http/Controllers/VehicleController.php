<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function getAll()  {
        $vehicle = Vehicle::all();

        if ($vehicle->isEmpty()) {
            return response()->json(['error' => 'Nenhum registro encontrado'], 404);
        }
        
        return response()->json($vehicle);
    }

    public function getById($id) {

        $vehicle = Vehicle::find($id);
        if (!$vehicle) {
            return response()->json(['error' => 'Registro não encontrado'], 404);
        }

        return response()->json($vehicle); 
    }

    public function insert(Request $request)  {

        $vehicle = new Vehicle();
        $data = $request->all(); 

        $this->validate($request, $vehicle->getRules());
        $vehicle = Vehicle::create($data);

        return response()->json(['id' => $vehicle->id], 200);
        
    }

    public function update(Request $request, $id)  {

        $vehicle = Vehicle::find($id);

        if (!$vehicle) {
            return response()->json(['error' => 'Registro não encontrado'], 404);
        }

        $data = $request->all();

        $this->validate($request, $vehicle->getRules());
        $vehicle->update($data);

        return response()->json(['message' => 'Registro atualizado com sucesso'], 200);

    }

    public function delete($id)  {
        
        $vehicle = Vehicle::find($id);

        if (!$vehicle) {
            return response()->json(['error' => 'Registro não encontrado'], 404);
        }


        $vehicle->update(['deleted' => true]);
        return response()->json(['message' => 'Registro excluído com sucesso'], 200);

    }
}
