<?php
namespace Admin\Model;
use Think\Model;
class BaseModel extends Model {
       public function BTree($data,$pid=0){
           return $this->_resort($data,$pid);        
       }
       protected function _resort($data,$pid=0,$lev=0){
           static $res = array();
           foreach($data as $k=>$v){
               if($v['parent_id'] == $pid){
                   $v['lev'] = $lev;
                   $res[] = $v;
                   $this->_resort($data,$v['id'],$lev+1);
               }
           }
           return $res;
       }
       public function BgetChildrenId($id){
           $data = $this->field('id,parent_id')->select();
           return  $this->_getChindrenId($data,$id,TRUE);
       }
       private function _getChindrenId($data,$pid,$isClear = FALSE){
           static $rst = array();
           if($isClear){ $rst = array();}
           foreach($data as $v){
               if($v['parent_id'] == $pid){
                   $rst[] = $v['id'];
                   $this->_getChindrenId($data, $v['id']);
               }
           }
           return $rst;
       }
       protected function _before_delete($options) {
           if(is_array($options['where']['id'])){
               $arr = explode(',',$options['where']['id'][1]);
               $children = array();
               foreach ($arr as $v){
                   $_children = $this->BgetChildrenId($v);
                   $children = array_merge($children,$_children);
               } 
               $children = array_unique($children);
           }else{
               $children = $this->BgetChildrenId($options[where][id]);
               if($children){
                   $children = implode(',', $children);
                   $this->execute("delete from demo_privilege where id IN ($children)");
               }
           }
       }   
}
