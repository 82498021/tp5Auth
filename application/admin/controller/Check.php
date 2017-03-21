<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 17/3/18
 * Time: 22:39
 * 权限验证
 */

namespace shop\admin\Controller;


use auth\Auth;
use think\Controller;
use think\Config;

class Check extends Controller
{
    protected $pageConfig;

    protected $userInfoKEY;

    // 初始化
    protected function _initialize()
    {
        $this->pageConfig=Config::get("paginate");

        $this->userInfoKEY=Config::get('USER_AUTH_KEY');

        $auth=Auth::instance();

        $dispatch = $this->request->dispatch();

        $activeRouter = $dispatch['module']['0'] . '/' . $dispatch['module'][1] . '/' . $dispatch['module'][2];

        $msg=$auth->check($activeRouter);

        if($msg['status']==false){
            if($msg['login']){
                $this->error($msg['msg'],url('login/index'));
            }else{
                $this->error($msg['msg']);
            }
            die;
        }

    }

}