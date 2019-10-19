<?php

if_get('/', function ()
{
    return render('index/index', [
        'tree_infos' => [
            [
                'name' => '试卷',
                'key'  => 'module',
                'icon_class' => 'layui-icon-component',
                'children' => [
                    [ 'name' => '问题分类管理', 'key' => 'question_category', 'href' => '/question_categories', ],
                    [ 'name' => '问题管理', 'key' => 'question', 'href' => '/questions', ],
                    [ 'name' => '试卷模版管理', 'key' => 'paper_template', 'href' => '/paper_templates', ],
                ],
            ],
            [
                'name' => '考试',
                'key'  => 'module',
                'icon_class' => 'layui-icon-component',
                'children' => [
                    [ 'name' => '考试管理', 'key' => 'examination', 'href' => '/examinations', ],
                    [ 'name' => '试卷管理', 'key' => 'paper_instance', 'href' => '/paper_instances', ],
                    [ 'name' => '我的考卷', 'key' => 'my_paper_instance', 'href' => '/my_paper_instances', ],
                ],
            ],
            [
                'name' => '账号',
                'key'  => 'module',
                'icon_class' => 'layui-icon-component',
                'children' => [
                    [ 'name' => '账号管理', 'key' => 'account', 'href' => '/accounts', ],
                ],
            ],
        ],
    ]);
});

if_get('/dashboard', function ()
{
    return '';
});
