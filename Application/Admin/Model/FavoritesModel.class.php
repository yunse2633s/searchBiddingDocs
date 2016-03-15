<?php
namespace Admin\Model;
use Think\Model;

class FavoritesModel extends Model{
    protected $_validate = array(
            array('userid','require','用户id不能为空',1),
            array('infoid','require','项目数据id不能为空',1),
            array('createdatetime','require','创建时间不能为空',1),
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