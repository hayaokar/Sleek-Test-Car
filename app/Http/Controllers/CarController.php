<?php

namespace App\Http\Controllers;


use App\Events\CarUpdates;
use App\Http\Requests\StoreCar;
use App\Http\Resources\CarsResource;
use App\Models\Car;
use App\Traits\HttpResponses;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Pusher\Pusher;

class CarController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CarsResource::collection(Car::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCar $request)
    {

        $car = Car::create($request->validated());

        $options = array(
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'encrypted' => true
        );
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $pusher->trigger('cars', 'App\Events\CarUpdates', $car);
        return new CarsResource($car);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {

            $car = Car::findorfail($id);
            return new CarsResource($car);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Car not found',
            ], 404);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {

            $car = Car::findorfail($id);
            $car->update($request->all());
            $options = array(
                'cluster' => 'us2',
                'encrypted' => true
            );
            $pusher = new Pusher(
                env('PUSHER_APP_KEY'),
                env('PUSHER_APP_SECRET'),
                env('PUSHER_APP_ID'),
                $options
            );

            $pusher->trigger('cars', 'App\Events\CarUpdates', $car);
            return new CarsResource($car);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Car not found',
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {

            Car::findorfail($id)->delete();
            return $this->success('','Car has been deleted!');

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Car not found',
            ], 404);
        }
    }
}
