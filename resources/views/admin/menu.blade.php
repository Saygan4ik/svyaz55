<div class="admin-nav-item">
    <a href="/admin">Главная панель</a>
</div>

@can('edit-roles')
    <div class="admin-nav-item">
        <a href="/role">Роли пользователей</a>
    </div>
@endcan

@can('edit-users')
    <div class="admin-nav-item">
        <a href="/user">Пользователи</a>
    </div>
@endcan

@can('edit-categories')
    <div class="admin-nav-item">
        <a href="/category">Категории товаров</a>
    </div>
@endcan

@can('edit-products')
    <div class="admin-nav-item">
        <a href="/product/create">Товары</a>
    </div>
@endcan

@can('edit-products')
    <div class="admin-nav-item admin-nav-item-characteristic">
        <div class="admin-nav-item-characteristic-a" onclick="(this).classList.add('hidden');document.getElementById('admin_nav_item_characteristic_b').classList.remove('hidden');">
            <a href="#">Характеристики товаров</a>
        </div>
        <div class="admin-nav-item-characteristic-b hidden" id="admin_nav_item_characteristic_b">
            <a href="/characteristicProduct" style="width: 49%;">Основные</a>
            <a href="/moreCharacteristicProduct" style="width: 49%; text-align: right">Дополнительные</a>
        </div>
    </div>
@endcan