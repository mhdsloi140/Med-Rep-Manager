@extends('layouts.app')
@section('title', 'Admin List')
{{-- @section('script')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>

<script>
  Pusher.logToConsole = true;

  const pusher = new Pusher('b059361fe37c6e8f86dd', {
    cluster: 'mt1',
    encrypted: true
  });

  const channel = pusher.subscribe('my-channel');

  channel.bind('MyEvent', function(data) {
    console.log("📥 حدث جديد من Pusher:", data);
    alert(data); // أو أي تعامل مع البيانات
  });
</script>
@endsection --}}

@section('content')



@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="d-flex justify-content-end">
    <a href="{{ route('admin.create') }}" class="btn btn-primary">{{ __('locale.create') }}</a>
</div>

            <div class="card-body">
                <div class="row mb-3 admins-div">
                    <div class="col-md-12">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('locale.id') }}</th>
                                    <th scope="col">{{ __('locale.image') }}</</th>
                                    <th scope="col">{{ __('locale.name') }}</th>

                                    <th scope="col">{{ __('locale.email') }}</</th>
                                    <th scope="col">{{ __('locale.phone') }}</</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admins as $admin)
                                    <tr>
                                        <th scope="row">{{ $admin->id }}</th>

                                        <td>{{ $admin->name }}</td>
                                        <td>{{ $admin->email  }}</td>
                                        <td >{{ $admin->userable->phone }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>



            </script>

    @endsection
