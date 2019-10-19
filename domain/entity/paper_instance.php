<?php

class paper_instance extends entity
{
    public $structs = [
        'start_time' => '',
        'total_score' => '',
        'examination_id' => '',
        'account_id' => '',
    ];

    public static $entity_display_name = '试卷';
    public static $entity_description = '管理试卷';

    public static $struct_types = [
        'start_time' => 'text',
        'total_score' => 'number',
        'examination_id' => 'number',
        'account_id' => 'number',
    ];

    public static $struct_display_names = [
        'start_time' => '开始时间',
        'total_score' => '总分',
        'examination_id' => '考试ID',
        'account_id' => '账号ID',
    ];

    public static $struct_descriptions = [
        'start_time' => '开始时间',
        'total_score' => '总分',
        'examination_id' => '考试ID',
        'account_id' => '账号ID',
    ];

    public static $struct_formats = [
        
    ];

    public static $struct_format_descriptions = [
        
    ];

    public function __construct()
    {/*{{{*/
        $this->belongs_to('examination');
        $this->belongs_to('account');
    }/*}}}*/

    public static function create()
    {/*{{{*/
        return parent::init();
    }/*}}}*/

}