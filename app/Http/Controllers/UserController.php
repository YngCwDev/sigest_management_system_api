<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use JsonException;

class UserController extends Controller
{

    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }



    /**
     * Display a listing of the resource.
     */
    public function getAllUsers()
    {

        try {
            return response()->json($this->userRepo->list(), 200);
        } catch (JsonException $e) {
            return new JsonResponse(data: ["massage" => "Error Processing Request!"]);
        }

    }

    public function getUser($id)
    {

        try {
            return response()->json($this->userRepo->getById($id), 200);
        } catch (JsonException $e) {
            return response()->json(
                ["message" => "Error Processing Request!"],
                500
            );
        }

    }


    public function registeUser(StoreUserRequest $request)
    {
        try {
            $user = $this->userRepo->store(
                [
                    'username' => $request->username,
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'password' => $request->password,
                    'department_id' => $request->department_id,
                    'role_id' => $request->role_id,
                    'priority' => $request->priority
                ]
            );
            return response()->json(["massage" => "Supply created Succefully!"], 200);

        } catch (JsonException $e) {
            return response()->json(
                ["message" => "Error Processing Request!"],
                500
            );
        }
    }



    public function updateUser(UpdateUserRequest $request, $id)
    {

        try {

            $user = $this->userRepo->getById($id);
            $user->update($request->only($user->getFillable()));
            return response()->json($user, 200);

        } catch (JsonException $e) {

            return response()->json(
                ["message" => "Error Processing Request!"],
                500
            );
        }
    }

    public function destroyUser($id)
    {
        try {
            $this->userRepo->delete($id);
            return response()->json(["message" => "Deleted Successfuly"], 200);
        } catch (Exception $e) {
            return response()->json(
                ["message" => "Error Processing Request!"],
                500
            );
        }

    }
}


