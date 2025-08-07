<?php

namespace App\Repositories;

use App\Models\Supply;
use App\Repositories\Interfaces\SupplyRepositoryInterface;

class SupplyRepository implements SupplyRepositoryInterface
{

    public function list()
    {
        return Supply::all();
    }
    public function getById($id)
    {
        return Supply::findOrFail($id);
    }
    public function store(array $data)
    {
        return Supply::create($data);
    }
    public function update(array $data, $id)
    {
        return Supply::where('id','=',$id)->update($data);
    }
    public function delete($id)
    {
        return Supply::destroy($id);
    }

}
