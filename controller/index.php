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
                    [ 'name' => '试卷模版问题关联管理', 'key' => 'paper_template_question', 'href' => '/paper_template_questions', ],
                    [ 'name' => '试卷问题答案管理', 'key' => 'paper_instance_question_answer', 'href' => '/paper_instance_question_answers', ],
                    [ 'name' => '考试管理', 'key' => 'examination', 'href' => '/examinations', ],
                    [ 'name' => '试卷模版管理', 'key' => 'paper_template', 'href' => '/paper_templates', ],
                    [ 'name' => '问题管理', 'key' => 'question', 'href' => '/questions', ],
                    [ 'name' => '账号管理', 'key' => 'account', 'href' => '/accounts', ],
                    [ 'name' => '答题选项管理', 'key' => 'answer_selection', 'href' => '/answer_selections', ],
                    [ 'name' => '试卷管理', 'key' => 'paper_instance', 'href' => '/paper_instances', ],
                    [ 'name' => '选项管理', 'key' => 'selection', 'href' => '/selections', ],
                    [ 'name' => '问题分类管理', 'key' => 'question_category', 'href' => '/question_categories', ],
                ],
            ]
        ],
    ]);
});

if_get('/dashboard', function ()
{
    return 'dashboard';
});
