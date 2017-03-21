<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 17/3/20
 * Time: 16:33
 */

namespace shop\admin\Controller;


use shop\admin\model\User;
use shop\admin\model\UserRole;
use shop\admin\model\UserRoleGroup;


class Manage extends Check
{
    /**
     * 管理员类型
     * @var int
     */
    private $cate=1;

    /**
     * 会员列表
     */
    function index()
    {

        $list= User::where(['cate'=>$this->cate])->order("status asc,id desc")->paginate($this->pageConfig['list_rows']);

        return $this->fetch('',['list'=>$list]);

    }

    /**
     * 新增管理员
     */
    function add()
    {
        if ($_POST) {

            $data=$this->validate($_POST,"UserValidate.add");

            if($data!==true){
                $this->error($data);
            }

            $user=new User($_POST);

            $user->cate=$this->cate;

            if ($user->allowField(true)->save()) {

                $group=new UserRoleGroup();

                $group->saveAll($this->regroup($_POST['roles'],$user->id));

                $this->success("管理员添加成功", url('index'));
            } else {
                $this->error($user->getError());
            }
        }

        $list=UserRole::where(['status'=>1])->select();

        return $this->fetch('',['list'=>$list]);
    }

    /**
     * 数据重组
     * @param $data
     * @param $id
     * @return array
     */
    private function regroup($data,$id){
        $arr=[];

        foreach($data as $val){
            $arr[]=[
                'user_id'=>$id,
                'role_id'=>$val
            ];
        }

        return $arr;
    }


    /**
     * 修改管理员信息
     */
    function update($id)
    {

        if($_POST){
            $user=new User();

            $roles=isset($_POST['roles'])?$_POST['roles']:[];

            unset($_POST['roles']);

            if ($user->allowField(true)->save($_POST,['id'=>$id])) {

                UserRoleGroup::where(['user_id'=>$id])->delete();

                $group=new UserRoleGroup();

                $group->saveAll($this->regroup($roles,$id));

                $this->success("管理员修改成功", url('index'));
            } else {
                $this->error($user->getError());
            }
        }


        $data=User::get($id);

        $list=UserRole::where(['status'=>1])->select();

        $roles=UserRoleGroup::where('user_id',$id)->column('role_id');

        return $this->fetch('',['list'=>$list,'data'=>$data,'roles'=>$roles]);
    }

    /**
     * 删除管理员
     */
    function delete()
    {

    }


}