<?php

class examination extends entity
{
    public $structs = [
        'early_examination_start_time' => '',
        'last_examination_start_time' => '',
        'description' => '',
        'random_question_count' => '',
        'paper_template_id' => '',
    ];

    public static $entity_display_name = '考试';
    public static $entity_description = '管理考试';

    public static $struct_types = [
        'early_examination_start_time' => 'text',
        'last_examination_start_time' => 'text',
        'description' => 'text',
        'random_question_count' => 'number',
        'paper_template_id' => 'number',
    ];

    public static $struct_display_names = [
        'early_examination_start_time' => '最早考试开始时间',
        'last_examination_start_time' => '最晚考试开始时间',
        'description' => '考试说明',
        'random_question_count' => '随机选题数量',
        'paper_template_id' => '试卷模版ID',
    ];

    public static $struct_descriptions = [
        'early_examination_start_time' => '最早考试开始时间',
        'last_examination_start_time' => '最晚考试开始时间',
        'description' => '考试说明',
        'random_question_count' => '随机选题数量',
        'paper_template_id' => '试卷模版ID',
    ];

    public static $struct_formats = [
        
    ];

    public static $struct_format_descriptions = [
        
    ];

    public function __construct()
    {/*{{{*/
        $this->belongs_to('paper_template');
    }/*}}}*/

    public static function create()
    {/*{{{*/
        return parent::init();
    }/*}}}*/

}