<?php

class selection extends entity
{
    public $structs = [
        'description' => '',
        'is_right' => '',
        'score' => '',
        'question_id' => '',
    ];

    public static $entity_display_name = '选项';
    public static $entity_description = '管理选项';

    public static $struct_types = [
        'description' => 'text',
        'is_right' => 'enum',
        'score' => 'number',
        'question_id' => 'number',
    ];

    public static $struct_display_names = [
        'description' => '描述',
        'is_right' => '是否正确答案',
        'score' => '分值',
        'question_id' => '问题ID',
    ];

    public static $struct_descriptions = [
        'description' => '描述',
        'is_right' => '是否正确答案',
        'score' => '分值',
        'question_id' => '问题ID',
    ];

    const IS_RIGHT_1 = '1';
    const IS_RIGHT_ = '';

    const IS_RIGHT_MAPS = [
        self::IS_RIGHT_1 => '正确',
        self::IS_RIGHT_ => '错误',
    ];

    public static $struct_formats = [
        'is_right' => self::IS_RIGHT_MAPS,
    ];

    public static $struct_format_descriptions = [
        'is_right' => '',
    ];

    public function __construct()
    {/*{{{*/
        $this->belongs_to('question');
    }/*}}}*/

    public static function create()
    {/*{{{*/
        return parent::init();
    }/*}}}*/

    public function get_is_right_description()
    {
        return self::IS_RIGHT_MAPS[$this->is_right];
    }

}