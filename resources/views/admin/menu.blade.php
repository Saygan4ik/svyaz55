<a href="/admin" class="admin-nav-item">Главная панель</a>

@can('edit-roles')
    <a href="/role" class="admin-nav-item">Роли пользователей</a>
@endcan

@can('edit-users')
    <a href="#" class="admin-nav-item">Пользователи</a>
@endcan

<a href="#" class="admin-nav-item">Категории товаров</a>