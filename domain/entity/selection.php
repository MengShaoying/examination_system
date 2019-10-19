<?php

class selection extends entity
{
    public $structs = [
        'description' => '',
        'is_right' => '',
        'question_id' => '',
    ];

    public static $entity_display_name = '选项';
    public static $entity_description = '管理选项';

    public static $struct_types = [
        'description' => 'text',
        'is_right' => 'enum',
        'question_id' => 'number',
    ];

    public static $struct_display_names = [
        'description' => '描述',
        'is_right' => '是否正确答案',
        'question_id' => '问题ID',
    ];

    public static $struct_descriptions = [
        'description' => '描述',
        'is_right' => '是否正确答案',
        'question_id' => '问题ID',
    ];

    const IS_RIGHT_YES = 'YES';
    const IS_RIGHT_NO = 'NO';

    const IS_RIGHT_MAPS = [
        self::IS_RIGHT_YES => '正确',
        self::IS_RIGHT_NO => '错误',
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

    public static function create(question $question, $description, $is_right = self::IS_RIGHT_NO)
    {/*{{{*/
        $selection =  parent::init();

        $selection->question = $question;
        $selection->description = $description;

        if ($is_right === self::IS_RIGHT_NO) {
            $selection->set_is_right_no();
        } else {
            $selection->set_is_right_yes();
        }

        return $selection;
    }/*}}}*/

    public function get_is_right_description()
    {/*{{{*/
        return self::IS_RIGHT_MAPS[$this->is_right];
    }/*}}}*/

    public function is_right_yes()
    {/*{{{*/
        return $this->is_right === self::IS_RIGHT_YES;
    }/*}}}*/

    public function is_right_no()
    {/*{{{*/
        return $this->is_right === self::IS_RIGHT_NO;
    }/*}}}*/

    public function set_is_right_yes()
    {/*{{{*/
        $this->is_right = self::IS_RIGHT_YES;
    }/*}}}*/

    public function set_is_right_no()
    {/*{{{*/
        $this->is_right = self::IS_RIGHT_NO;
    }/*}}}*/

}
