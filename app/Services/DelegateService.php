<?php
namespace App\Services;

use App\Enums\UserableEnum;
use App\Jobs\CreateUserJob;
use App\Mail\SendPasswordMail;
use App\Models\Delegate;
use App\Models\DelegateSupervisor;
use App\Models\User;
use Arr;
use DB;
use GuzzleHttp\Promise\Create;
use Mail;

class DelegateService
{

  public function all($data = [], $paginated = true, $withes = [])
    {

       $query=User::where('userable_type',Delegate::class)->with('userable')->paginate(10);
       return $query;
    }

    public function store($data)
{
    DB::beginTransaction();
    try {

        $delegate = Delegate::create(Arr::only($data, ['name','phone']));

                $data['userable_type']=UserableEnum::Delegate->value;
                $data['userable_id']=$delegate->id;
                if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
                 $delegate->addMedia($data['image'])->toMediaCollection('image');
                }

        $data['password'] = bcrypt('password');
        $data['roles_name'] = $data['roles'] ?? [];
        $data['status'] = $data['status'] ?? 'active';

        $user=User::create(Arr::only($data,['email','name','password','userable_type','userable_id','roles_name','status']));
         if (isset($data['roles'])) {
                $user->syncRoles($data['roles']);
            }

        // إرسال البريد الإلكتروني بكلمة المرور
        Mail::to($data['email'])->send(new SendPasswordMail($user, $data['password']));
        logger('send email', ['password' => $data['password']]);

        DB::commit();
        return $user;

    } catch (\Exception $e) {
        DB::rollBack();
        logger('Delegate creation failed', ['error' => $e->getMessage()]);
        throw $e;
    }
}

   public function destroy($id)
   {

        $delegate = Delegate::withTrashed()->find($id);
   
        if ($delegate->deleted_at)
            $deleted = $delegate->restore();
        else
            $deleted = $delegate->delete();
        return $deleted;
   }
   public function restore($id)
   {
       return Delegate::withTrashed()->find($id)->restore();
   }

}

