<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRolesRequest;
use App\Http\Requests\UpdateRolesRequest;
use App\Models\Roles;
use App\Repositories\Interfaces\RolesRepositoryInterface;
use Illuminate\Http\JsonResponse;
use JsonException;

class RolesController extends Controller
{
    protected $roleRepo;

    public function __construct(RolesRepositoryInterface $roleRepo)
    {
        $this->roleRepo = $roleRepo;
    }



    /**
     * Display a listing of the resource.
     */
    public function getAllSupplies()
    {

        try {
            return response()->json($this->roleRepo->list(), 200);
        } catch (JsonException $e) {
            return new JsonResponse(data: ["massage" => "Error Processing Request!"]);
        }

    }

    public function getSupply($id)
    {

        try {
            return response()->json($this->roleRepo->getById($id), 200);
        } catch (JsonException $e) {
            return new JsonResponse(data: ["massage" => "Error Processing Request!"]);
        }

    }


    public function createSupply(StoreRolesRequest $request)
    {
        try {
            $supplies = $this->roleRepo->store(
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

            return response()->json(["massage" => "Supply created Succefully!"], 200);

        } catch (JsonException $e) {
            return new JsonResponse(data: ["massage" => "Error Processing Request!"]);
        }
    }



    public function updateSupply(UpdateRolesRequest $request, $id)
    {

        try {

            $role = $this->roleRepo->getById($id);
            $role->update($request->only($role->getFillable()));
            return response()->json($role, 200);

        } catch (JsonException $e) {

            return new JsonResponse(data: ["massage" => "Error Processing Request!"]);

        }
    }

    public function destroySupply($id)
    {
        try {
            $this->roleRepo->delete($id);
            return response()->json(["massage" => "Supply deleted Succefully!"], 200);
        } catch (JsonException $e) {
            return response()->json(["massage" => 'Something Went Wrong: $e']);

        }
    }
}
