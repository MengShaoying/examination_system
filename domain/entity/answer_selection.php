<?php

class answer_selection extends entity
{
    public $structs = [
        'paper_instance_question_answer_id' => '',
        'selection_id' => '',
    ];

    public static $entity_display_name = '答题选项';
    public static $entity_description = '管理答题选项';

    public static $struct_types = [
        'paper_instance_question_answer_id' => 'number',
        'selection_id' => 'number',
    ];

    public static $struct_display_names = [
        'paper_instance_question_answer_id' => '试卷问题答案ID',
        'selection_id' => '选项ID',
    ];

    public static $struct_descriptions = [
        'paper_instance_question_answer_id' => '试卷问题答案ID',
        'selection_id' => '选项ID',
    ];

    public static $struct_formats = [
        
    ];

    public static $struct_format_descriptions = [
        
    ];

    public function __construct()
    {/*{{{*/
        $this->belongs_to('paper_instance_question_answer');
        $this->belongs_to('selection');
    }/*}}}*/

    public static function create()
    {/*{{{*/
        return parent::init();
    }/*}}}*/

}