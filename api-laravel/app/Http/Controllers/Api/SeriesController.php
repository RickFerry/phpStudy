<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use App\Repositories\SeriesRepository;
use Illuminate\Http\JsonResponse;

class SeriesController extends Controller
{
    private SeriesRepository $repository;

    public function __construct(SeriesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(): JsonResponse
    {
        return response()->json(Series::all());
    }

    public function store(SeriesFormRequest $request): JsonResponse
    {
        return response()->json($this->repository->add($request), 201);
    }

    public function show(int $id): JsonResponse
    {
        $series = Series::with('seasons.episodes')->find($id);
        if (is_null($series)) {
            return response()->json('', 404);
        }
        return response()->json($series);
    }

    public function update(SeriesFormRequest $request, Series $series): JsonResponse
    {
        $series->fill($request->all());
        $series->save();
        return response()->json($series);
    }

    public function destroy(int $id): JsonResponse
    {
        Series::destroy($id);
        return response()->json([], 204);
    }
}
