<?php
namespace Home\Model;
use Think\Model;

class SubjectModel extends Model{
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
    public function total(){
        
        $sql = 'select count(*) as total from zr_subject';
        return $this->query($sql);
    }
    public function subject_img(){
        return $this->limit(0,4)->field('id,thumb_img')->select();

    }
    public function subimg(){
        return $this->field('thumb_img')->select();
    }
    

}