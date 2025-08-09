<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Category;
use App\Models\Order;
use App\Repositories\Interfaces\OrderItemsRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use Auth;
use Exception;
use Illuminate\Http\Response;

class OrderController extends Controller
{

    protected $orderRepo;
    protected $orderItemsRepo;

    public function __construct(OrderRepositoryInterface $order, OrderItemsRepositoryInterface $orderItemsRepo)
    {
        $this->orderRepo = $order;
        $this->orderItemsRepo = $orderItemsRepo;
    }

    /**
     * Display a listing of the resource.
     */
    public function getAllOrders()
    {
        return Response()->json(
            $this->orderRepo->list()
        );
    }

    /**
     * Display a single resource.
     */
    public function getOrder()
    {
        return Response()->json(
            $this->orderRepo->list()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function createOrder(StoreOrderRequest $request)
    {
        try {

            $order = $this->orderRepo->store([
                "user_id" => auth()->id(),
                'department_id' => $request->department_id,
                'description' => $request->description,
                'priority' => $request->priority,
                'status' => $request->status,
            ]);

            foreach ($request->orderItems as $item) {

                $this->orderItemsRepo->store(
                    [
                        "order_id" => $order->id,
                        "supply_id" => $item["supply_id"],
                        "quantity" => $item["quantity"]
                    ]
                );

            }

        } catch (Exception $th) {
            return response()->json(["message" => 'Error Processing Request!' . $th], 500);
        }
    }

    /** 
     * Update the specified resource in storage.
     */
    public function updateOrder(UpdateOrderRequest $request, $id)
    {
        $order = $this->orderRepo->update(
            $request->only(new Category()->getFillable()),
            $id
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
