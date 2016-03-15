<?php
namespace Home\Model;
use Think\Model;

class InfosModel extends Model{

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
    public function ishot(){
      return $this->limit(0,6)->where('is_hot=1')->field('infoid,title,CONCAT(substring(content,1,15),"...") as content')->select();
    }

    public function browsinfo($id){
        if($id){
            $re = $this->where("infoid in ($id)")->field('infoid,title,CONCAT(substring(content,1,15),"...") as content')->select();        
            
            return $re;
        }
    }

    public function search_result($search,$provinceid=''){
        if($provinceid ==''){
           $where = 'title like "%'.$search.'%" and is_on_sale=1';    
        }else{
            $where = 'provinceid in('.$provinceid.') and title like "%'.$search.'%" and is_on_sale=1';    
        }

        $perpage = 3;
        $totalRecord = $this->where($where)->count();
        $parameter=array(
            'search'=>$search,
            'provinceid'=>$provinceid
            );
        $page = new \Think\Page($totalRecord, $perpage,$parameter);
        return array(
            'data' => $this->field('infoid,provinceid,title,content')->where($where)->limit($page->firstRow, $page->listRows)->select(),
            'page' => $page->show(),
            );
    }
    public function cookie_push($str,$pro){
        if($str != ""){
        $array = array($str,1,$pro);
        if(cookie('search')){
            $ary_unserialize = unserialize($_COOKIE['search']);
            $flag = 1;
            for($i=0;$i<count($ary_unserialize);$i++){
                if(array_search($str,$ary_unserialize[$i])!==false){
                      $ary_unserialize[$i][1]++;
                      $flag = 0;
                      $serialize_str = serialize($ary_unserialize);
                      setcookie('search',$serialize_str,time()+3600,'/');
                      break;
                }
            }
             if(count($ary_unserialize) > 5){
                array_shift($ary_unserialize);
                $serialize_str = serialize($ary_unserialize);
                setcookie('search',$serialize_str,time()+3600,'/');
              } else if($flag == 1){ 
                $array = array($array);
                $serialize_str = serialize(array_merge($ary_unserialize,$array));
                setcookie('search',$serialize_str,time()+3600,'/');

            }
        }else{
            $array2 = array($array);
            $serialize_str = serialize($array2);
            setcookie('search',$serialize_str,time()+3600,'/');
        }
    }}
}