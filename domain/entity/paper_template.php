<?php

class paper_template extends entity
{
    public $structs = [
        'title' => '',
        'random_question_count' => '',
    ];

    public static $entity_display_name = '试卷模版';
    public static $entity_description = '管理试卷模版';

    public static $struct_types = [
        'title' => 'text',
        'random_question_count' => 'number',
    ];

    public static $struct_display_names = [
        'title' => '标题',
        'random_question_count' => '随机选题数量',
    ];

    public static $struct_descriptions = [
        'title' => '标题',
        'random_question_count' => '随机选题数量',
    ];

    public static $struct_formats = [
        
    ];

    public static $struct_format_descriptions = [
        
    ];

    public function __construct()
    {/*{{{*/
        $this->has_many('paper_template_questions', 'paper_template_question');
    }/*}}}*/

    public static function create()
    {/*{{{*/
        return parent::init();
    }/*}}}*/

}
