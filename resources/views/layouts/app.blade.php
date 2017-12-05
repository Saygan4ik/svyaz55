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
    <link href="{{ asset('cropperJquery/dist/cropper.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        {{--Header-------------------------------------------}}
        <header>
            <nav class="navbar navbar-default navbar-static-top">
                <div class="container">
                    <div class="navbar-header">

                        <!-- Collapsed Hamburger -->
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                            <span class="sr-only">Toggle Navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <!-- Branding Image -->
                        <div class="logo">
                            <a class="logo-brand" href="{{ url('/') }}">Связь55</a>
                            <a class="logo-phone" href="tel:+79136516155">
                                <img src="svg/phone.svg" alt="phone">
                                8-913-651-61-55
                            </a>
                            <p class="logo-address">г.Омск, ул.Восточная, 1/2</p>
                        </div>
                    </div>

                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                        <!-- Left Side Of Navbar -->
                        <ul class="nav navbar-nav">
                            &nbsp;
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right">
                            <!-- Authentication Links -->
                            @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                            @else
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <a href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                Logout
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                                @endguest
                        </ul>
                    </div>
                </div>
            </nav>

            <nav id="main_nav">
                <div class="container main-nav">
                    <a href="#" class="main-nav-item">Товары</a>
                    <a href="#" class="main-nav-item">Услуги</a>
                    <a href="#" class="main-nav-item">Акции</a>
                    <a href="#" class="main-nav-item">Контакты</a>
                </div>
            </nav>
        </header>
        {{--End-header---------------------------------------}}

        {{--Products section---------------------------------}}
        <section id="section_products">
            <div class="container">
                <h1>Товары</h1>
                <div class="row">
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        <div class="row product-cat-nav">
                            <div class="col-xs-12 product-cat-nav-inner">
                                <a href="#" class="product-cat-nav-item">Радиостанции</a>
                                <a href="#" class="product-cat-nav-item">Антенны</a>
                                <a href="#" class="product-cat-nav-item">Преобразователи</a>
                                <a href="#" class="product-cat-nav-item">Динамики</a>
                            </div>
                        </div>
                        <div class="row product-brand-nav">
                            <div class="col-xs-12 product-brand-nav-inner">
                                <a href="#" class="product-brand-nav-item">Optim</a>
                                <a href="#" class="product-brand-nav-item">Megajet</a>
                                <a href="#" class="product-brand-nav-item">Vector</a>
                                <a href="#" class="product-brand-nav-item">Alan</a>
                                <a href="#" class="product-brand-nav-item">Other</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-8 hidden-xs product-item-block">
                        <div class="product-item-block-inner">
                            {{--product-item-1--}}
                            <div class="product-item">
                                <h2>Megajet</h2>
                                <h3>Mj-333</h3>
                                <div class="product-item-img">
                                    <img src="image/main-bg.jpg" alt="Mj-333">
                                    <div class="product-item-rating">3.5</div>
                                </div>
                                <div class="product-item-char">
                                    <ul>
                                        <li><span>Мощность, Вт</span><span>8</span></li>
                                        <li><span>Диапазон частот, МГц</span><span>25.145 - 33.145</span></li>
                                        <li><span>Количество каналов, шт</span><span>400</span></li>
                                        <li><span>Производитель</span><span>Корея</span></li>
                                    </ul>
                                </div>
                                <div class="product-item-func">
                                    <ul>
                                        <li>Автоматический шумодав</li>
                                        <li>Кнопки переключения каналов на тангенте</li>
                                        <li>Регулятор чувствительности микрофона</li>
                                    </ul>
                                </div>
                                <div class="product-item-price">
                                    <div class="row">
                                        <div class="col-xs-5 product-item-price-normal">4000p</div>
                                        <a href="#"><div class="col-xs-6 product-item-price-discount">3500p</div></a>
                                    </div>
                                </div>
                                <div class="btn-group-sm">
                                    <button class="product-compare btn btn-success">Сравнить</button>
                                    <button class="product-info btn btn-success">Подробнее</button>
                                </div>
                            </div>

                            {{--product-item-2--}}
                            <div class="product-item">
                                <h2>Megajet</h2>
                                <h3>Mj-333</h3>
                                <div class="product-item-img">
                                    <img src="image/main-bg.jpg" alt="Mj-333">
                                    <div class="product-item-rating">3.5</div>
                                </div>
                                <div class="product-item-char">
                                    <ul>
                                        <li><span>Мощность, Вт</span><span>8</span></li>
                                        <li><span>Диапазон частот, МГц</span><span>25.145 - 33.145</span></li>
                                        <li><span>Габариты, мм</span><span>321х123х65</span></li>
                                        <li><span>Количество каналов, шт</span><span>400</span></li>
                                        <li><span>Производитель</span><span>Корея</span></li>
                                    </ul>
                                </div>
                                <div class="product-item-func">
                                    <ul>
                                        <li>Автоматический шумодав</li>
                                        <li>Кнопки переключения каналов на тангенте</li>
                                    </ul>
                                </div>
                                <div class="product-item-price">
                                    <div class="row">
                                        <div class="col-xs-5 product-item-price-normal">4000p</div>
                                        <a href="#"><div class="col-xs-6 product-item-price-discount">3500p</div></a>
                                    </div>
                                </div>
                                <div class="btn-group-sm">
                                    <button class="product-compare btn btn-success">Сравнить</button>
                                    <button class="product-info btn btn-success">Подробнее</button>
                                </div>
                            </div>

                            {{--product-item-3--}}
                            <div class="product-item">
                                <h2>Megajet</h2>
                                <h3>Mj-333</h3>
                                <div class="product-item-img">
                                    <img src="image/main-bg.jpg" alt="Mj-333">
                                    <div class="product-item-rating">3.5</div>
                                </div>
                                <div class="product-item-char">
                                    <ul>
                                        <li><span>Мощность, Вт</span><span>8</span></li>
                                    </ul>
                                </div>
                                <div class="product-item-func">
                                    <ul>
                                        <li>Автоматический шумодав</li>
                                        <li>Кнопки переключения каналов на тангенте</li>
                                        <li>Клавиша перехода на европейскую сетку</li>
                                        <li>Регулятор чувствительности микрофона</li>
                                    </ul>
                                </div>
                                <div class="product-item-price">
                                    <div class="row">
                                        <div class="col-xs-5 product-item-price-normal">4000p</div>
                                        <a href="#"><div class="col-xs-6 product-item-price-discount">3500p</div></a>
                                    </div>
                                </div>
                                <div class="btn-group-sm">
                                    <button class="product-compare btn btn-success">Сравнить</button>
                                    <button class="product-info btn btn-success">Подробнее</button>
                                </div>
                            </div>

                            {{--product-item-4--}}
                            <div class="product-item">
                                <h2>Megajet</h2>
                                <h3>Mj-333</h3>
                                <div class="product-item-img">
                                    <img src="image/main-bg.jpg" alt="Mj-333">
                                    <div class="product-item-rating">3.5</div>
                                </div>
                                <div class="product-item-char">
                                    <ul>
                                        <li><span>Мощность, Вт</span><span>8</span></li>
                                        <li><span>Диапазон частот, МГц</span><span>25.145 - 33.145</span></li>
                                        <li><span>Производитель</span><span>Корея</span></li>
                                    </ul>
                                </div>
                                <div class="product-item-func">
                                    <ul>
                                        <li>Регулятор чувствительности микрофона</li>
                                    </ul>
                                </div>
                                <div class="product-item-price">
                                    <div class="row">
                                        <div class="col-xs-5 product-item-price-normal">4000p</div>
                                        <a href="#"><div class="col-xs-6 product-item-price-discount">3500p</div></a>
                                    </div>
                                </div>
                                <div class="btn-group-sm">
                                    <button class="product-compare btn btn-success">Сравнить</button>
                                    <button class="product-info btn btn-success">Подробнее</button>
                                </div>
                            </div>

                            {{--product-item-5--}}
                            <div class="product-item">
                                <h2>Megajet</h2>
                                <h3>Mj-333</h3>
                                <div class="product-item-img">
                                    <img src="image/main-bg.jpg" alt="Mj-333">
                                    <div class="product-item-rating">3.5</div>
                                </div>
                                <div class="product-item-char">
                                    <ul>
                                        <li><span>Мощность, Вт</span><span>8</span></li>
                                        <li><span>Диапазон частот, МГц</span><span>25.145 - 33.145</span></li>
                                        <li><span>Габариты, мм</span><span>321х123х65</span></li>
                                        <li><span>Количество каналов, шт</span><span>400</span></li>
                                        <li><span>Производитель</span><span>Корея</span></li>
                                    </ul>
                                </div>
                                <div class="product-item-func">
                                    <ul>
                                        <li>Автоматический шумодав</li>
                                        <li>Кнопки переключения каналов на тангенте</li>
                                        <li>Клавиша перехода на европейскую сетку</li>
                                        <li>Регулятор чувствительности микрофона</li>
                                    </ul>
                                </div>
                                <div class="product-item-price">
                                    <div class="row">
                                        <div class="col-xs-5 product-item-price-normal">4000p</div>
                                        <a href="#"><div class="col-xs-6 product-item-price-discount">3500p</div></a>
                                    </div>
                                </div>
                                <div class="btn-group-sm">
                                    <button class="product-compare btn btn-success">Сравнить</button>
                                    <button class="product-info btn btn-success">Подробнее</button>
                                </div>
                            </div>

                            {{--product-item-6--}}
                            <div class="product-item">
                                <h2>Megajet</h2>
                                <h3>Mj-333</h3>
                                <div class="product-item-img">
                                    <img src="image/main-bg.jpg" alt="Mj-333">
                                    <div class="product-item-rating">3</div>
                                </div>
                                <div class="product-item-char">
                                    <ul>
                                        <li><span>Мощность, Вт</span><span>8</span></li>
                                        <li><span>Диапазон частот, МГц</span><span>25.145 - 33.145</span></li>
                                        <li><span>Габариты, мм</span><span>321х123х65</span></li>
                                        <li><span>Количество каналов, шт</span><span>400</span></li>
                                        <li><span>Производитель</span><span>Корея</span></li>
                                    </ul>
                                </div>
                                <div class="product-item-func">
                                    <ul>
                                        <li>Автоматический шумодав</li>
                                        <li>Кнопки переключения каналов на тангенте</li>
                                        <li>Клавиша перехода на европейскую сетку</li>
                                        <li>Регулятор чувствительности микрофона</li>
                                    </ul>
                                </div>
                                <div class="product-item-price">
                                    <div class="row">
                                        <div class="col-xs-5 product-item-price-normal">4000p</div>
                                        <a href="#"><div class="col-xs-6 product-item-price-discount">3500p</div></a>
                                    </div>
                                </div>
                                <div class="btn-group-sm">
                                    <button class="product-compare btn btn-success">Сравнить</button>
                                    <button class="product-info btn btn-success">Подробнее</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{--End products section-----------------------------}}

        {{--Services section---------------------------------}}
        <section id="section_services">
            <div class="container">
                <h1>Услуги</h1>
                <div class="services-item">
                    <div class="row">
                        <div class="col-md-7 col-xs-12 services-text">
                            <h3 class="text-center">Ремонт радиостанций и антенн</h3>
                            <p>Приносите станцию на ремонт и мы ее починим.
                            А если не починим, то приобретете новую. Чего мелочиться.
                            Но скорее всего починим, мастер у нас отличный!!!</p>
                        </div>
                        <div class="col-md-5 hidden-xs services-img">
                            <img src="image/main-bg.jpg" alt="Services">
                        </div>
                    </div>
                </div>
                <div class="services-item">
                    <div class="row">
                        <div class="col-md-5 hidden-xs services-img">
                            <img src="image/main-bg.jpg" alt="Services">
                        </div>
                        <div class="col-md-7 col-xs-12 services-text">
                            <h3 class="text-center">Обновление навигаторов</h3>
                            <p>Обновляем навигаторы!!! Навител или IGo!!!
                            Всегда свежей версии! Карты России, Украины, Казахстана, Белоруси!
                            Также карты любого государства Европы!</p>
                        </div>
                    </div>
                </div>
                <div class="services-more">
                    <button class="btn btn-primary">Еще</button>
                </div>
            </div>
        </section>
        {{--End services section-----------------------------}}

        {{--Contacts section---------------------------------}}
        <section id="section_contacts">
            <div class="container contacts-block">
                <h1>Наши контакты</h1>
                <h4>Адрес</h4>
                <address>г.Омск, ул.Восточная 1/2</address>
                <h4>Телефоны</h4>
                <a href="tel:+79136516155">8-913-651-61-55</a>
            </div>
        </section>
        {{--End contacts section-----------------------------}}

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('script')
</body>
</html>
