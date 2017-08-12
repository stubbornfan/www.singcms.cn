<?php
namespace Common\Model;
use Think\Model;
/**
 * 文章内容Model操作
 */
class NewsModel extends Model{

    private  $_db='';

    public function __construct()
    {
        $this->_db = M("news");
    }

    public function insert( $data =array() ){
        if(!is_array($data) || !$data){
            return 0;
        }

        $data['create_time'] = time();
        $data['username'] = getLoginUsername();
        return $this->_db->add($data);

    }

    public function getNews($data,$page,$pageSize=10){
        $condition = $data;
        if(isset($data['title']) && $data['title'] ){
            $condition['title'] = array('like','%'.$data['title'].'%');
        }
        if( isset($data['catid']) && $data['catid'] ){
            $condition['catid'] =intval( $data['catid'] );
        }
        $condition['status'] = array('neq',-1);

        $offset = ($page -1)*$pageSize;
        $list=$this->_db->where($condition)->order('listorder desc,news_id desc')
            ->limit($offset,$pageSize)->select();
        return $list;


    }
    public function getNewsCount( $data = array() ){
        $condition = $data;
        if(isset($data['title']) &&$data['title'] ){
            $condition['title'] =array('like','%'.$data['title'].'%');
        }
        if( isset($data['catid']) && $data['catid'] ){
            $condition['catid'] =intval( $data['catid'] );
        }

        return $this->_db->where($condition)->count();


    }

    //修改页面的信息查找
    public function find($id){
        if(!is_numeric($id) ||!$id){
            return 0;
        }
        $data = $this->_db->where('news_id='.$id)->find();
        return $data;

    }

    public function updateById( $id,$data ){
        if(!$id || !is_numeric($id) ){
            throw_exception('ID不合法');
        }
        if(!$data || !is_array($data) ){
            throw_exception('数据不合法');
        }
        return $this->_db->where('news_id='.$id)->save($data);

    }

    public function updateStatusById($id,$status){
        if(!is_numeric($status)){
            throw_exception('status不能为非数字');
        }
        if(!$id || !is_numeric($id)){
            throw_exception('ID不合法');
        }
        $data['status'] =$status;
        return $this->_db->where('news_id='.$id)->save($data);

    }

    public function updateNewsListorderById($id,$listorder){
        if(!$id || !is_numeric($id) ){
            throw_exception('ID不合法');
        }
        $data = array('listorder'=>intval($listorder));
        return $this->_db->where('news_id='.$id)->save($data);
    }

    public function getNewsByNewsIdIn($newsId){
        if(!is_array($newsId)){
            throw_exception('参数不合法');
        }
        $data = array(
            'news_id'=>array('in',implode(',',$newsId)),
        );

        return $this->_db->where($data)->select();

    }

















}