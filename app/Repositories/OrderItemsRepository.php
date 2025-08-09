<?php

namespace App\Repositories;

use App\Models\OrderItems;
use App\Repositories\Interfaces\OrderItemsRepositoryInterface;

class OrderItemsRepository implements OrderItemsRepositoryInterface
{

   
    public function list()
    {
        return OrderItems::all(); 
    }
    public function getById($id)
    {
        return OrderItems::findOrFail($id);
    }
    public function store(array $data)
    {
        return OrderItems::create($data);
    }
    public function update(array $data, $id)
    {
        return OrderItems::where('id','=',$id)->update($data);
    }
    public function delete($id)
    {
        return OrderItems::destroy($id);
    }

}
