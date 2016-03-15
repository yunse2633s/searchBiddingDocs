<?php
namespace Admin\Model;
use Think\Model;

class LimitsModel extends Model{
    protected $_validate = array(
            array('provinceid','require','省份id不能为空',1),
            array('endtime','require','截止时间不能为空',1),
            array('status','require','开通状态不能为空',1),
            );
    protected function _before_insert(&$data, $option){
        $data['endtime'] = strtotime($data['endtime']);
    }

    protected function _before_update(&$data, $option){
        $data['endtime'] = strtotime($data['endtime']);
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