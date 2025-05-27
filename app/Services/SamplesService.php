<?php
namespace App\Services;

use App\Enums\UserableEnum;
use App\Models\Company;
use App\Models\DelegateSupervisor;
use App\Models\Sample;
use App\Models\User;
use App\Models\Visti;
use Arr;
use Storage;

class SamplesService
{

    public function all($data = [])
   {

    $query = Sample::when(isset($data['search']), function ($query) use ($data) {
        return $query->whereHas('translations', function ($q) use ($data) {
            $q->where('name', 'like', "%{$data['search']}%")
              ->orWhere('description', 'like', "%{$data['search']}%");
        });
    })->when(isset($data['company_id']), function ($query) use ($data) {
        return $query->where('company_id', $data['company_id']);
    });

    return $query->get();




    }

   public function store($data)
   {

       $sample=Sample::create(Arr::except($data, ['image']));

        if (isset($data['image'])) {
            $image = $data['image'];
            $path = $image->store("samples/{$sample->id}", 'public');
            $sample->update(['image' => $path]);

        }
       return $sample;
   }
   public function update($data, $id)
   {
       $sample = Sample::findOrFail($id);

      
       $updateData = Arr::except($data, ['image']);

       if (!empty($data['image'])) {
           if ($sample->image && Storage::disk('public')->exists($sample->image)) {
               Storage::disk('public')->delete($sample->image);
           }


           $image = $data['image'];
           $path = $image->store("samples/{$sample->id}", 'public');
           $updateData['image'] = $path;
       }

       // تنفيذ التحديث دفعة واحدة
       $sample->update($updateData);

       return $sample;
   }


}

