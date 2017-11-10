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
        <div class="container">
            <form action="{{ action('UserController@update', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                <input name="_method" type="hidden" value="PATCH">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}">
                </div>
                <div class="form-group">
                    <label for="">Аватар:</label>
                    <input type="file" name="avatar" id="file-input">
                </div>
                <div class="" id="list-view">
                </div>

                @include('errors/validation')

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Редактировать
                    </button>
                </div>
            </form>

            <div class="img-user">
                <img src="/imagecache?src={{ $user->avatar }}" alt="">
            </div>

        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        var listen = function(element, event, fn) {
            return element.addEventListener(event, fn, false);
        };

        listen(document, 'DOMContentLoaded', function() {

            var fileInput = document.querySelector('#file-input');
            var listView = document.querySelector('#list-view');

            var queue = [];
            var isProcessing = false;

            var image = new Image();
            var imgLoadHandler;

            listen(fileInput, 'change', function(event) {
                var files = fileInput.files;
                if (files.lenght == 0) {
                    return;
                }
                for(var i = 0; i < files.length; i++) {
                    queue.push(files[i]);
                }
                processQueue();
            });

            var processQueue = function() {
                if (isProcessing) {
                    return;
                }
                if (queue.length == 0) {
                    isProcessing = false;
                    return;
                }
                isProcessing = true;
                file = queue.pop();
                var reader = new FileReader();
                reader.onload = function(e) {
                    var dataUrl = e.target.result;
                    var li = document.createElement('LI');
                    var image = new Image();
                    image.width = 300;
                    image.src = dataUrl;
                    li.appendChild(image);
                    listView.appendChild(li);
                    isProcessing = false;
                    processQueue();
                };
                reader.readAsDataURL(file);
            };
        });
    </script>
</body>
</html>