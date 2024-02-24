<?php

namespace App\Repositories;

use App\Models\UserFavorites;

class UserFavoriteRepository implements UserFavoriteRepositoryInterface
{

    protected $model;
    public function __construct(UserFavorites $userFavorites)
    {
        $this->model= $userFavorites;
    }


    /**
     * @param array $data
     * @return mixed
     */
    public function addFavorite(array $data)
    {
        return UserFavorites::create($data);
    }
}
