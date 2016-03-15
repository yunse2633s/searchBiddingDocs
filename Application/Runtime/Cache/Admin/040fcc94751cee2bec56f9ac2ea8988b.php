<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ECSHOP 管理中心 - 管理员列表 </title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/practice/myproject/Public/Styles/general.css" rel="stylesheet" type="text/css" />
<link href="/practice/myproject/Public/Styles/main.css" rel="stylesheet" type="text/css" />
<script type='text/javascript' src='/practice/myproject/Public/js/jquery-1.4.4.js'></script>
</head>
<body>
<h1>
    <span class="action-span"><a href="/practice/myproject/index.php/Admin/Subject/add">添加</a></span>
    <span class="action-span1"><a href="#">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 列表 </span>
    <div style="clear:both"></div>
</h1>
<div class="form-div">
    <form action="" name="searchForm">
    <img src="/practice/myproject/Public/Images/icon_search.gif" width="26" height="22" border="0" alt="search" />
    <input type="text" name="un" size="15" value="" />
    <input type="submit" value=" 搜索 " class="button" />
    </form>
</div>
<form method="post" action="/practice/myproject/index.php/Admin/Subject/bdel" name="listForm">
    <div class="list-div" id="listDiv">
        <table cellpadding="3" cellspacing="1">
            <tr>
                <th><input type="checkbox" id='selall' /></th>
                                <th>id</th>
                                <th>专题名</th>
                                <th>专题图片</th>
                                <th>专题概述</th>
                                <th>操作</th>
            </tr>
            <?php foreach($data as $v):?>            <tr>
                <td align="center"><input class='selall' type="checkbox" name='delid[]' value="<?php echo $v['id'];?>" /></td>
                                <td align="center"><?php echo $v['id'];?></td>
                                <td align="center"><?php echo $v['subject'];?></td>
                                <td align="center"><?php echo $v['subc_img'];?>
                                <img width='50' src="<?php echo IMG_URL.$v['subc_img'];?>"/>

                                </td>
                                <td align="center"><?php echo $v['subcontent'];?></td>
                                <td align="center">
                    <a href="/practice/myproject/index.php/Admin/Subject/save/id/<?php echo $v['id'];?>" title="编辑">编辑</a>|<a href="/practice/myproject/index.php/Admin/Subject/del/id/<?php echo $v['id'];?>" title="移除" onclick="javascript:return confirm('确定删除吗')">移除</a>
                </td>
            </tr>
            <?php endforeach;?>            <tr>
                <td><input type='submit' value='批量删除' /></td>
                <td align="right" nowrap="true" colspan="0">
                    <div id="turn-page">
                        <?php echo $page;?>                   </div>
                </td>
            </tr>
        </table>
    </div>
</form>

<div id="footer">
共执行 3 个查询，用时 0.021251 秒，Gzip 已禁用，内存占用 2.194 MB<br />
版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>
</body>
</html>
<script type='text/javascript'>
    $('#selall').click(function(){
        if($(this).attr('checked')){
            $('.selall').attr('checked','checked');
        }else{
             $('.selall').attr('checked','');
        }
    });
</script>