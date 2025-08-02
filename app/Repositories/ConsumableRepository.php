<?php

namespace App\Repositories;

use App\Models\Consumable;
use App\Repositories\Interfaces\ConsumableRepositoryInterface;

class ConsumableRepository implements ConsumableRepositoryInterface
{

    public function list()
    {
        return Consumable::all();
    }
    public function getById($id)
    {
        return Consumable::findOrFail($id);
    }
    public function store(array $data)
    {
        return Consumable::create($data);
    }
    public function update(array $data, $id)
    {
        return Consumable::where('id','=',$id)->update($data);
    }
    public function delete($id)
    {
        return Consumable::destroy($id);
    }

}
