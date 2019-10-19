<?php

if_get('/', function ()
{
    return render('index/index', [
        'tree_infos' => [
            [
                'name' => '表单式管理',
                'key'  => 'module',
                'icon_class' => 'layui-icon-component',
                'children' => [
                    [ 'name' => '顾客管理', 'key' => 'customer', 'href' => '/customers', ],
                    [ 'name' => '商品管理', 'key' => 'good', 'href' => '/goods', ],
                ],
            ]
        ],
    ]);
});

if_get('/dashboard', function ()
{
    return 'dashboard';
});
