<?php
namespace App\Services;

use App\Enums\UserableEnum;
use App\Models\Comment;
use App\Models\Company;
use App\Models\DelegateSupervisor;
use App\Models\DoctorComment;
use App\Models\Region;
use App\Models\Sample;
use App\Models\User;
use App\Models\Visti;
use Arr;


class CommentService
{

    public function all($data = [], $paginated = true, $withes = [])
    {
      
    }

    public function store($data)
    { 
        $comment=DoctorComment::create($data);
        return $comment;

        
    }
    public function update($data, $id)
    {


    }


}

