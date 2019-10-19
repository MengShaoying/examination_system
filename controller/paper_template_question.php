<?php

if_get('/paper_template_questions', function ()
{
    return render('paper_template_question/list');
});

if_get('/paper_template_questions/ajax', function ()
{
    list(
        $inputs['paper_template_id'], $inputs['question_id']
    ) = input_list(
        'paper_template_id', 'question_id'
    );
    $inputs = array_filter($inputs, 'not_null');

    $paper_template_questions = dao('paper_template_question')->find_all_by_column($inputs);

    return [
        'code' => 0,
        'msg'  => '',
        'count' => count($paper_template_questions),
        'data' => array_build($paper_template_questions, function ($id, $paper_template_question) {
            return [
                null,
                [
                    'id' => $paper_template_question->id,
                    'paper_template_id' => $paper_template_question->paper_template_id,
                    'question_id' => $paper_template_question->question_id,
                    'create_time' => $paper_template_question->create_time,
                    'update_time' => $paper_template_question->update_time,
                ]
            ];
        }),
    ];
});

if_get('/paper_template_questions/add', function ()
{
    return render('paper_template_question/add');
});

if_post('/paper_template_questions/add', function ()
{
    $paper_template_question = paper_template_question::create();

    $paper_template_question->paper_template_id = input('paper_template_id');
    $paper_template_question->question_id = input('question_id');

    return redirect('/paper_template_questions');
});

//todo::detail

if_get('/paper_template_questions/update/*', function ($paper_template_question_id)
{
    $paper_template_question = dao('paper_template_question')->find($paper_template_question_id);
    otherwise($paper_template_question->is_not_null(), 'paper_template_question not found');

    return render('paper_template_question/update', [
        'paper_template_question' => $paper_template_question,
    ]);
});

if_post('/paper_template_questions/update/*', function ($paper_template_question_id)
{
    $paper_template_question = dao('paper_template_question')->find($paper_template_question_id);
    otherwise($paper_template_question->is_not_null(), 'paper_template_question not found');

    $paper_template_question->paper_template_id = input('paper_template_id');
    $paper_template_question->question_id = input('question_id');

    redirect('/paper_template_questions');
});

if_post('/paper_template_questions/delete/*', function ($paper_template_question_id)
{
    $paper_template_question = dao('paper_template_question')->find($paper_template_question_id);
    otherwise($paper_template_question->is_not_null(), 'paper_template_question not found');

    $paper_template_question->delete();

    return [
        'code' => 0,
        'msg' => '',
    ];
});
