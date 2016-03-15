<?php
namespace Home\Controller;
//namespace Components;
use Think\Controller;

class SearchhotController extends Controller{
    public function search(){
        if(I('post.')){ 
            var_dump(I('post.'));
            die;
        }
        $model = D('province');
        $optgroup = "group_concat(provinceid) as proid,group_concat(provincename) as proname,optgroup";
        $prodata = $model->field($optgroup)->group('optgroup')->where('pid=0')->select();
        if($_COOKIE['search']){
            $search_array = unserialize($_COOKIE['search']);
        }
        $this->assign(array(
            'prodata'   =>  $prodata,
            'search_array'  =>  $search_array
            ));
        $this->display();

    }
        

    public function records(){
        if(I('post.search') || I('get.search')){
        $str_multi_province = I('post.provinceid') ? implode(',',I('post.provinceid')) : I('get.provinceid');
        $search_word = I('post.search') ? I('post.search') : I('get.search');
        $this->add($search_word);
        $search_modle = D('infos');
        
        $search_modle->cookie_push($search_word,$str_multi_province);
        $data = $search_modle->search_result($search_word,$str_multi_province);
        $this->assign(array(
            'multi_province'=>$str_multi_province,
            'search_word'=>$search_word,
            'data' => $data['data'],
            'page' => $data['page']
            ));

            $this->display('search1');
        }else if(I('post.search')=="" || I('get.search')==""){
        	$this->display('search');
    	}else{
    		$this->error('丢失数据了',U('search'),1);	
    	}        
    }
    public function ajax_records($search,$pro=''){
        $str_multi_province = $pro;
        $search_word = $search;
        $search_modle = D('infos');
        $search_modle->cookie_push($search_word,$str_multi_province);
        $data = $search_modle->search_result($search_word,$str_multi_province);
        $this->assign(array(
            'multi_province'=>$str_multi_province,
            'search_word'=>$search_word,
            'data' => $data['data'],
            'page' => $data['page'],
            ));

            $this->display('search1');
    }
    public function add($search){
            $model = D('Searchhot');
            $data['search_hot'] = $search;
            $where = "search_hot='$search'";
            $d = $model->where($where)->select();
            if($d){ 
                $model->where($where)->setInc('hit_heat');

            }else{
                $model->add($data);
            }
            
    }
    public function ajax_similar_search($search){
        $ass_model = D('Searchhot');
        echo $ass_model->similar($search);
    }
    public function ajax_province(){
        $model = D('province');
        $optgroup = "group_concat(provinceid) as proid,group_concat(provincename) as proname,optgroup";
        $prodata = $model->field($optgroup)->group('optgroup')->where('pid=0')->select();
        foreach ($prodata as $k2 => $v2) {
            $pid = explode(',',$v2['proid']);
            $proname = explode(',',$v2['proname']);
            $newarray = array_combine($pid,$proname);
            $new_prodata[$v2['optgroup']] = $newarray;
        }
        echo json_encode($new_prodata);
    }
   public function ceshi2(){
        $cl = new \Components\SphinxClient();
        $cl->SetServer ( '127.0.0.1', 9312);
        $cl->SetConnectTimeout ( 3 );
        $cl->SetArrayResult (false);
        $cl->SetMatchMode(SPH_MATCH_ANY);
        $res = $cl->Query($words);
        if(isset($res['matches'])){
           $id = array_keys($res['matches']);
           $idstr = implode(",", $id);
        }
        $infomodel = D('infos');
        $result = $infomodel->where("infoid in ($idstr)")->count();
        var_dump($result);die;
        return $result;
   }
   public function view($id){
        D('searchhot')->cookie_id($id);
        $infomodel = D('infos');
        $info_data = $infomodel->find($id);
        $this->assign('info_data',$info_data);
        $this->display();
   }
}