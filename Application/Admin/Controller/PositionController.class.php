<?php
namespace Admin\Controller;
USE Think\Controller;

/**
 * 后台推荐位相关
 */
class PositionController extends CommonController{

	public function index(){

		$data['status'] = array('neq',-1);
		$data['status'] = array('neq',-1);
		$positions = D("Position")->select($data);
		$this->assign('positions',$positions);
		$this->assign('nav','推荐位管理');
		$this->display();
	}
}