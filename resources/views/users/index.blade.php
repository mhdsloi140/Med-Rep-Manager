
@extends('layouts.app')
@section('title', 'User List')


@section('content')



@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="d-flex justify-content-end">
    <a href="{{ route('users.create') }}" class="btn btn-primary">{{ __('locale.create') }}</a>
</div>

            <div class="card-body">
                <div class="row mb-3 admins-div">
                    <div class="col-md-12">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('locale.id') }}</th>

                                    <th scope="col">{{ __('locale.name') }}</th>
                                    <th scope="col">{{ __('locale.email') }}</th>

                                    <th scope="col">{{ __('locale.phone') }}</th>
                                     <th scope="col">{{ __('locale.user_type') }}</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <th scope="row">{{ $user->id }}</th>

                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email  }}</td>
                                        <td >{{ $user->userable->phone }}</td>
                                        <td>{{App\Enums\UserableEnum::tryFrom($user->userable_type)?->name ?? 'غير معروف' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>



            </script>

    @endsection
