@extends('layouts.app')

@section('content')
<div class="container">
    <h2>إسناد دور وصلاحية لمستخدم</h2>

    @if(session('success'))
        <div style="color: green">{{ session('success') }}</div>
    @endif

    <form action="{{ route('users.assign.role.store') }}" method="POST">
        @csrf

        <div>
            <label>اختر المستخدم:</label>
            <select name="user_id"  id="user_id" required>
                <option value="">-- اختر --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>

        <div>
            <label>اختر الدور:</label>
          <select name="role" id="role" required>
            <option value="">-- اختر --</option>
            @foreach($roles as $role)
            <option value="{{ $role->id }}">{{ $role->name }}</option> {{-- ✅ القيمة يجب أن تكون ID --}}
            @endforeach
        </select>
        </div>

        <div>
            <label>اختر الصلاحية:</label>
            <select name="permission" id="permission">
                <option value="">-- اختياري --</option>
                @foreach($permissions as $permission)
                    <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit">إسناد</button>
    </form>
</div>
@endsection
