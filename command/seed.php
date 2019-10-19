<?php

function seed_echo()
{/*{{{*/
    $args = func_get_args();

    $args[0] = '[seed]'.$args[0]."\n";

    echo call_user_func_array('sprintf', $args);
}/*}}}*/

command('seed', '测试数据初始化', function ()
{/*{{{*/
    $examination = unit_of_work(function ()
    {
        # 管理员账户初始化
        $account = account::create();
        $account->name = 'admin';
        $account->password = 123;
        $account->role = account::ROLE_ADMIN;

        $account_t = account::create();
        $account_t->name = 'teacher';
        $account_t->password = 123;
        $account_t->role = account::ROLE_TEACHER;

        $account_s1 = account::create();
        $account_s1->name = 'student_1';
        $account_s1->password = 123;
        $account_s1->role = account::ROLE_STUDENT;

        $account_s2 = account::create();
        $account_s2->name = 'student_2';
        $account_s2->password = 123;
        $account_s2->role = account::ROLE_STUDENT;

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
        selection::create($question, '立宏愿', selection::IS_RIGHT_YES);
        selection::create($question, '能善解', selection::IS_RIGHT_YES);
        selection::create($question, '恒义利', selection::IS_RIGHT_YES);
        selection::create($question, '永精进', selection::IS_RIGHT_YES);
        selection::create($question, '有成果', selection::IS_RIGHT_YES);
        selection::create($question, '无成果', selection::IS_RIGHT_NO);

        selection::create($question2, '是', selection::IS_RIGHT_YES);
        selection::create($question2, '不是', selection::IS_RIGHT_NO);

        # 试卷模版 初始化
        $paper_template = paper_template::create();
        $paper_template->title = '百果园文化和水果知识考试';
        $paper_template->random_question_count = 1;

        # 试卷模版问题关联 初始化
        $paper_template_question = paper_template_question::create();
        $paper_template_question->paper_template = $paper_template;;
        $paper_template_question->question = $question;

        $paper_template_question = paper_template_question::create();
        $paper_template_question->paper_template = $paper_template;;
        $paper_template_question->question = $question2;

        # 考试 初始化
        $start_time_infos = explode_examination_start_time_range('2019-10-17 ~ 2019-11-29');

        $examination = examination::create();
        $examination->early_examination_start_time = $start_time_infos['early'];
        $examination->last_examination_start_time = $start_time_infos['last'];
        $examination->description = '问题不多，快点作答';
        $examination->last_second = 20;
        $examination->paper_template = $paper_template;

        return $examination;
    });

    unit_of_work(function () use ($examination)
    {
        # 试卷 初始化
        $paper_instance = paper_instance::create($examination);
        $paper_instance->account = dao('account')->find_by_column(['name' => 'student_1']);

        $paper_instance = paper_instance::create($examination);
        $paper_instance->account = dao('account')->find_by_column(['name' => 'student_2']);
    });
});/*}}}*/
