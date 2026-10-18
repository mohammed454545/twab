<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexDiaryRequest;
use App\Http\Requests\StoreDiaryRequest;
use App\Http\Requests\UpdateDiaryRequest;
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

    public function index(IndexDiaryRequest $request)
    {
        // التحقق من الفلاتر والباجينيشن
        $filters = $request->validated();

        $diaries = $this->diaryService->getAllDairies(
            $filters
        );

        $message = $diaries->isEmpty()
    ? __('diaries.messages.empty')
    : __('diaries.success.listed');

        return $this->successResponse(
            (new DiaryCollection($diaries))->toArray($request),
            200,
            $message
        );
    }

    public function show(Request $request, int $id)
    {
        $diary = $this->diaryService->getDiaryById($id);

        return $this->successResponse(
            (new DiaryResource($diary))->resolve($request),
            200,
            __('diaries.success.retrieved')
        );
    }

    public function store(StoreDiaryRequest $request)
    {
        $diary = $this->diaryService->createDiary(
            $request->validated(),
            (int) $request->user('api')->getAuthIdentifier()
        );

        return $this->successResponse(
            (new DiaryResource($diary))->resolve($request),
            201,
            __('diaries.success.created')
        );
    }

    public function update(UpdateDiaryRequest $request,int $id)
    {
        $diary = $this->diaryService->updateDiary(
            $id,
            $request->validated()
        );

        return $this->successResponse(
            (new DiaryResource($diary))->resolve($request),
            200,
            __('diaries.success.updated')
        );
    }

    public function destroy(int $id)
    {
        $this->diaryService->deleteDiary($id);

        return response()->noContent();
    }
}