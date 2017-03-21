<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 17/3/18
 * Time: 22:12
 */

namespace shop\admin\Controller;


use think\Session;

class Index extends Check
{

    function index(){

        return  $this->fetch();
    }

    function main(){

        return $this->fetch();
    }


}