<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 17/3/18
 * Time: 22:23
 */

return [


    'view_replace_str' => [
        'CSS' => '/style/admin/css',
        'JS' => '/style/admin/js',
        'IMAGES' => '/style/admin/images'
    ],


    'auth' => [
        'auth_on' => true, // 权限开关
        'auth_type' => false, // 认证方式，true为实时认证；false为登录认证。
        'auth_super_admin' => [10], //超级用户
        'auth_session_key' => 'auth_session_key',//储存用户权限name
        'auth_group' => 'user_role', // 用户组数据表名
        'auth_user_rule' => 'user_role_group', // 用户-用户组关系表
        'auth_access' => 'user_access', // 权限规则表
        'auth_user' => 'user', // 用户信息表
    ],


    //分页配置
    'paginate' => [
        'type' => 'Page',
        'var_page' => 'page',
        'list_rows' => 20,
    ],

    //管理权限
    'USER_AUTH_KEY' => 'asdfhkj_kjadskfj_amsdfk'

];