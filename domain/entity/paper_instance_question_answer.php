<?php

class paper_instance_question_answer extends entity
{
    public $structs = [
        'score' => '',
        'sequence' => '',
        'paper_instance_id' => '',
        'paper_template_question_id' => '',
    ];

    public static $entity_display_name = '试卷问题答案';
    public static $entity_description = '管理试卷问题答案';

    public static $struct_types = [
        'score' => 'number',
        'sequence' => 'number',
        'paper_instance_id' => 'number',
        'paper_template_question_id' => 'number',
    ];

    public static $struct_display_names = [
        'score' => '分值',
        'sequence' => '题号',
        'paper_instance_id' => '试卷ID',
        'paper_template_question_id' => '试卷模版问题关联ID',
    ];

    public static $struct_descriptions = [
        'score' => '分值',
        'sequence' => '题号',
        'paper_instance_id' => '试卷ID',
        'paper_template_question_id' => '试卷模版问题关联ID',
    ];

    public static $struct_formats = [
        
    ];

    public static $struct_format_descriptions = [
        
    ];

    public function __construct()
    {/*{{{*/
        $this->belongs_to('paper_instance');
        $this->belongs_to('paper_template_question');
        $this->has_many('answer_selections', 'answer_selection');
    }/*}}}*/

    public static function create()
    {/*{{{*/
        return parent::init();
    }/*}}}*/

}
