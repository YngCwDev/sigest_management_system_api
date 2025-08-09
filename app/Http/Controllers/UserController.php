<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{

    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
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


