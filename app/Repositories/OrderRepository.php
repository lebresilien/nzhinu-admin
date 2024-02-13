<?php

namespace App\Repositories;

use App\Models\Order;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use App;

class OrderRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'slug'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Order::class;
    }

}