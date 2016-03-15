<?php
namespace Admin\Model;
use Think\Model;

class ProvinceModel extends Model{
    protected $_validate = array(
            );
    protected function _before_insert(&$data, $option){
            }
    protected function _before_update(&$data, $option){
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