<?php

namespace App\Repositories;

use App\Models\Supplier;
use App\Repositories\Interfaces\SupplierRepositoryInterface;

class RolesRepository implements SupplierRepositoryInterface
{


    public function list()
    {
        return Supplier::all();
    }
    public function getById($id)
    {
        return Supplier::findOrFail($id);
    }
    public function store(array $data)
    {
        return Supplier::create($data);
    }
    public function update(array $data, $id)
    {
        return Supplier::where('id','=',$id)->update($data);
    }
    public function delete($id)
    {
        return Supplier::destroy($id);
    }

}
