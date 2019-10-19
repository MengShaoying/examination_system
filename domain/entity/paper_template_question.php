<?php

class paper_template_question extends entity
{
    public $structs = [
        'paper_template_id' => '',
        'question_id' => '',
    ];

    public static $entity_display_name = '试卷模版问题关联';
    public static $entity_description = '管理试卷模版问题关联';

    public static $struct_types = [
        'paper_template_id' => 'number',
        'question_id' => 'number',
    ];

    public static $struct_display_names = [
        'paper_template_id' => '试卷模版ID',
        'question_id' => '问题ID',
    ];

    public static $struct_descriptions = [
        'paper_template_id' => '试卷模版ID',
        'question_id' => '问题ID',
    ];

    public static $struct_formats = [
        
    ];

    public static $struct_format_descriptions = [
        
    ];

    public function __construct()
    {/*{{{*/
        $this->belongs_to('paper_template');
        $this->belongs_to('question');
    }/*}}}*/

    public static function create()
    {/*{{{*/
        return parent::init();
    }/*}}}*/

}
