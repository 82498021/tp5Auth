<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 17/3/18
 * Time: 22:42
 */

namespace shop\admin\Controller;


use shop\admin\model\User;
use think\Controller;

class Login extends  Controller
{

    function index(){

        if($_POST){

            $data=$this->validate($_POST,"UserValidate.login");

            if($data!==true){
                $this->error($data);
            }
            $info=User::checkLogin($_POST,1);

            if($info['status']){
                $this->success("登录成功!",url('index/index'));
            }else{
                $this->error($info['msg']);
            }

        }


        return $this->fetch();
    }

}