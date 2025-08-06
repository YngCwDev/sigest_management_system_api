<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConsumableRequest;
use App\Http\Requests\UpdateConsumableRequest;
use App\Models\Consumable;
use App\Repositories\Interfaces\ConsumableRepositoryInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JsonException;
use Mockery\Expectation;
use Throwable;

class ConsumableController extends Controller
{

    protected $consumableRepo;

    public function __construct(ConsumableRepositoryInterface $consumableRepo)
    {
        $this->consumableRepo = $consumableRepo;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $consumables = $this->consumableRepo->list();
        return response()->json($consumables);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        try {
            $consumables = $this->consumableRepo->store(
                [
                    "name" => $request->name,
                    "description" => $request->description,
                    "stock" => $request->stock,
                    "unit" => $request->unit,
                    "expires_at" => $request->expires_at,
                    "entry_date" => $request->entry_date,
                    "last_date" => $request->last_date,
                    "category_id" => $request->category_id,
                    "supplier_id" => $request->supplier_id,
                ]
            );

        } catch (JsonException $e) {
            return new JsonResponse(data: ["massage" => "Something Went Wrong!"]);
        }
        return response()->json(["massage" => "Supply created Succefully!"], 200);
    }


    /**
     * Display the specified resource.
     */
    public function getAllSupplies()
    {

        try {
            return response()->json($this->consumableRepo->list(), 200);
        } catch (JsonException $e) {
            return response()->json(data: ["massage" => 'Something Went Wrong: $e']);
        }

    }

    public function getSupply($id)
    {

        try {
            return response()->json($this->consumableRepo->getById($id), 200);
        } catch (JsonException $e) {
            return response()->json(data: ["massage" => 'Something Went Wrong: $e']);
        }

    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateConsumableRequest $request, Consumable $consumable)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Consumable $consumable)
    {
        //
    }
}
