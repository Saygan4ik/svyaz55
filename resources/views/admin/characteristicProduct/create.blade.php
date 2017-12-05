@extends('layouts.admin')

@section('content')

    <section id="base_characteristic_create">
        <h1>Создание новой характеристики</h1>
        <form action="{{ action('CharacteristicProductController@store') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">Название:</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="slug">Слаг:</label>
                <input type="text" class="form-control" id="slug" name="slug">
            </div>
            <div class="form-group">
                <label for="unit">Единица измерения:</label>
                <input type="text" class="form-control" id="unit" name="unit">
            </div>

            @include('errors/validation')

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Создать</button>
            </div>
        </form>
    </section>

@endsection