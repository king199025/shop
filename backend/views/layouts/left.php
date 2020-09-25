<aside class="main-sidebar">

    <section class="sidebar">
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Меню', 'options' => ['class' => 'header']],
                    ['label' => 'Пользователи', 'icon' => 'file-code-o', 'url' => ['/user/user']],
                    ['label' => 'Заказы', 'icon' => 'dashboard', 'url' => ['/order/order']],
                    ['label' => 'Товары', 'icon' => 'share', 'url' => ['/products/products']],
                    ['label' => 'Категории', 'icon' => 'dashboard', 'url' => ['/category/category']],
                ],
            ]
        ) ?>

    </section>

</aside>
