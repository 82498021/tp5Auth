<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 17/3/20
 * Time: 16:34
 */

namespace shop\admin\model;


use think\Config;
use think\Model;
use think\Session;

class User extends Model
{
    protected $insert = ['create_time','uuid','last_time','password'];

    protected $update = ['last_time','password'];

    protected function setCreateTimeAttr()
    {
        return time();
    }

    protected function setPasswordAttr($data)
    {
        return encryption($data);
    }

    protected function setLastTimeAttr()
    {
        return time();
    }

    protected function setUuidAttr(){
        return createUUid();
    }

    public function role()
    {
        return $this->belongsToMany('UserRole','user_role_group','role_id','user_id');
    }

    /**
     *后台验证
     */
    public static function checkLogin($data,$cate=2){

        $user=self::where(['phone'=>$data['username'],'cate'=>$cate])->find();

        if(empty($user)){
            return ['status'=>false,'msg'=>'您输入的账户不存在!'];
        }

        if($user->password!=encryption($data['password'])){
            return ['status'=>false,'msg'=>'您输入的密码不正确!'];
        }

        Session::set(Config::get("USER_AUTH_KEY"),[
            'id'=>$user->id,
            'phone'=>$user->phone,
            'nick_name'=>$user->nick_name
        ]);

        return ['status'=>true];
    }




}