@extends('layouts.app')

@section('title', __('locale.create_role'))

@section('content')
<div class="container">
    <h2>إنشاء دور جديد</h2>

    @if(session('success'))
        <div style="color: green">{{ session('success') }}</div>
    @endif

    <form action="{{ route('roles.store') }}" method="POST">
        @csrf

        <div>
            <label> {{ __('locale.role_name') }}</label>
            <input type="text" name="name" required>
        </div>

        <div>
            <label>{{ __('locale.permissions') }}</label><br>
            @foreach($permissions as $permission)
                <label>
                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}">
                    {{ $permission->name }}
                </label><br>
            @endforeach
        </div>

        <button type="submit">إنشاء</button>
    </form>
</div>
@endsection
