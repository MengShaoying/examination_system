<?php

if_get('/selections', function ()
{
    return render('selection/list');
});

if_get('/selections/ajax', function ()
{
    list(
        $inputs['description'], $inputs['is_right'], $inputs['score'], $inputs['question_id']
    ) = input_list(
        'description', 'is_right', 'score', 'question_id'
    );
    $inputs = array_filter($inputs, 'not_null');

    $selections = dao('selection')->find_all_by_column($inputs);

    return [
        'code' => 0,
        'msg'  => '',
        'count' => count($selections),
        'data' => array_build($selections, function ($id, $selection) {
            return [
                null,
                [
                    'id' => $selection->id,
                    'description' => $selection->description,
                    'is_right' => $selection->get_is_right_description(),
                    'score' => $selection->score,
                    'question_id' => $selection->question_id,
                    'create_time' => $selection->create_time,
                    'update_time' => $selection->update_time,
                ]
            ];
        }),
    ];
});

if_get('/selections/add', function ()
{
    return render('selection/add');
});

if_post('/selections/add', function ()
{
    $selection = selection::create();

    $selection->description = input('description');
    $selection->is_right = input('is_right');
    $selection->score = input('score');
    $selection->question_id = input('question_id');

    return redirect('/selections');
});

//todo::detail

if_get('/selections/update/*', function ($selection_id)
{
    $selection = dao('selection')->find($selection_id);
    otherwise($selection->is_not_null(), 'selection not found');

    return render('selection/update', [
        'selection' => $selection,
    ]);
});

if_post('/selections/update/*', function ($selection_id)
{
    $selection = dao('selection')->find($selection_id);
    otherwise($selection->is_not_null(), 'selection not found');

    $selection->description = input('description');
    $selection->is_right = input('is_right');
    $selection->score = input('score');
    $selection->question_id = input('question_id');

    redirect('/selections');
});

if_post('/selections/delete/*', function ($selection_id)
{
    $selection = dao('selection')->find($selection_id);
    otherwise($selection->is_not_null(), 'selection not found');

    $selection->delete();

    return [
        'code' => 0,
        'msg' => '',
    ];
});
