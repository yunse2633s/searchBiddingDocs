<?php
namespace Admin\Model;
use Think\Model;

class UsersModel extends Model{
    protected $_validate = array(
            array('username','require','用户名不能为空',1),
            array('openid','require','公钥不能为空',1),
            );
    protected function _before_insert(&$data, $option){
        $data['createdatetime']=time();
    }
    protected function _before_update(&$data, $option){
        $data['modifytime']=time();
    }
    public function search(){
        $where = 1;
        $perpage = 15;
        $totalRecord = $this->where($where)->count();
        $page = new \Think\Page($totalRecord, $perpage);
        return array(
            'data' => $this->where($where)->limit($page->firstRow, $page->listRows)->select(),
            'page' => $page->show(),
            );
    }
}