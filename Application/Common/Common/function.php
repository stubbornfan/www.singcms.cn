<?php
/**
 * Created by PhpStorm.
 * 公用的方法
 * User: frank
 * Date: 2017-08-04
 * Time: 上午 11:42
 */

function show( $status,$message,$data =array() ){
    $result = array(
        'status'=>$status,
        'message'=>$message,
        'data'=>$data,
    );
    exit( json_encode( $result ) );
}
//密码加密
function getMd5Password( $password ){
    return md5($password.C('MD5_PRE'));
}