<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use App;

class CategoryRepository extends BaseRepository
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
        return Category::class;
    }

}