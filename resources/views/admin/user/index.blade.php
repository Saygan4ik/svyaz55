@extends('layouts.admin')

@section('content')

    <section id="users">
        <h1>Пользователи:</h1>
        <div class="users">
            @foreach($users as $user)
                <div class="users-item" id="user_id_{{ $user->id }}" onclick="javascript: goToUserPage({{$user->id}})">
                    <input type="hidden" name="user-id" value="{{ $user->id }}">
                    <span class="users-item-avatar-sm"><img src="/imagecache?src={{ $user->avatar }}" alt="user avatar">
                        <span class="users-item-avatar-lg"><img src="/imagecache?src={{ $user->avatar }}" alt="user avatar"></span>
                    </span>
                    <span>Name: {{ $user->name }}</span>
                    <span>Email: {{ $user->email }}</span>
                </div>
            @endforeach
        </div>
    </section>

@endsection

@section('script')

    <script type="text/javascript">
        function goToUserPage(data) {
            var url = "http://localhost:8000/user/" + data;
            window.location.href = url;
        }
    </script>

@endsection