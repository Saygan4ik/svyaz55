@extends('layouts.admin')

@section('content')

    <section id="base_characteristic_create">
        <h1>Создание новой характеристики</h1>
        <form action="{{ action('MoreCharacteristicProductController@store') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="text">Текст:</label>
                <input type="text" class="form-control" id="text" name="text">
            </div>

            @include('errors/validation')

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Создать</button>
            </div>
        </form>
    </section>

@endsection