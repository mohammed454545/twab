<?php
namespace App\Services;
use App\Models\Diary;
use Illuminate\Support\Facades\Validator;


class DiaryService
{
    public function getAllDairies()
    {
        return Diary::query()->paginate(15);
    }

    public function getDiaryById($id)
    {
        return Diary::findOrFail($id);
    }

    public function createDiary ( array $data)
    {
        $validator=Validator::make($data,[
            'title'=>'nullable|string',
            'description'=>'nullable|string',
            'rate'=>'nullable|numeric|min:0|max:10'
        ]);
        
        $validated = $validator->validate();
        return Diary::create($validated);
    }


    public function updateDiary ($id, array $data)
    {
        $diary=Diary::findOrFail($id);
        $validator=Validator::make($data,[
            'title'=>'nullable|string',
            'description'=>'nullable|string',
            'rate'=>'nullable|numeric|min:0|max:10'
        ]);
        
        $validated = $validator->validate();
        $diary->update($validated);
        return $diary;
        
    }


    public function deleteDiary($id)
    {
        $diary=Diary::findOrFail($id);
        $diary->delete();
        return true;
    }
}