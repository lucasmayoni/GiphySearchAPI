<?php

namespace App\Http\Controllers;

use App\Repositories\AuditLogRepository;
use App\Repositories\AuditLogRepositoryInterface;
use App\Repositories\UserFavoriteRepository;
use App\Repositories\UserFavoriteRepositoryInterface;
use App\Services\SearchServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class SearchController extends Controller
{
    protected SearchServiceInterface $searchService;
    protected AuditLogRepository $auditLogRepository;

    protected UserFavoriteRepository $userFavoriteRepository;

    /**
     * @param SearchServiceInterface $searchService
     * @param AuditLogRepositoryInterface $auditLogRepository
     * @param UserFavoriteRepositoryInterface $userFavoriteRepository
     */
    public function __construct(
        SearchServiceInterface $searchService,
        AuditLogRepositoryInterface $auditLogRepository,
        UserFavoriteRepositoryInterface $userFavoriteRepository
    )
    {
        $this->searchService = $searchService;
        $this->auditLogRepository = $auditLogRepository;
        $this->userFavoriteRepository = $userFavoriteRepository;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request): JsonResponse
    {

        $validator = Validator::make($request->all(), [
            "text" => "required",
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $text = $request->input('text');
        $limit = $request->input('limit', 10);
        $offset = $request->input('offset', 0);

        $results = $this->searchService->search($text, $limit, $offset);

        $this->auditLogRepository->createLog($this->auditLogBuilder($request, $results));
        return response()->json($results['data'],  $results['response_code']);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function searchById(Request $request): JsonResponse {
        $request->merge(['id'=> $request->route('id')]);
        $validator = Validator::make($request->all(), [
            "id" => "required",
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $results = $this->searchService->getById($request->route('id'));
        $this->auditLogRepository->createLog($this->auditLogBuilder($request, $results));
        return response()->json($results['data'],  $results['response_code']);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function addToFavorites(Request $request): JsonResponse{
        $validator = Validator::make($request->all(), [
            "id" => "required",
            "alias" => "required"
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $id = $request->input('id');
        $alias = $request->input('alias');
        try {
            $data = [
                'user_id' => $request->user()->id,
                'alias' => $alias,
                'gif_id' => $id
            ];
            $this->userFavoriteRepository->addFavorite($data);
            $results = [
                'success' => true,
                'data' => 'Favorite Added Successfully ',
                'response_code' => 201
            ];
        }catch (\Exception $ex) {
            $results = [
                'success' => false,
                'data' => $ex->getMessage(),
                'response_code' => $ex->getCode()
            ];
        }

        $this->auditLogRepository->createLog($this->auditLogBuilder($request, $results));
        return response()->json(['success'=>$results['success']], $results['response_code']);
    }

    /**
     * @param Request $request
     * @param array $results
     * @return array
     */
    private function auditLogBuilder(Request $request, array $results):array {
        return [
            'user_id'=>$request->user()->id,
            'service_url' => $request->fullUrl(),
            'request_body' => json_encode($request->query()),
            'response_body'=> json_encode($results['data']),
            'response_code' => $results['response_code'],
            'request_source_ip' => $request->ip()
        ];
    }
}
