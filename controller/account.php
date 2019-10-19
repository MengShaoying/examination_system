<?php

if_get('/accounts', function ()
{
    return render('account/list');
});

if_get('/accounts/ajax', function ()
{
    list(
        $inputs['name'], $inputs['password']
    ) = input_list(
        'name', 'password'
    );
    $inputs = array_filter($inputs, 'not_null');

    $accounts = dao('account')->find_all_by_column($inputs);

    return [
        'code' => 0,
        'msg'  => '',
        'count' => count($accounts),
        'data' => array_build($accounts, function ($id, $account) {
            return [
                null,
                [
                    'id' => $account->id,
                    'name' => $account->name,
                    'password' => $account->password,
                    'create_time' => $account->create_time,
                    'update_time' => $account->update_time,
                ]
            ];
        }),
    ];
});

if_get('/accounts/add', function ()
{
    return render('account/add');
});

if_post('/accounts/add', function ()
{
    $account = account::create();

    $account->name = input('name');
    $account->password = input('password');

    return redirect('/accounts');
});

//todo::detail

if_get('/accounts/update/*', function ($account_id)
{
    $account = dao('account')->find($account_id);
    otherwise($account->is_not_null(), 'account not found');

    return render('account/update', [
        'account' => $account,
    ]);
});

if_post('/accounts/update/*', function ($account_id)
{
    $account = dao('account')->find($account_id);
    otherwise($account->is_not_null(), 'account not found');

    $account->name = input('name');
    $account->password = input('password');

    redirect('/accounts');
});

if_post('/accounts/delete/*', function ($account_id)
{
    $account = dao('account')->find($account_id);
    otherwise($account->is_not_null(), 'account not found');

    $account->delete();

    return [
        'code' => 0,
        'msg' => '',
    ];
});
