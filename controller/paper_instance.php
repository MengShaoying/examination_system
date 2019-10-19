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
    return render('paper_instance/add');
});

if_post('/paper_instances/add', function ()
{
    $paper_instance = paper_instance::create();

    $paper_instance->start_time = input('start_time');
    $paper_instance->total_score = input('total_score');
    $paper_instance->examination_id = input('examination_id');
    $paper_instance->account_id = input('account_id');

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
    $paper_instance->total_score = input('total_score');
    $paper_instance->examination_id = input('examination_id');
    $paper_instance->account_id = input('account_id');

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
