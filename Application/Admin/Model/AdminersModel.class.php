<?php
namespace Admin\Model;
use Think\Model;

class AdminersModel extends Model{
    protected $_validate = array(
            array('adminname','require','管理员账号不能为空',1),
            array('password','require','密码不能为空',1),
            );
    protected function _before_insert(&$data, $option){
        $data['password'] = md5($data['password']);
    }
    protected function _before_update(&$data, $option){
        if($data['password']){
            $data['password'] = md5($data['password']);
        }else{
            unset($data['password']);
        }    
    }
    public function logout(){
        session('userS',NULL);
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