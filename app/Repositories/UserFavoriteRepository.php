<?php

namespace App\Repositories;

use App\Models\UserFavorites;

class UserFavoriteRepository implements UserFavoriteRepositoryInterface
{

    /**
     * @param array $data
     * @return void
     */
    public function addFavorite(array $data): void
    {
        UserFavorites::create($data);
    }
}
