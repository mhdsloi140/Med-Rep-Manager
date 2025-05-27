<?php
namespace App\Services;

use App\Enums\UserableEnum;
use App\Models\Company;
use App\Models\DelegateSupervisor;
use App\Models\User;
use App\Models\Visti;
use Arr;

class CompanyService
{

    public function all($data = [], $paginated = true, $withes = [])
   {

       $query=Visti::paginate(10);
       return $query;





    }

   public function store($data)
   {
       $company=Company::create($data);
       return $company;
   }

   public function update($data,$id)
   {
       $company=Company::findOrFail($id);
       $company->update($data);
       return $company;
   }


}

