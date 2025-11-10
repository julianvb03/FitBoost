<?php

namespace App\Http\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SupplementDetailResource;
use App\Http\Resources\SupplementSummaryResource;
use App\Models\Supplement;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SupplementApiController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $perPage = (int) $request->input('per_page', 15);
        $perPage = $perPage > 0 ? min($perPage, 50) : 15;

        $supplements = Supplement::query()
            ->select(['id', 'name'])
            ->orderBy('name')
            ->paginate($perPage)
            ->appends($request->query());

        return SupplementSummaryResource::collection($supplements)
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    public function show(Supplement $supplement): JsonResponse
    {
        $supplement->withoutRelations();

        return (new SupplementDetailResource($supplement))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }
}
