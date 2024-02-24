<?php

namespace Tests\Unit;

use App\Models\UserFavorites;
use App\Repositories\UserFavoriteRepository;
use Tests\TestCase;

class UserFavoritesUnitTest extends TestCase
{
    public function testUserFavoriteIsCreated()
    {
        $data = [
            'user_id' =>1,
            'alias' => 'un_alias',
            'gif_id' => 'ABC123'
        ];
        $repo = new UserFavoriteRepository(new UserFavorites());
        $created = $repo->addFavorite($data);
        $this->assertInstanceOf(UserFavorites::class, $created);
        $this->assertEquals($data['alias'], $created->alias);
    }
}
