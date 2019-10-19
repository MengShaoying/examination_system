<?php

if_get('/question_categories', function ()
{
    return render('question_category/list');
});

if_get('/question_categories/ajax', function ()
{
    list(
        $inputs['name']
    ) = input_list(
        'name'
    );
    $inputs = array_filter($inputs, 'not_null');

    $question_categories = dao('question_category')->find_all_by_column($inputs);

    return [
        'code' => 0,
        'msg'  => '',
        'count' => count($question_categories),
        'data' => array_build($question_categories, function ($id, $question_category) {
            return [
                null,
                [
                    'id' => $question_category->id,
                    'name' => $question_category->name,
                    'create_time' => $question_category->create_time,
                    'update_time' => $question_category->update_time,
                ]
            ];
        }),
    ];
});

if_get('/question_categories/add', function ()
{
    return render('question_category/add');
});

if_post('/question_categories/add', function ()
{
    $question_category = question_category::create();

    $question_category->name = input('name');

    return redirect('/question_categories');
});

//todo::detail

if_get('/question_categories/update/*', function ($question_category_id)
{
    $question_category = dao('question_category')->find($question_category_id);
    otherwise($question_category->is_not_null(), 'question_category not found');

    return render('question_category/update', [
        'question_category' => $question_category,
    ]);
});

if_post('/question_categories/update/*', function ($question_category_id)
{
    $question_category = dao('question_category')->find($question_category_id);
    otherwise($question_category->is_not_null(), 'question_category not found');

    $question_category->name = input('name');

    redirect('/question_categories');
});

if_post('/question_categories/delete/*', function ($question_category_id)
{
    $question_category = dao('question_category')->find($question_category_id);
    otherwise($question_category->is_not_null(), 'question_category not found');

    $question_category->delete();

    return [
        'code' => 0,
        'msg' => '',
    ];
});
