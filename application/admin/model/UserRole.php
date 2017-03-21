<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 17/3/20
 * Time: 14:55
 */

namespace shop\admin\model;


use think\Model;

class UserRole extends Model
{
    protected $insert = ['create_time'];

    protected function setCreateTimeAttr()
    {
        return time();
    }
}