<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 17/3/20
 * Time: 14:49
 */

namespace shop\admin\Controller;


use shop\admin\model\UserAccess;
use shop\admin\model\UserRole;

class Role extends Check
{


    function index(){

       $list= UserRole::where(-1)->order("id desc")->paginate($this->pageConfig['list_rows']);

       return $this->fetch('',['list'=>$list]);
    }


    function add(){
        if ($_POST) {

            $role=new UserRole($_POST);

            if ($role->save()) {
                $this->success("信息添加成功", url('index'));
            } else {
                $this->error("信息添加失败");
            }
        }
        return $this->fetch();
    }

    function update($id){
        if($id<=0){
            $this->error('您提供的参数不正确');
        }

        if($_POST){
            if(UserRole::update($_POST)){
                $this->success('更新成功!',url("index"));
            }else{
                $this->error("更新失败!");
            }
        }
        $data=UserRole::get($id);

        return $this->fetch('',['data'=>$data]);
    }

    /**
     * 权限分配
     */
    function access($id){

        if($_POST){

            if(UserRole::where(['id'=>$_POST['id']])->update(['access'=>implode(',',$_POST['ids'])])){
                $this->success('权限设置成功!',url('index'));
            }else{
                $this->error("权限设置失败!");
            }
        }

        $list=UserAccess::where(['pid'=>0])->select();

        return $this->fetch('',['list'=>$list,'id'=>$id]);
    }



    function delete($id){
        if(UserRole::where(['id'=>$id])->delete()){
            $this->success('信息删除成功!');
        }else{
            $this->error("信息删除失败!");
        }
    }




}