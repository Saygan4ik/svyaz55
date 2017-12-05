@extends('layouts.admin')

@section('content')

    <section id="base_characteristic_create">
        <h1>Редактирование характеристики</h1>
        <form action="{{ action('MoreCharacteristicProductController@update', ['id' => $moreCharacteristicProduct->id]) }}" method="POST" class="form-horizontal">
            <input type="hidden" name="_method" value="PATCH">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="text">Название:</label>
                <input type="text" class="form-control" id="text" name="text" value="{{ $moreCharacteristicProduct->text }}">
            </div>

            @include('errors/validation')

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Редактировать</button>
            </div>
        </form>
    </section>

@endsection