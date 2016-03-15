<?php
namespace Admin\Model;
use Think\Model;

class InfosModel extends Model{
    protected $_validate = array(
            array('provinceid','require','省份ID不能为空',1),
            array('title','require','项目标题不能为空',1),
            array('content','require','项目内容不能为空',1),
            array('ownerunit','require','发布单位不能为空',1),
            array('ownercontacts','require','发起者不能为空',1),
            array('ownerphone','require','联系方式不能为空',1),
            array('biddingunit','require','招标单位不能为空',1),
            array('biddingcontacts','require','招标联系人不能为空',1),
            array('biddingphone','require','招标办电话不能为空',1),
            array('biddingstatusid','require','招标状态ID不能为空',1),
            );
    protected function _before_insert(&$data, $option){
        $data['putDatetime'] = strtotime($data['putDatetime']);
        $data['biddingdatetime'] = strtotime($data['biddingdatetime']);
        $data['createDatetime'] = time();
            }
    protected function _before_update(&$data, $option){
        if($data['putDatetime'] || $data['putDatetime']){
            $data['putDatetime'] = strtotime($data['putDatetime']);
            $data['biddingdatetime'] = strtotime($data['biddingdatetime']);  
        }
        $data['createDatetime'] = time();
    }
    public function search(){
        $where = 1;
        $perpage = 5;
        $totalRecord = $this->where($where)->count();
        $page = new \Think\Page($totalRecord, $perpage);
        return array(
            'data' => $this->where($where)->order('infoid desc')->limit($page->firstRow, $page->listRows)->select(),
            'page' => $page->show(),
            );
    }
}