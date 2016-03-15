<?php
namespace Admin\Model;
use Think\Model;

class SubjectModel extends Model{
    protected $_validate = array(
            array('subject','require','专题名不能为空',1),
            );
    private function _upload(){
         $config = array(
        'maxSize'       =>  1048576,
        'exts'          =>  array('jpg', 'gif', 'png', 'jpeg'),
        'rootPath'      =>  './Uploads/',
        'savePath'      =>  'Subject/',
        );
        $files_modle = new \Think\Upload($config);
        $info = $files_modle->upload();
        $logo = $info['subc_img']['savepath'].$info['subc_img']['savename'];
        $thumbModel = new \Think\Image();
        $thumbModel->open('./Uploads/'.$logo);
        $array = explode('/',$logo);
        $array[2]='thumb_'.$array[2];
        $thumb = join('/',$array);
        $thumbPath = $thumbModel->thumb(C('SUBJECT_IMG_WIDTH'),C('SUBJECT_IMG_HEIGHT'),\Think\Image::IMAGE_THUMB_FIXED)->save('./Uploads/'.$thumb);
        return array(
            'origin' => $logo,
            'thumb' => $thumb
            );
    }
    protected function _before_insert(&$data, $option){
        if(isset($_FILES['subc_img']) && $_FILES['subc_img']['tmp_name']){            
            $array = $this->_upload();
            $data['subc_img'] = $array['origin'];
            $data['thumb_img'] = $array['thumb'];
        }
        if(isset($data['subc_info'])){
            $data['subc_info'] = implode(',',$data['subc_info']);
        }
    }
    protected function _before_update(&$data, $option){
        if(isset($data['subc_info'])){
            if(is_array($data['subc_info'])){
                $data['subc_info'] = implode(',',$data['subc_info']);    
            }            
        }
        if(isset($_FILES['subc_img']) && $_FILES['subc_img']['tmp_name']){
            $ylogo = $this->field('subc_img,thumb_img')->find(I('get.id'));
            @unlink('./Uploads/'.$ylogo['subc_img']);
            @unlink('./Uploads/'.$ylogo['thumb_img']);
            $array = $this->_upload();
            $data['subc_img'] = $array['origin'];
            $data['thumb_img'] = $array['thumb'];
        }

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
    public function infoTosubject(){
        $data['id']=I('post.id');
        $subc_info = $this->field('subc_info')->find(I('post.id'));
        if($subc_info['subc_info'] === NULL){
            var_dump('feild is null');
            $data['subc_info']=I('post.subc_info');
        }else{
            $temp_str = explode(',',$subc_info['subc_info']);
            $temp_post = explode(',',I('post.subc_info'));
            $temp_arry = array_merge($temp_str,$temp_post);
            $temp = array_unique($temp_arry);
            $data['subc_info'] = implode(',',$temp);
        }
        $resurt = $this->save($data);
        if($resurt){echo 'success';}else{echo 'false';}

    }
}