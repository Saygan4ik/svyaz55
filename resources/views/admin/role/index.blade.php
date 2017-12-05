@extends('layouts/admin')

@section('content')
    <section id="section_roles">
        <h1>Роли пользователей</h1>
        @if (Session::get('msg'))
            <div class="alert alert-info">
                <p>{{ Session::get('msg') }}</p>
            </div>
        @endif
        <a href="/role/create" class="btn btn-primary">Создать новую роль</a>
        @foreach($roles as $role)
            <div class="roles-item">
                <h3>{{ $role->name }}</h3>
                <div class="edit-button">
                    <a href="/role/{{ $role->slug }}/edit" class="fa fa-pencil-square-o"></a>
                </div>
                <div class="delete-button" onclick="event.preventDefault();
                                        if(confirm('Удаление роли: {{ $role->name }}! Вы уверены?')) {
                                        document.getElementById('delete-form-{{ $role->id }}').submit(); };">
                    <form id="delete-form-{{ $role->id }}" action="{{ action('RoleController@destroy', ['id' => $role->id]) }}" method="POST">
                        <input name="_method" type="hidden" value="DELETE">
                        {{ csrf_field() }}
                    </form>
                    <i class="fa fa-trash-o"></i>
                </div>
                <ul>
                    @foreach($role->permissions as $permission)
                        <li>{{ $permission->name }}</li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </section>
@endsection