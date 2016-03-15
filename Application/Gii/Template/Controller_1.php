namespace #$moduleName#\Controller;
use Think\Controller;

class #$mvcName# extends Controller{
    public function add(){
        if(IS_POST){
            $model = D('#$mvcName#');
            if($model->create()){
                if($model->add()){
                    $this->error("true",U('lst'));
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
     public function save($id){
        $model = D('#$mvcName#');
        if(IS_POST){
              if($model->create()){
                if($a = $model->save() !== FALSE){
                    $this->error("true",U('lst'));
                    exit;
                }else{
                    $this->error("flase");
                }
            }else{
                $this->error($model->getError());
            }
        }
        $data = $model->find($id);
        $this->assign('data',$data);
        $this->display();
    }
    public function lst(){
        $model = D('#$mvcName#');
        $data = $model->search();
        $this->assign(array(
                'data' => $data['data'],
                'page' => $data['page'],
                ));
        $this->display();
    }
    
    public function del($id){
        $model = M('#$mvcName#');
        $model->delete($id);
        $this->success('true');
    }
    public function bdel(){
        $dels = I('post.delid');
        if($dels){
            $dels = implode(',', $dels);
            $model = M('#$mvcName#');
            $model->delete($dels);
            }
    }
    public function vmform(){
        $this->display();
    }
}