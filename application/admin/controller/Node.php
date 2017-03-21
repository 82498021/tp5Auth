<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 17/3/19
 * Time: 21:49
 */

namespace shop\admin\Controller;


use shop\admin\model\UserAccess;


class Node extends Check
{

    function index()
    {


        $list = UserAccess::where(-1)->order('status asc,module asc,controller asc,action asc')->paginate($this->pageConfig['list_rows']);

        return $this->fetch('', ['list' => $list]);
    }


    function add($pid = 0)
    {

        if ($_POST) {
            if (!empty(UserAccess::addData($_POST))) {
                $this->success("信息添加成功", url('index'));
            } else {
                $this->error("信息添加失败");
            }
        }

        $access = [
            'module' => '',
            'action' => '',
            'controller' => ''
        ];

        if ($pid > 0) {
            $access = UserAccess::get($pid);
        }

        return $this->fetch('', ['data' => $access,'pid'=>$pid]);
    }


    function update($id)
    {
        if($id<=0){
            $this->error('您提供的参数不正确');
        }


        if($_POST){
            if(UserAccess::update($_POST)){
                $this->success('更新成功!',url("index"));
            }else{
                $this->error("更新失败!");
            }
        }

        $data=UserAccess::get($id);

        return $this->fetch('',['data'=>$data]);
    }


    function delete($id)
    {
        if(UserAccess::where(['id'=>$id])->delete()){
            $this->success('信息删除成功!');
        }else{
            $this->error("信息删除失败!");
        }
    }


}