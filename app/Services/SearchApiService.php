<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;


class SearchApiService implements SearchServiceInterface
{

    protected $base_url;
    protected $api_key;

    /**
     * @param string $base_url
     */
    public function __construct(string $base_url, string $api_key)
    {
        $this->base_url = $base_url;
        $this->api_key  = $api_key;
    }

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
                    "api_key" => $this->api_key,
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
                'response_code' => 404,
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
                    "api_key"=>$this->api_key
                ]
            );
            $response = [
                'data' => $queryResponse->json(),
                'success' => true,
                'response_code' => $queryResponse->status()
            ];
        } catch (\Exception $ex) {
            $response = [
                'response_code' => 404,
                'data' => [],
                'success'=>false,
                'errors' => $ex->getMessage()
            ];
        }
        return $response;
    }
}
