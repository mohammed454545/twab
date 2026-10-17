<?php

namespace App\Services;

use App\Models\Diary;
use Illuminate\Support\Facades\Validator;

class DiaryService
{
    public function getAllDairies(array $filters = [])
    {
        $query = Diary::with('user:id,name,imageUrl');


        $query->when(
            isset($filters['user_id']),
            fn($query) => $query->where(
                'user_id',
                $filters['user_id']
            )
        );


        $perPage = $filters['per_page'] ?? 15;


        return $query
            ->latest()
            ->orderByDesc('id')
            ->paginate($perPage);
    }

    public function getDiaryById(int $id)
    {
        return Diary::with('user:id,name,imageUrl')->findOrFail($id);
    }

    public function createDiary(array $data)
    {
        $diary = Diary::create($data);
        $diary->load('user:id,name,imageUrl');

        return $diary;
    }

    public function updateDiary(int $id, array $data)
    {
        $diary = Diary::findOrFail($id);
        $diary->update($data);
        $diary->load('user:id,name,imageUrl');

        return $diary;
    }

    public function deleteDiary(int $id)
    {
        $diary = Diary::findOrFail($id);

        $diary->delete();

    }
}
