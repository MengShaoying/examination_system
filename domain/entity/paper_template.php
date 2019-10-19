<?php

class paper_template extends entity
{
    public $structs = [
        'title' => '',
    ];

    public static $entity_display_name = '试卷模版';
    public static $entity_description = '管理试卷模版';

    public static $struct_types = [
        'title' => 'text',
    ];

    public static $struct_display_names = [
        'title' => '标题',
    ];

    public static $struct_descriptions = [
        'title' => '标题',
    ];

    public static $struct_formats = [
        
    ];

    public static $struct_format_descriptions = [
        
    ];

    public function __construct()
    {/*{{{*/
        
    }/*}}}*/

    public static function create()
    {/*{{{*/
        return parent::init();
    }/*}}}*/

}