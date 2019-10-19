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
                    'examination_start_time_range' => implode_examination_start_time_rannge($examination),
                    'last_second' => $examination->last_second,
                    'description' => $examination->description,
                    'paper_template_title' => $examination->paper_template->title,
                    'create_time' => $examination->create_time,
                    'update_time' => $examination->update_time,
                ]
            ];
        }),
    ];
});

if_get('/examinations/add', function ()
{
    $paper_templates = dao('paper_template')->find_all();

    $student_accounts = dao('account')->find_all_students();

    return render('examination/add', [
        'paper_templates' => $paper_templates,
        'student_accounts' => $student_accounts,
    ]);
});

if_post('/examinations/add', function ()
{
    $paper_template = input_entity('paper_template');

    $examination_start_time_range = input('examination_start_time_range');
    $start_time_infos = explode_examination_start_time_range($examination_start_time_range);

    $examination = examination::create();

    $examination->early_examination_start_time = $start_time_infos['early'];
    $examination->last_examination_start_time = $start_time_infos['last'];
    $examination->description = input('description');
    $examination->last_second = input('last_second');
    $examination->paper_template = $paper_template;


    foreach (input('accounts') as $account_id) {

        $paper_instance = paper_instance::create($examination);
        $paper_instance->account_id = $account_id;
    }

    return redirect('/examinations');
});

//todo::detail

if_get('/examinations/update/*', function ($examination_id)
{
    $examination = dao('examination')->find($examination_id);
    otherwise($examination->is_not_null(), 'examination not found');

    $paper_templates = dao('paper_template')->find_all();
    $student_accounts = dao('account')->find_all_students();

    $checked_accounts = relationship_batch_load($examination, 'paper_instances.account');

    return render('examination/update', [
        'examination' => $examination,
        'paper_templates' => $paper_templates,
        'student_accounts' => $student_accounts,
        'checked_accounts' => $checked_accounts,
    ]);
});

if_post('/examinations/update/*', function ($examination_id)
{
    $examination = dao('examination')->find($examination_id);
    otherwise($examination->is_not_null(), 'examination not found');

    $examination_start_time_range = input('examination_start_time_range');
    $start_time_infos = explode_examination_start_time_range($examination_start_time_range);

    $examination->early_examination_start_time = $start_time_infos['early'];
    $examination->last_examination_start_time = $start_time_infos['last'];
    $examination->last_second = input('last_second');
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
