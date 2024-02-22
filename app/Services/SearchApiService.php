<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;


class SearchApiService implements SearchServiceInterface
{

    public $base_url = 'https://api.giphy.com/v1/gifs/';

    /*
     * https://api.giphy.com/v1/gifs/search?
     * api_key=vnLdbCMTr7NQC621XJCJeMRcVNPCRYED&
     * q=mickey&
     * limit=25&
     * offset=0&rating=g&lang=en&bundle=messaging_non_clips
     * */
    public function search($text, $limit, $offset)
    {
        $response = Http::get($this->base_url.'search',
            [   "api_key"=>"vnLdbCMTr7NQC621XJCJeMRcVNPCRYED",
                "q"=>$text,
                "limit" => $limit,
                "offset"=>$offset
            ]
        );

        return $response->json();
    }

    public function getById($id)
    {
        $response = Http::get($this->base_url.$id,
            [   "api_key"=>"vnLdbCMTr7NQC621XJCJeMRcVNPCRYED"

            ]
        );
        return $response->json();
    }

    public function addToFavorites($id, $alias, $userId)
    {
        // TODO: Implement addToFavorites() method.
    }
}
