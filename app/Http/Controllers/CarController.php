<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use Exception;

class CarController extends Controller
{
    public function show(Car $car) {
        return response()->json($car,200);
    }

    public function search(Request $request) {
        $request->validate(['key'=>'string|required']);

        $cars = Car::where('model','like',"%$request->key%")
            ->orWhere('description','like',"%$request->key%")->get();

        return response()->json($cars, 200);
    }

    public function store(Request $request) {
        $request->validate([
            'brand' => 'string|required',
            'model' => 'string|required',
            'type' => 'string|required',
            'price' => 'numeric|required',
            'acquired_on' => 'date|required',
        ]);

        try {
            $car = Car::create($request->all());
            return response()->json($car, 202);
        }catch(Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage()
            ],500);
        }

    }

    public function update(Request $request, Car $car) {
        try {
            $car->update($request->all());
            return response()->json($car, 202);
        }catch(Exception $ex) {
            return response()->json(['message'=>$ex->getMessage()], 500);
        }
    }

    public function destroy(Car $car) {
        $car->delete();
        return response()->json(['message'=>'Car deleted.'],202);
    }

    public function index() {
        $cars = Car::orderBy('brand')->get();
        return response()->json($cars, 200);
    }
}
