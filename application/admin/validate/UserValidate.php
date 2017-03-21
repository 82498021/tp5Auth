<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 17/3/21
 * Time: 09:22
 */

namespace shop\admin\validate;


use shop\admin\model\User;
use think\Validate;

class UserValidate extends Validate
{
    protected $rule = [
        'phone|手机号' =>  'require|checkPhone|checkSql',
        'captcha|验证码'=>'require|captcha',
        'password|密码'=>'require',
        'passwd|确认密码'=>'require|confirm:password'
    ];

    protected $message = [
        'phone.checkPhone'  =>  '手机号码输入错误!',
        'phone.checkSql'  =>  '手机号码已存在!',
        'passwd.confirm'  =>  '两次密码输入的不一致!'
    ];

    function checkPhone($data){
      return  preg_match("/^1[3-9]{1}\d{9}$/",$data)!=0;
    }


    function checkSql($data){
        return User::where(['phone'=>$data])->count()==0;
    }

    protected $scene = [
        'add'  =>  ['phone','password','passwd'],
        'login'=>['captcha']
    ];


}