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
                    'paper_template_title' => $paper_instance->examination->paper_template->title,
                    'start_time' => $paper_instance->start_time,
                    'total_score' => $paper_instance->total_score,
                    'examination_id' => $paper_instance->examination_id,
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

//todo::detail

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
