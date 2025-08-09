<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Repositories\Interfaces\DepartmentRepositoryInterface;
use Exception;

class DepartmentController extends Controller
{
    protected $departmentRepo;

    public function __construct(DepartmentRepositoryInterface $departmentRepo)
    {
        $this->departmentRepo = $departmentRepo;
    }

    /**
     * Display a listing of the resource.
     */

    public function getAllDepartments()
    {
        try {

            return response()->json(
                $this->departmentRepo->list(),
                200
            );
        } catch (Exception $th) {
            return response()->json(["message" => "Error Processing Request!"], 500);
        }
    }

    /**
     * Display a single resource.
     */


    public function getDepartment($id)
    {
        try {

            return response()->json(
                $this->departmentRepo->getById($id),
                200
            );
        } catch (Exception $th) {
            return response()->json(["message" => "Error Processing Request!"], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */


    public function createDepartment(StoreDepartmentRequest $request)
    {
        try {

            return response()->json(
                $this->departmentRepo->store(
                    [
                        "name" => $request->name,
                        "prority" => $request->priority,
                        "description" => $request->description
                    ]
                ),
                200
            );
        } catch (Exception $th) {
            return response()->json(["message" => "Error Processing Request!"], 500);
        }
    }



    /** 
     * Update the specified resource in storage.
     */


    public function updateDepartment(UpdateDepartmentRequest $request, $id)
    {
        try {
            $department = $this->departmentRepo->getById($id);
            $department->update($request->only($department->getFillable()));
            return response()->json(
                $department,
                200
            );
        } catch (Exception $th) {
            return response()->json(["message" => "Error Processing Request!"], 500);
        }
    }



    /**
     * Remove the specified resource from storage.
     */

    public function destroyDepartment($id)
    {

        try {
            $this->departmentRepo->delete($id);
            return response()->json(["message" => "Deleted Successfuly"], 200);
        } catch (Exception $e) {
            return response()->json(
                ["message" => "Error Processing Request!"],
                500
            );
        }
    }
}
