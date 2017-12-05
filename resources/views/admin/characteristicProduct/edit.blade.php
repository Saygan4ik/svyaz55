@extends('layouts.admin')

@section('content')

    <section id="base_characteristic_create">
        <h1>Редактирование характеристики: {{ $characteristicProduct->name }}</h1>
        <form action="{{ action('CharacteristicProductController@update', ['slug' => $characteristicProduct->slug]) }}" method="POST" class="form-horizontal">
            <input type="hidden" name="_method" value="PATCH">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">Название:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $characteristicProduct->name }}">
            </div>
            <div class="form-group">
                <label for="slug">Слаг:</label>
                <input type="text" class="form-control" id="slug" name="slug" value="{{ $characteristicProduct->slug }}">
            </div>
            <div class="form-group">
                <label for="unit">Единица измерения:</label>
                <input type="text" class="form-control" id="unit" name="unit" value="{{ $characteristicProduct->unit }}">
            </div>

            @include('errors/validation')

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Редактировать</button>
            </div>
        </form>
    </section>

@endsection