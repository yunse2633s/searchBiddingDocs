<?php
namespace Gii\Controller;
use Think\Controller;
/**
*     知识点
* 1、如何从内存中读写数据
* 2、如何改写模板文件
* 3、如果制作模板生成器
*/
class IndexController extends Controller{
    public function index(){
        //显示表单
        if(IS_POST){
          //获取post提交的数据
            $tableName = I('post.table_name');//数据库表名
            $moduleName = I('post.module_name');//预计存放的模块目录名
            if($tableName && $moduleName){
                #首字大写，将首字母大写
                $moduleName=  ucfirst($moduleName);
                #构造模型、控制器、视图3个目录的路径
                $cDir = './Application/'.$moduleName.'/Controller';
                $mDir = './Application/'.$moduleName.'/Model';
                $vDir = './Application/'.$moduleName.'/View';
                #分别判断3目录是否存在，并进行创建
                if(!is_dir($cDir)){
                    mkdir($cDir,0777,TRUE);
                }
                if(!is_dir($mDir)){
                    mkdir($mDir,0777,TRUE);
                }
                if(!is_dir($vDir)){
                    mkdir($vDir,0777,TRUE);
                }
            /**********生成模型、控制性文件的前缀和视图的文件名称*****************/
               $mvcName = $this->_tableNameToMVCName($tableName);
               /*
                * 读《控制器》模板文件
                * 第1种开启ob_start()缓冲区 
                */
               ob_start();#开启缓冲区,将页面主体存储与内存中;
               #dirname获取当前文件的位置，
               #使用substr()从字符串中提取子字符串
               #在include()中构成出一个连接地址
               include(substr(dirname(__FILE__), 0,-10).'Template/Controller.php');
               $str = ob_get_clean();#将缓存区数据存入$str 并清除缓冲区；
               #将缓冲区的字符串改写后输出；
               file_put_contents($cDir.'/'.$mvcName.'Controller.class.php',"<?php\r\n".$str);
               /*
                * 第2种读板文件的方法
                */
//               $str = file_get_contents(substr(dirname(__FILE__), 0,-10).'Template/Controller.php');
//               $str = str_replace('#$moduleName#',$moduleName,$str);
//               $str = str_replace('#$mvcName#',$mvcName,$str);
//               file_put_contents($cDir.'/'.$mvcName.'Controller.class.php',"<?php\r\n".$str);
               
               $db = M();//创建一个空对象
               //出错，M()不能实现创建空对象，检测后，发现同级路径下的数据库配置缺失
               $files = $db->query("show full fields from ".$tableName);
              // echo "<pre>";
              // print_r($files);
               /***********生成《模型》模板文件*********/
               ob_start();
               include(substr(dirname(__FILE__), 0,-10).'Template/Model.php');
               $str = ob_get_clean();
               file_put_contents($mDir.'/'.$mvcName.'Model.class.php',"<?php\r\n".$str);
               /** 生成3个《静态页》模板文件所在的路径 判断若路径不存在，则创建*/
               if( ! is_dir( $vDir.'/'.$mvcName ) ){
                   mkdir($vDir.'/'.$mvcName,-777,TRUE);
               }
               /*
                * add.html
                */
               ob_start();
               include(substr(dirname(__FILE__), 0,-10).'Template/add.html');
               $str = ob_get_clean();
               file_put_contents($vDir.'/'.$mvcName.'/add.html',$str);
               /*
                * save.html
                */
               ob_start();
               include(substr(dirname(__FILE__), 0,-10).'Template/Save.html');
               $str = ob_get_clean();
               file_put_contents($vDir.'/'.$mvcName.'/Save.html',$str);
               /*
                * Lst.html
                */
               ob_start();
               include(substr(dirname(__FILE__), 0,-10).'Template/Lst.html');
               $str = ob_get_clean();
               file_put_contents($vDir.'/'.$mvcName.'/Lst.html',$str);
              /**
              * 增加一个set字段
              */
              //alter table demo_goods add sets set('选项1','选项2','选项3','选项4');
            }
//            $model = D('Gii');//调用表单验证，无结果
//            if($model->create()){
//                $model->generateCode();
//            }else{
//                $this->error($model->getError());
//            }
            //生成控制器
            //接收表 和路径
        }
        $this->display();
    }
      /*
       * 计算控制器name
       * 获取 系统配置的前缀 长度，
       * 替换用户输入的前缀
      */
    private function _tableNameToMVCName($tableName){
        //去掉前缀
      /**
      * 调用C()函数，获取前缀配置信息，
      * 使用str_replace()函数去掉表前缀；
      *使用explode()函数将带有下划线的表分解为数组
      *使用array_map将数组中的各值首字母大写
      *返回 implode()函数将数组转换为字符串
      */
        $tableName = str_replace(C('DB_PREFIX'),'',$tableName);
        //去掉下划线
        $tableName = explode('_', $tableName);
        //将数组中值都使用ucfirst
        $tableName = array_map('ucfirst', $tableName);
        //将数组内字符合并
        return implode('', $tableName);
        
    }
   
}