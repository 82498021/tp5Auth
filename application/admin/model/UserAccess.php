<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 17/3/19
 * Time: 21:54
 */

namespace shop\admin\model;


use think\Model;

class UserAccess extends Model
{
    /**
     * 新增数据并按照id赋值给sort
     * @param $post
     * @return mixed
     */
    public static function addData($post)
    {
        $data=new UserAccess($post);

        $data->save();

        $data->allowField(['sort'])->where(['id'=>$data->id])->update(['sort'=>$data->id]);

        return $data->id;
    }

    public function access()
    {
        return $this->hasMany('user_access','pid','id');
    }

}