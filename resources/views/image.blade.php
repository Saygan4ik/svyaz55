<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="app">
    <p>Hello</p>
    <form class="form-horizontal" method="POST"  action="{{ action('ImageController@store') }} " enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="avatar" class="form-control">Avatar</label>
            <input type="file" id="avatar" name="avatar" multiple>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                Send
            </button>
        </div>
    </form>
</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>