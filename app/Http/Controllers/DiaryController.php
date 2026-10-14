<?php

namespace App\Http\Controllers;

use App\Http\Resources\DiaryCollection;
use App\Http\Resources\DiaryResource;
use App\Http\Traits\ApiResponserTrait;
use App\Services\DiaryService;
use Illuminate\Http\Request;

class DiaryController extends Controller
{
    use ApiResponserTrait;

    public function __construct(
        protected DiaryService $diaryService
    ) {}

    public function index(Request $request)
    {
        $diaries = $this->diaryService->getAllDairies();

        return $this->successResponse(
            (new DiaryCollection($diaries))->toArray($request),
            200,
            __('diaries.success.listed')
        );
    }

    public function show(Request $request, $id)
    {
        $diary = $this->diaryService->getDiaryById($id);

        return $this->successResponse(
            (new DiaryResource($diary))->resolve($request),
            200,
            __('diaries.success.retrieved')
        );
    }

    public function store(Request $request)
    {
        $diary = $this->diaryService->createDiary(
            $request->all()
        );

        return $this->successResponse(
            (new DiaryResource($diary))->resolve($request),
            201,
            __('diaries.success.created')
        );
    }

    public function update(Request $request, $id)
    {
        $diary = $this->diaryService->updateDiary(
            $id,
            $request->all()
        );

        return $this->successResponse(
            (new DiaryResource($diary))->resolve($request),
            200,
            __('diaries.success.updated')
        );
    }

    public function destroy($id)
    {
        $this->diaryService->deleteDiary($id);

        return response()->noContent();
    }
}