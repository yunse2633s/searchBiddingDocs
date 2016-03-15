<?php
namespace Home\Controller;
use Think\Controller;

class FavoritesController extends Controller{
    public function add(){
        if(IS_POST){
            $model = D('Favorites');
            if($model->create()){
                if($model->add()){
                    $this->success("true",U('lst'),1);
                    exit;
                }else{
                    $this->error("flase");
                }
            }else{
                $this->error($model->getError());
            }
        }
        $this->display();
    }
     
}