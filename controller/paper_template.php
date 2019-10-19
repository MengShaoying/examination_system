<?php

if_get('/paper_templates', function ()
{
    return render('paper_template/list');
});

if_get('/paper_templates/ajax', function ()
{
    list(
        $inputs['title'], $inputs['random_question_count']
    ) = input_list(
        'title', 'random_question_count'
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
                    'random_question_count' => $paper_template->random_question_count,
                    'create_time' => $paper_template->create_time,
                    'update_time' => $paper_template->update_time,
                ]
            ];
        }),
    ];
});

if_get('/paper_templates/add', function ()
{
    $questions = dao('question')->find_all();

    return render('paper_template/add', [
        'questions' => $questions,
    ]);
});

if_post('/paper_templates/add', function ()
{
    $paper_template = paper_template::create();

    $paper_template->title = input('title');
    $paper_template->random_question_count = input('random_question_count');


    foreach (input('questions') as $question_id) {

        $paper_template_question = paper_template_question::create();
        $paper_template_question->paper_template = $paper_template;;
        $paper_template_question->question_id = $question_id;
    }

    return redirect('/paper_templates');
});

//todo::detail

if_get('/paper_templates/update/*', function ($paper_template_id)
{
    $paper_template = dao('paper_template')->find($paper_template_id);
    otherwise($paper_template->is_not_null(), 'paper_template not found');

    $questions = dao('question')->find_all();

    $checked_questions = relationship_batch_load($paper_template, 'paper_template_questions.question');

    return render('paper_template/update', [
        'paper_template' => $paper_template,
        'questions' => $questions,
        'checked_questions' => $checked_questions,
    ]);
});

if_post('/paper_templates/update/*', function ($paper_template_id)
{
    $paper_template = dao('paper_template')->find($paper_template_id);
    otherwise($paper_template->is_not_null(), 'paper_template not found');

    $paper_template->title = input('title');
    $paper_template->random_question_count = input('random_question_count');

    $question_ids = input('questions');

    $question_infos = array_flip($question_ids);

    foreach ($paper_template->paper_template_questions as $paper_template_question) {

        if (! isset($question_infos[$paper_template_question->question_id])) {

            $paper_template_question->delete();
        } else {

            unset($question_infos[$paper_template_question->question_id]);
        }
    }

    foreach ($question_infos as $question_id => $whatever) {

        $paper_template_question = paper_template_question::create();
        $paper_template_question->paper_template = $paper_template;;
        $paper_template_question->question_id = $question_id;
    }

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
