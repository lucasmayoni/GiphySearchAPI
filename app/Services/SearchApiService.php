<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;


class SearchApiService implements SearchServiceInterface
{

    public string $base_url = 'https://api.giphy.com/v1/gifs/';

    /**
     * @param $text
     * @param $limit
     * @param $offset
     * @return array
     */
    public function search($text, $limit, $offset): array
    {
        try {
            $queryResponse = Http::get($this->base_url . 'search',
                [
                    "api_key" => "vnLdbCMTr7NQC621XJCJeMRcVNPCRYED",
                    "q" => $text,
                    "limit" => $limit,
                    "offset" => $offset
                ]
            );
            $response = [
                'data' => $queryResponse->json(),
                'success' => true,
                'response_code' => $queryResponse->status()
            ];
        } catch (\Exception $ex) {
            $response = [
                'response_code' => $ex->getCode(),
                'data' => [],
                'success'=>false,
                'errors' => $ex->getMessage()
            ];
        }

        return $response;
    }

    /**
     * @param $id
     * @return array
     */
    public function getById($id): array
    {

        try {
            $queryResponse = Http::get($this->base_url.$id,
                [
                    "api_key"=>"vnLdbCMTr7NQC621XJCJeMRcVNPCRYED"
                ]
            );
            $response = [
                'data' => $queryResponse->json(),
                'success' => true,
                'response_code' => $queryResponse->status()
            ];
        } catch (\Exception $ex) {
            $response = [
                'response_code' => $ex->getCode(),
                'data' => [],
                'success'=>false,
                'errors' => $ex->getMessage()
            ];
        }
        return $response;
    }
}
