<?php

function seed_echo()
{/*{{{*/
    $args = func_get_args();

    $args[0] = '[seed]'.$args[0]."\n";

    echo call_user_func_array('sprintf', $args);
}/*}}}*/

command('seed', '测试数据初始化', function ()
{/*{{{*/
    unit_of_work(function ()
    {
        $email = '123@qq.com';
        $password = '123';

        # 管理员账户初始化

        # 问题分类 初始化
        $question_category = question_category::create();
        $question_category->name = '企业文化';

        $question_category2 = question_category::create();
        $question_category2->name = '水果知识';

        # 问题 初始化
        $question = question::create();
        $question->question_category = $question_category;
        $question->set_selection_type_multi();
        $question->score = 1;
        $question->description = '百果园企业文化包含以下哪些?';

        $question2 = question::create();
        $question2->question_category = $question_category2;
        $question2->set_selection_type_single();
        $question2->score = 1;
        $question2->description = '香蕉是不是甜的?';

        # 选项 初始化
        $selection = selection::create($question, '立宏愿', selection::IS_RIGHT_YES);
        $selection = selection::create($question, '能善解', selection::IS_RIGHT_YES);
        $selection = selection::create($question, '恒义利', selection::IS_RIGHT_YES);
        $selection = selection::create($question, '永精进', selection::IS_RIGHT_YES);
        $selection = selection::create($question, '有成果', selection::IS_RIGHT_YES);
        $selection = selection::create($question, '无成果', selection::IS_RIGHT_NO);

        $selection = selection::create($question2, '是', selection::IS_RIGHT_YES);
        $selection = selection::create($question2, '不是', selection::IS_RIGHT_NO);
    });
});/*}}}*/
