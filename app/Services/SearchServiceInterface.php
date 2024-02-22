<?php

namespace App\Services;

interface SearchServiceInterface
{
    public function search($text, $limit, $offset);
    public function getById($id);
    public function addToFavorites($id, $alias, $userId);
}
