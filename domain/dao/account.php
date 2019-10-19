<?php

class account_dao extends dao
{
    protected $table_name = 'account';
    protected $db_config_key = 'default';

    public function find_all_students()
    {/*{{{*/
        return $this->find_all_by_column([
            'role' => account::ROLE_STUDENT,
        ]);
    }/*}}}*/
}
