<?php

class account extends entity
{
    public $structs = [
        'name' => '',
        'password' => '',
        'role' => '',
    ];

    public static $entity_display_name = '账号';
    public static $entity_description = '管理登录所使用的账户';

    public static $struct_types = [
        'name' => 'text',
        'password' => 'text',
        'role' => 'enum',
    ];

    public static $struct_display_names = [
        'name' => '姓名',
        'password' => '密码',
        'role' => '角色',
    ];

    public static $struct_descriptions = [
        'name' => '姓名',
        'password' => '密码',
        'role' => '角色',
    ];

    const ROLE_ADMIN = 'ADMIN';
    const ROLE_TEACHER = 'TEACHER';
    const ROLE_STUDENT = 'STUDENT';

    const ROLE_MAPS = [
        self::ROLE_ADMIN => '管理员',
        self::ROLE_TEACHER => '老师',
        self::ROLE_STUDENT => '考生',
    ];

    public static $struct_formats = [
        'role' => self::ROLE_MAPS,
    ];

    public static $struct_format_descriptions = [
        'role' => '',
    ];

    public function __construct()
    {/*{{{*/
        
    }/*}}}*/

    public static function create()
    {/*{{{*/
        return parent::init();
    }/*}}}*/

    public function get_role_description()
    {/*{{{*/
        return self::ROLE_MAPS[$this->role];
    }/*}}}*/

}
