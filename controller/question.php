<?php

if_get('/questions', function ()
{
    return render('question/list');
});

if_get('/questions/ajax', function ()
{
    list(
        $inputs['description'], $inputs['selection_type'], $inputs['score'], $inputs['question_category_id']
    ) = input_list(
        'description', 'selection_type', 'score', 'question_category_id'
    );
    $inputs = array_filter($inputs, 'not_null');

    $questions = dao('question')->find_all_by_column($inputs);

    return [
        'code' => 0,
        'msg'  => '',
        'count' => count($questions),
        'data' => array_build($questions, function ($id, $question) {
            return [
                null,
                [
                    'id' => $question->id,
                    'description' => $question->description,
                    'selection_type' => $question->get_selection_type_description(),
                    'score' => $question->score,
                    'question_category_id' => $question->question_category_id,
                    'question_category_name' => $question->question_category->name,
                    'create_time' => $question->create_time,
                    'update_time' => $question->update_time,
                ]
            ];
        }),
    ];
});

if_get('/questions/add', function ()
{
    $question_categories = dao('question_category')->find_all();

    return render('question/add', [
        'question_categories' => $question_categories,
    ]);
});

if_post('/questions/add', function ()
{
    $question = question::create();

    $question->description = input('description');
    $question->selection_type = input('selection_type');
    $question->score = input('score');
    $question->question_category_id = input('question_category_id');

    return redirect('/questions');
});

//todo::detail

if_get('/questions/update/*', function ($question_id)
{
    $question = dao('question')->find($question_id);
    otherwise($question->is_not_null(), 'question not found');

    $question_categories = dao('question_category')->find_all();

    return render('question/update', [
        'question_categories' => $question_categories,
        'question' => $question,
    ]);
});

if_post('/questions/update/*', function ($question_id)
{
    $question = dao('question')->find($question_id);
    otherwise($question->is_not_null(), 'question not found');

    $question->description = input('description');
    $question->selection_type = input('selection_type');
    $question->score = input('score');
    $question->question_category_id = input('question_category_id');

    redirect('/questions');
});

if_post('/questions/delete/*', function ($question_id)
{
    $question = dao('question')->find($question_id);
    otherwise($question->is_not_null(), 'question not found');

    $question->delete();

    return [
        'code' => 0,
        'msg' => '',
    ];
});
