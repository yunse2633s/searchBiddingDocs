<?php
namespace Home\Model;
use Think\Model;

class IndexModel extends Model{public function search(){
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