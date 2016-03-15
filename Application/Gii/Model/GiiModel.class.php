<?php
namespace Gii\Controller;
use Think\Controller;
class GiiModel extends Model{
    protected $_validate = array(
        array('table_name','require','必须填写表name'),
        array('module_name','require','必须填写m块name'),
    );
    public function generateCode(){
        $cDir = '.Application'.$this->module_name.'/Controller';
        $mDir = '.Application'.$this->module_name.'/Model';
        $vDir = '.Application'.$this->module_name.'/View';
        if(is_dir($cDir)){
            mkdir($cDir,0777,TRUE);
        }
        if(is_dir($mDir)){
            mkdir($mDir,0777,TRUE);
        }
        if(is_dir($vDir)){
            mkdir($vDir,0777,TRUE);
        }
    }
}