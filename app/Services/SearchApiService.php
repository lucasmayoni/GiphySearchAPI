<?php

namespace App\Services;

use League\Uri\Http;

class SearchApiService implements SearchServiceInterface
{

    /*
     * https://api.giphy.com/v1/gifs/search?
     * api_key=vnLdbCMTr7NQC621XJCJeMRcVNPCRYED&
     * q=mickey&
     * limit=25&
     * offset=0&rating=g&lang=en&bundle=messaging_non_clips
     * */
    public function search($text, $limit, $offset)
    {
        // TODO: Implement search() method.
        $response = \Illuminate\Support\Facades\Http::get(
            'https://api.giphy.com/v1/gifs/search',
            ['api_key'=>"vnLdbCMTr7NQC621XJCJeMRcVNPCRYED",
                "q"=>$text,
                "limit" => $limit,
                "offset"=>$offset]
        );
        return $response->json();
    }

    public function getById($id)
    {
        // TODO: Implement getById() method.
    }

    public function addToFavorites($id, $alias, $userId)
    {
        // TODO: Implement addToFavorites() method.
    }
}
