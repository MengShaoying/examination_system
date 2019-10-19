<?php

class account extends entity
{
    public $structs = [
        'name' => '',
        'password' => '',
    ];

    public static $entity_display_name = '账号';
    public static $entity_description = '管理登录所使用的账户';

    public static $struct_types = [
        'name' => 'text',
        'password' => 'text',
    ];

    public static $struct_display_names = [
        'name' => '姓名',
        'password' => '密码',
    ];

    public static $struct_descriptions = [
        'name' => '姓名',
        'password' => '密码',
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