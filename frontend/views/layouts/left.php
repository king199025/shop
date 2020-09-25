<aside class="main-sidebar">

    <section class="sidebar">

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => \common\models\Category::getArrayForSidebar(),
            ]
        ) ?>

    </section>

</aside>
