<?php

if_get('/paper_templates', function ()
{
    return render('paper_template/list');
});

if_get('/paper_templates/ajax', function ()
{
    list(
        $inputs['title']
    ) = input_list(
        'title'
    );
    $inputs = array_filter($inputs, 'not_null');

    $paper_templates = dao('paper_template')->find_all_by_column($inputs);

    return [
        'code' => 0,
        'msg'  => '',
        'count' => count($paper_templates),
        'data' => array_build($paper_templates, function ($id, $paper_template) {
            return [
                null,
                [
                    'id' => $paper_template->id,
                    'title' => $paper_template->title,
                    'create_time' => $paper_template->create_time,
                    'update_time' => $paper_template->update_time,
                ]
            ];
        }),
    ];
});

if_get('/paper_templates/add', function ()
{
    return render('paper_template/add');
});

if_post('/paper_templates/add', function ()
{
    $paper_template = paper_template::create();

    $paper_template->title = input('title');

    return redirect('/paper_templates');
});

//todo::detail

if_get('/paper_templates/update/*', function ($paper_template_id)
{
    $paper_template = dao('paper_template')->find($paper_template_id);
    otherwise($paper_template->is_not_null(), 'paper_template not found');

    return render('paper_template/update', [
        'paper_template' => $paper_template,
    ]);
});

if_post('/paper_templates/update/*', function ($paper_template_id)
{
    $paper_template = dao('paper_template')->find($paper_template_id);
    otherwise($paper_template->is_not_null(), 'paper_template not found');

    $paper_template->title = input('title');

    redirect('/paper_templates');
});

if_post('/paper_templates/delete/*', function ($paper_template_id)
{
    $paper_template = dao('paper_template')->find($paper_template_id);
    otherwise($paper_template->is_not_null(), 'paper_template not found');

    $paper_template->delete();

    return [
        'code' => 0,
        'msg' => '',
    ];
});
