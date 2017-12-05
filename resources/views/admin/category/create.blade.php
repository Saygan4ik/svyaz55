@extends('layouts/admin')

@section('content')
    <h1>Создание новой категории товаров</h1>
    <form action="{{ action('CategoryController@store') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name">Название категории:</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="slug">Имя ссылки (slug):</label>
            <input type="text" name="slug" id="slug" class="form-control">
        </div>
        <div class="form-group">
            <div class="">
                <label for="">Видимость категории для пользователей:</label>
                <div class="">
                    <input type="checkbox" id="isVisible" name="isVisible" class="checkbox-button">
                    <label for="isVisible">Вкл/Выкл</label>
                </div>
            </div>
        </div>

        @include('errors/validation')

        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                Создать
            </button>
        </div>
    </form>
@endsection