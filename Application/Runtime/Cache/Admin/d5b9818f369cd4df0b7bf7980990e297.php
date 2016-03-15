<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ECSHOP 管理中心 - 添加</title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/practice/myproject/Public/Styles/general.css" rel="stylesheet" type="text/css" />
<link href="/practice/myproject/Public/Styles/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src='/practice/myproject/Public/js/jquery-1.4.4.js'></script>
<script type="text/javascript" src='/practice/myproject/Public/ueditor/ueditor.config.js'></script>
<script type="text/javascript" src='/practice/myproject/Public/ueditor/ueditor.all.min.js'></script>
<script type="text/javascript" src='/practice/myproject/Public/ueditor/lang/zh-cn/zh-cn.js'></script>
<script type="text/javascript" src='/practice/myproject/Public/ueditor/btn_config.js'></script>
</head>
<body>
<h1>
    <span class="action-span1"><a href="#">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> 添加 </span>
    <div style="clear:both"></div>
</h1>
<div class="main-div">
    <form method="post" action="/practice/myproject/index.php/Admin/Subject/add"enctype="multipart/form-data" >
        <table cellspacing="1" cellpadding="3" width="100%">
        <tr><td>专题名</td>
            <td>
                <input type='text' name='subject' maxlength='60' />
            </td>
        </tr>
        <tr><td>专题图片</td>
            <td>
                <input type='file' name='subc_img' maxlength='60' />
            </td>
        </tr>
        <tr><td>专题概述</td>
            <td>
            <textarea id="editor" name='subcontent'></textarea>
            </td>
        </tr>
        <tr><td>专题系列</td>
            <td>
                <input id='select_info' type='button' onclick='subc_ajax(this)' value='选专题'/>
            </td>
        </tr>
        <tr>
        <td>选题列表</td>
        <td>
            <div id='subc_list' class='subc_list' style='display:table;'>
                <div class='list_child' style='display:table-row;'>
                    <div style='display:table-cell;padding:0px 10px 5px 0px;border-bottom:1px dashed blue;'>专题编号</div>
                    <div style='display:table-cell;border-bottom:1px dashed red;'>专题标题</div>
                    <div style='display:table-cell;border-bottom:1px dashed red;'>操作</div>
                </div>
                <div style='display:table-row;'>
                    <div class='ajaxcont' style='display:table-cell;padding:0px 10px 5px 0px;border-bottom:1px dashed blue;'>
                    <input type='text' value='12' readonly='readolny' />
                    </div>
                    <div style='display:table-cell;border-bottom:1px dashed red;'><input type='text' value='百里屠苏&&风晴雪' readonly='readolny' />
                    </div>
                    <div class='subc_del' style='display:table-cell;border-bottom:1px dashed red;'>
                    <a href='javascript:void(0)' onclick='confirm("从哪里来回那里去")'>start</a>

                    </div>
                </div>
            </div>
        </td>
        </tr>
        
        <tr>
            <td colspan="2" align="center">
                <input type="submit" class="button" value=" 确定 " /><input type="reset" class="button" value=" 重置 " />
            </td>
        </tr>
        </table>
    </form>
</div>

<div id="footer">
</div>
</body>
<script type='text/javascript'>
function subc_ajax(){
    window.open('/practice/myproject/index.php/Admin/Subject/ajax');
}

function delnode(node){
    var av = $(node);
    var b = $(av).parent().parent();
    $(b).attr('id','del_self');
    var parent = $(b).parent();
    $(parent).children('div #del_self').remove();
}
$(function(){
    UE.getEditor('editor',{
        toolbars:btn_file,
        initialFrameWidth:"100%",
        initialFrameHeight:"300"
    });
});
</script>
</html>