<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use App;

class UserRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'email'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return User::class;
    }

    public function searchByEmail($email) {
        return User::where('email', '=', $email)->first();
    }
}