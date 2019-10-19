<?php

if_get('/selections', function ()
{
    $question = input_entity('question');

    return render('selection/list', [
        'question' => $question,
    ]);
});

if_get('/selections/ajax', function ()
{
    list(
        $inputs['description'], $inputs['is_right'], $inputs['question_id']
    ) = input_list(
        'description', 'is_right', 'question_id'
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
                    'create_time' => $selection->create_time,
                    'update_time' => $selection->update_time,
                ]
            ];
        }),
    ];
});

if_get('/selections/add', function ()
{
    $question = input_entity('question');

    return render('selection/add', [
        'question' => $question,
    ]);
});

if_post('/selections/add', function ()
{
    $question = input_entity('question');

    $is_right = input('is_right');

    if ($question->selection_type_is_single()) {

        if ($is_right === selection::IS_RIGHT_YES) {

            otherwise(! $question->has_right_selection(), '已经存在正确的选项');
        }
    }

    $selection = selection::create($question, input('description'), $is_right);

    return redirect('/selections?question_id='.$selection->question_id);
});

//todo::detail

if_get('/selections/update/*', function ($selection_id)
{
    $selection = dao('selection')->find($selection_id);
    otherwise($selection->is_not_null(), 'selection not found');

    return render('selection/update', [
        'selection' => $selection,
        'question' => $selection->question,
    ]);
});

if_post('/selections/update/*', function ($selection_id)
{
    $selection = dao('selection')->find($selection_id);
    otherwise($selection->is_not_null(), 'selection not found');

    $selection->description = input('description');
    $selection->is_right = input('is_right');
    $selection->question_id = input('question_id');

    redirect('/selections?question_id='.$selection->question_id);
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
