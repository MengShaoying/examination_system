<?php

if_get('/paper_instances', function ()
{
    return render('paper_instance/list');
});

if_get('/paper_instances/ajax', function ()
{
    list(
        $inputs['start_time'], $inputs['total_score'], $inputs['examination_id'], $inputs['account_id']
    ) = input_list(
        'start_time', 'total_score', 'examination_id', 'account_id'
    );
    $inputs = array_filter($inputs, 'not_null');

    $paper_instances = dao('paper_instance')->find_all_by_column($inputs);

    return [
        'code' => 0,
        'msg'  => '',
        'count' => count($paper_instances),
        'data' => array_build($paper_instances, function ($id, $paper_instance) {
            return [
                null,
                [
                    'id' => $paper_instance->id,
                    'examination_start_time_range' => implode_examination_start_time_rannge($paper_instance->examination),
                    'early_examination_start_time' => $paper_instance->examination->early_examination_start_time,
                    'last_examination_start_time' => $paper_instance->examination->last_examination_start_time,
                    'paper_template_title' => $paper_instance->examination->paper_template->title,
                    'start_time' => $paper_instance->start_time,
                    'total_score' => $paper_instance->total_score,
                    'examination_id' => $paper_instance->examination_id,
                    'status_description' => $paper_instance->get_status_description(),
                    'status' => $paper_instance->status,
                    'account_name' => $paper_instance->account->name,
                    'create_time' => $paper_instance->create_time,
                    'update_time' => $paper_instance->update_time,
                ]
            ];
        }),
    ];
});

if_get('/my_paper_instances', function ()
{
    return render('paper_instance/my_list');
});

if_get('/my_paper_instances/ajax', function ()
{
    list(
        $inputs['start_time'], $inputs['total_score'], $inputs['examination_id'], $inputs['account_id']
    ) = input_list(
        'start_time', 'total_score', 'examination_id', 'account_id'
    );
    $inputs = array_filter($inputs, 'not_null');

    $paper_instances = dao('paper_instance')->find_all_by_column($inputs);

    return [
        'code' => 0,
        'msg'  => '',
        'count' => count($paper_instances),
        'data' => array_build($paper_instances, function ($id, $paper_instance) {
            return [
                null,
                [
                    'id' => $paper_instance->id,
                    'examination_start_time_range' => implode_examination_start_time_rannge($paper_instance->examination),
                    'paper_template_title' => $paper_instance->examination->paper_template->title,
                    'start_time' => $paper_instance->start_time,
                    'total_score' => $paper_instance->total_score,
                    'examination_id' => $paper_instance->examination_id,
                    'status_description' => $paper_instance->get_status_description(),
                    'status' => $paper_instance->status,
                    'account_id' => $paper_instance->account_id,
                    'create_time' => $paper_instance->create_time,
                    'update_time' => $paper_instance->update_time,
                ]
            ];
        }),
    ];
});

if_get('/paper_instances/add', function ()
{
    $examinations = dao('examination')->find_all();
    $student_accounts = dao('account')->find_all_students();

    return render('paper_instance/add', [
        'examinations' => $examinations,
        'student_accounts' => $student_accounts,
    ]);
});

if_post('/paper_instances/add', function ()
{
    $examination = input_entity('examination');

    foreach (input('accounts') as $account_id) {

        $paper_instance = paper_instance::create($examination);
        $paper_instance->account_id = $account_id;
    }

    return redirect('/paper_instances');
});

if_get('/paper_instances/detail/*', function ($paper_instance_id)
{
    $paper_instance = dao('paper_instance')->find($paper_instance_id);
    otherwise($paper_instance->is_not_null(), 'paper_instance not found');

    return render('paper_instance/detail', [
        'paper_instance' => $paper_instance,
    ]);
});

if_post('/paper_instances/detail/*', function ($paper_instance_id)
{
    $paper_instance = dao('paper_instance')->find($paper_instance_id);
    otherwise($paper_instance->is_not_null(), 'paper_instance not found');

    $paper_instance_question_answers = $paper_instance->paper_instance_question_answers;

    $selections = input('selections');

    $selection_infos = array_flip($selections);

    $total_score = 0;

    foreach ($paper_instance_question_answers as $paper_instance_question_answer) {

        $question = $paper_instance_question_answer->paper_template_question->question;

        $score = $question->score;

        foreach ($question->selections as $selection) {

            $has_selection = isset($selection_infos[$selection->id]);

            if ($has_selection) {

                $answer_selection = answer_selection::create();

                $answer_selection->paper_instance_question_answer = $paper_instance_question_answer;
                $answer_selection->selection = $selection;
            }

            if ($score === 0
                || ($selection->is_right_no() && $has_selection)
                || ($selection->is_right_yes() && ! $has_selection)
            ) {
                $score = 0;
            }
        }

        $total_score += $score;
    }

    $paper_instance->total_score = $total_score;
    $paper_instance->set_status_finished();

    redirect('/my_paper_instances');
});

if_get('/paper_instances/look/*', function ($paper_instance_id)
{
    $paper_instance = dao('paper_instance')->find($paper_instance_id);
    otherwise($paper_instance->is_not_null(), 'paper_instance not found');

    $answer_selections = relationship_batch_load($paper_instance, 'paper_instance_question_answers.answer_selections');

    $checked_selection_infos = [];

    foreach ($answer_selections as $answer_selection) {

        $checked_selection_infos[$answer_selection->selection_id] = $answer_selection;
    }

    return render('paper_instance/look', [
        'paper_instance' => $paper_instance,
        'checked_selection_infos' => $checked_selection_infos,
    ]);
});

if_get('/paper_instances/update/*', function ($paper_instance_id)
{
    $paper_instance = dao('paper_instance')->find($paper_instance_id);
    otherwise($paper_instance->is_not_null(), 'paper_instance not found');

    return render('paper_instance/update', [
        'paper_instance' => $paper_instance,
    ]);
});

if_post('/paper_instances/update/*', function ($paper_instance_id)
{
    $paper_instance = dao('paper_instance')->find($paper_instance_id);
    otherwise($paper_instance->is_not_null(), 'paper_instance not found');

    $paper_instance->start_time = input('start_time');
    $paper_instance->set_status_init();

    redirect('/paper_instances');
});

if_post('/paper_instances/delete/*', function ($paper_instance_id)
{
    $paper_instance = dao('paper_instance')->find($paper_instance_id);
    otherwise($paper_instance->is_not_null(), 'paper_instance not found');

    $paper_instance->delete();

    return [
        'code' => 0,
        'msg' => '',
    ];
});

if_post('/paper_instances/start/*', function ($paper_instance_id)
{
    $paper_instance = dao('paper_instance')->find($paper_instance_id);
    otherwise($paper_instance->is_not_null(), 'paper_instance not found');

    otherwise($paper_instance->status_is_init(), '试卷已经是'.$paper_instance->get_status_description().'状态');

    if ($paper_instance->start_time == '0000-00-00 00:00:00') {

        $paper_instance->start_time = datetime();
        queue_push('paper_instance_timeout', [
            'paper_instance_id' => $paper_instance->id,
        ], $paper_instance->examination->last_second);

    }

    return [
        'code' => 0,
        'msg' => '',
    ];
});

if_post('/paper_instances/reject/*', function ($paper_instance_id)
{
    $paper_instance = dao('paper_instance')->find($paper_instance_id);
    otherwise($paper_instance->is_not_null(), 'paper_instance not found');

    $paper_instance->set_status_reject();

    return [
        'code' => 0,
        'msg' => '',
    ];
});
