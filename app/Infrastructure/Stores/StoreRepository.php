<?php

namespace App\Infrastructure\Stores;

use App\Domain\Stores\StoreRepositoryInterface;
use App\Domain\Stores\Store;

class StoreRepository implements StoreRepositoryInterface
{
    public function all()
    {
        return Store::all();
    }

    public function find($id)
    {
        return Store::find($id);
    }

    public function create(array $data)
    {
        return Store::create($data);
    }

    public function update($id, array $data)
    {
        $store = Store::find($id);
        $store->update($data);
        return $store;
    }

    public function delete($id)
    {
        $store = Store::find($id);
        return $store->delete();
    }
}
