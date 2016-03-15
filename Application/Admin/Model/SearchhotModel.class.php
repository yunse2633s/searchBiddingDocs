<?php
namespace Admin\Model;
use Think\Model;

class SearchhotModel extends Model{
    protected $_validate = array(
            array('search_hot','require','搜索词不能为空',1),
            );
    protected function _before_insert(&$data, $option){
        $data['search_time'] = time();
    }
    protected function _before_update(&$data, $option){
    }
    public function search(){
        $where = 1;
        $perpage = 15;
        $totalRecord = $this->where($where)->count();
        $page = new \Think\Page($totalRecord, $perpage);
        return array(
            'data' => $this->where($where)->order('id desc')->limit($page->firstRow, $page->listRows)->select(),
            'page' => $page->show(),
            );
    }
}