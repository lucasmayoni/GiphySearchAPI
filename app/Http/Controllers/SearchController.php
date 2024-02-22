<?php

namespace App\Http\Controllers;

use App\Services\SearchServiceInterface;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    protected $searchService;
    public function __construct(SearchServiceInterface $searchService){
        $this->searchService = $searchService;
    }
    public function index(): \Illuminate\Http\JsonResponse
    {
        $prueba = array(
            "name" => "TEST",
            "age" => 20
        );
        return response()->json($prueba);
    }

    public function search(Request $request): \Illuminate\Http\JsonResponse
    {
        $text = $request->input('text');
        $limit = $request->input('limit', 10); // Default limit is 10
        $offset = $request->input('offset', 0);

        $yourSearchResults = $this->searchService->search($text, $limit, $offset);

        return response()->json(['message' => 'Search endpoint', 'data' => $yourSearchResults]);
    }

    public function searchById(Request $request): \Illuminate\Http\JsonResponse {
        $response = $this->searchService->getById($request->route('id'));
        return response()->json(['message' => 'Search endpoint', 'data'=>$response]);
    }

    public function addToFavorites($id, $alias, $userId): void{
        $response = $this->searchService->addToFavorites($id, $alias, $userId);
        // return $response->json($response);
    }
}
