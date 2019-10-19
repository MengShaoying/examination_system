<?php

if_get('/paper_instance_question_answers', function ()
{
    return render('paper_instance_question_answer/list');
});

if_get('/paper_instance_question_answers/ajax', function ()
{
    list(
        $inputs['score'], $inputs['sequence'], $inputs['paper_instance_id'], $inputs['paper_template_question_id']
    ) = input_list(
        'score', 'sequence', 'paper_instance_id', 'paper_template_question_id'
    );
    $inputs = array_filter($inputs, 'not_null');

    $paper_instance_question_answers = dao('paper_instance_question_answer')->find_all_by_column($inputs);

    return [
        'code' => 0,
        'msg'  => '',
        'count' => count($paper_instance_question_answers),
        'data' => array_build($paper_instance_question_answers, function ($id, $paper_instance_question_answer) {
            return [
                null,
                [
                    'id' => $paper_instance_question_answer->id,
                    'score' => $paper_instance_question_answer->score,
                    'sequence' => $paper_instance_question_answer->sequence,
                    'paper_instance_id' => $paper_instance_question_answer->paper_instance_id,
                    'paper_template_question_id' => $paper_instance_question_answer->paper_template_question_id,
                    'create_time' => $paper_instance_question_answer->create_time,
                    'update_time' => $paper_instance_question_answer->update_time,
                ]
            ];
        }),
    ];
});

if_get('/paper_instance_question_answers/add', function ()
{
    return render('paper_instance_question_answer/add');
});

if_post('/paper_instance_question_answers/add', function ()
{
    $paper_instance_question_answer = paper_instance_question_answer::create();

    $paper_instance_question_answer->score = input('score');
    $paper_instance_question_answer->sequence = input('sequence');
    $paper_instance_question_answer->paper_instance_id = input('paper_instance_id');
    $paper_instance_question_answer->paper_template_question_id = input('paper_template_question_id');

    return redirect('/paper_instance_question_answers');
});

//todo::detail

if_get('/paper_instance_question_answers/update/*', function ($paper_instance_question_answer_id)
{
    $paper_instance_question_answer = dao('paper_instance_question_answer')->find($paper_instance_question_answer_id);
    otherwise($paper_instance_question_answer->is_not_null(), 'paper_instance_question_answer not found');

    return render('paper_instance_question_answer/update', [
        'paper_instance_question_answer' => $paper_instance_question_answer,
    ]);
});

if_post('/paper_instance_question_answers/update/*', function ($paper_instance_question_answer_id)
{
    $paper_instance_question_answer = dao('paper_instance_question_answer')->find($paper_instance_question_answer_id);
    otherwise($paper_instance_question_answer->is_not_null(), 'paper_instance_question_answer not found');

    $paper_instance_question_answer->score = input('score');
    $paper_instance_question_answer->sequence = input('sequence');
    $paper_instance_question_answer->paper_instance_id = input('paper_instance_id');
    $paper_instance_question_answer->paper_template_question_id = input('paper_template_question_id');

    redirect('/paper_instance_question_answers');
});

if_post('/paper_instance_question_answers/delete/*', function ($paper_instance_question_answer_id)
{
    $paper_instance_question_answer = dao('paper_instance_question_answer')->find($paper_instance_question_answer_id);
    otherwise($paper_instance_question_answer->is_not_null(), 'paper_instance_question_answer not found');

    $paper_instance_question_answer->delete();

    return [
        'code' => 0,
        'msg' => '',
    ];
});
