<?php
namespace Home\Model;
use Think\Model;

class SearchhotModel extends Model{
    protected $_validate = array(
            array('search_hot','require','搜索词不能为空',1),
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
    public function similar($search){
        $where = "search_hot like '%$search%'";
        $result = $this->where($where)->limit(0,5)->field('search_hot')->select();
        return json_encode($result);      
    }
    public function cookie_id($id){
        if(cookie('infoid')){ 
            $uns_infoid = cookie('infoid');
            $uns_infoid .=','.$id;
            $tmp = array_unique(explode(',',$uns_infoid));
            $uns_infoid = join(',',$tmp);
            setcookie('infoid',$uns_infoid,time()+3600,'/');
        }else{
            setcookie('infoid',$id,time()+3600,'/');
        }
    }
}