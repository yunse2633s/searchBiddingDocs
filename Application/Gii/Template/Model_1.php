namespace <?php echo $moduleName;?>\Model;
use Think\Model;

class <?php echo $mvcName;?>Model extends Model{
    protected $_validate = array(
        <?php 
            foreach($files as $key => $v):
//             if($v['key'] == 'PRI'){
//             continue;}else{
//             if($v['null']=='NO' && $v['Default']==NULL):
                if($v['key'] == 'PRI')  //如果是索引则跳出
                    continue;
                //建表时，如果default为空，null为no 则不进行验证
//                if($v['null'] == 'no' && $v['Default']=='NULL'):  //大小写问题;
                if($v['null']=='NO' && $v['Default']==NULL && strpos($v['type'],'set') === FALSE){
        ?>
    array('<?php echo $v['field'];?>','require','<?php echo $v['comment'];?>不能为空',1),
                <?php }else if( strpos($v['type'],'set') === 0 ){?>
    array('<?php echo $v['field'];?>','array_sum','<?php echo $v['comment'];?>不能为空',1,'function'),                
                <?php } endforeach;?>
    <?php foreach($files as $key => $v){
         //做2次循环，下列循环做不唯一验证与其他验证
        //假设为唯一键，则创建唯一验证 
        if($v['key'] == 'UNI'){?>
    array('<?php echo $v['field'];?>','require','<?php echo $v['comment'];?>不能为空',1,unique),
       <?php } } ?>
    );
        
        protected function _before_insert(&$data, $option){
            <?php 
            foreach($files as $key => $v){
                if(  strpos($v['type'],'set') === 0 ){
                    echo '$data["'.$v['field'].'"] = array_sum($data["'.$v['field'].'"]);';
                }
            }
            ?>
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
}