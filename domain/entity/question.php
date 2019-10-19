<?php

class question extends entity
{
    public $structs = [
        'description' => '',
        'selection_type' => '',
        'score' => '',
        'question_category_id' => '',
    ];

    public static $entity_display_name = '问题';
    public static $entity_description = '管理问题';

    public static $struct_types = [
        'description' => 'text',
        'selection_type' => 'enum',
        'score' => 'number',
        'question_category_id' => 'number',
    ];

    public static $struct_display_names = [
        'description' => '题目',
        'selection_type' => '选项类型',
        'score' => '分值',
        'question_category_id' => '问题分类ID',
    ];

    public static $struct_descriptions = [
        'description' => '题目',
        'selection_type' => '选项类型',
        'score' => '分值',
        'question_category_id' => '问题分类ID',
    ];

    const SELECTION_TYPE_SINGLE = 'SINGLE';
    const SELECTION_TYPE_MULTI = 'MULTI';

    const SELECTION_TYPE_MAPS = [
        self::SELECTION_TYPE_SINGLE => '单选',
        self::SELECTION_TYPE_MULTI => '多选',
    ];

    public static $struct_formats = [
        'selection_type' => self::SELECTION_TYPE_MAPS,
    ];

    public static $struct_format_descriptions = [
        'selection_type' => '',
    ];

    public function __construct()
    {/*{{{*/
        $this->belongs_to('question_category');
    }/*}}}*/

    public static function create()
    {/*{{{*/
        return parent::init();
    }/*}}}*/

    public function get_selection_type_description()
    {
        return self::SELECTION_TYPE_MAPS[$this->selection_type];
    }

}