<?php

if_get('/answer_selections', function ()
{
    return render('answer_selection/list');
});

if_get('/answer_selections/ajax', function ()
{
    list(
        $inputs['paper_instance_question_answer_id'], $inputs['selection_id']
    ) = input_list(
        'paper_instance_question_answer_id', 'selection_id'
    );
    $inputs = array_filter($inputs, 'not_null');

    $answer_selections = dao('answer_selection')->find_all_by_column($inputs);

    return [
        'code' => 0,
        'msg'  => '',
        'count' => count($answer_selections),
        'data' => array_build($answer_selections, function ($id, $answer_selection) {
            return [
                null,
                [
                    'id' => $answer_selection->id,
                    'paper_instance_question_answer_id' => $answer_selection->paper_instance_question_answer_id,
                    'selection_id' => $answer_selection->selection_id,
                    'create_time' => $answer_selection->create_time,
                    'update_time' => $answer_selection->update_time,
                ]
            ];
        }),
    ];
});

if_get('/answer_selections/add', function ()
{
    return render('answer_selection/add');
});

if_post('/answer_selections/add', function ()
{
    $answer_selection = answer_selection::create();

    $answer_selection->paper_instance_question_answer_id = input('paper_instance_question_answer_id');
    $answer_selection->selection_id = input('selection_id');

    return redirect('/answer_selections');
});

//todo::detail

if_get('/answer_selections/update/*', function ($answer_selection_id)
{
    $answer_selection = dao('answer_selection')->find($answer_selection_id);
    otherwise($answer_selection->is_not_null(), 'answer_selection not found');

    return render('answer_selection/update', [
        'answer_selection' => $answer_selection,
    ]);
});

if_post('/answer_selections/update/*', function ($answer_selection_id)
{
    $answer_selection = dao('answer_selection')->find($answer_selection_id);
    otherwise($answer_selection->is_not_null(), 'answer_selection not found');

    $answer_selection->paper_instance_question_answer_id = input('paper_instance_question_answer_id');
    $answer_selection->selection_id = input('selection_id');

    redirect('/answer_selections');
});

if_post('/answer_selections/delete/*', function ($answer_selection_id)
{
    $answer_selection = dao('answer_selection')->find($answer_selection_id);
    otherwise($answer_selection->is_not_null(), 'answer_selection not found');

    $answer_selection->delete();

    return [
        'code' => 0,
        'msg' => '',
    ];
});
