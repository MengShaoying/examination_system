<?php

if_get('/examinations', function ()
{
    return render('examination/list');
});

if_get('/examinations/ajax', function ()
{
    list(
        $inputs['early_examination_start_time'], $inputs['last_examination_start_time'], $inputs['description'], $inputs['paper_template_id']
    ) = input_list(
        'early_examination_start_time', 'last_examination_start_time', 'description', 'paper_template_id'
    );
    $inputs = array_filter($inputs, 'not_null');

    $examinations = dao('examination')->find_all_by_column($inputs);

    return [
        'code' => 0,
        'msg'  => '',
        'count' => count($examinations),
        'data' => array_build($examinations, function ($id, $examination) {
            return [
                null,
                [
                    'id' => $examination->id,
                    'early_examination_start_time' => $examination->early_examination_start_time,
                    'last_examination_start_time' => $examination->last_examination_start_time,
                    'description' => $examination->description,
                    'paper_template_id' => $examination->paper_template_id,
                    'create_time' => $examination->create_time,
                    'update_time' => $examination->update_time,
                ]
            ];
        }),
    ];
});

if_get('/examinations/add', function ()
{
    return render('examination/add');
});

if_post('/examinations/add', function ()
{
    $examination = examination::create();

    $examination->early_examination_start_time = input('early_examination_start_time');
    $examination->last_examination_start_time = input('last_examination_start_time');
    $examination->description = input('description');
    $examination->paper_template_id = input('paper_template_id');

    return redirect('/examinations');
});

//todo::detail

if_get('/examinations/update/*', function ($examination_id)
{
    $examination = dao('examination')->find($examination_id);
    otherwise($examination->is_not_null(), 'examination not found');

    return render('examination/update', [
        'examination' => $examination,
    ]);
});

if_post('/examinations/update/*', function ($examination_id)
{
    $examination = dao('examination')->find($examination_id);
    otherwise($examination->is_not_null(), 'examination not found');

    $examination->early_examination_start_time = input('early_examination_start_time');
    $examination->last_examination_start_time = input('last_examination_start_time');
    $examination->description = input('description');
    $examination->paper_template_id = input('paper_template_id');

    redirect('/examinations');
});

if_post('/examinations/delete/*', function ($examination_id)
{
    $examination = dao('examination')->find($examination_id);
    otherwise($examination->is_not_null(), 'examination not found');

    $examination->delete();

    return [
        'code' => 0,
        'msg' => '',
    ];
});
