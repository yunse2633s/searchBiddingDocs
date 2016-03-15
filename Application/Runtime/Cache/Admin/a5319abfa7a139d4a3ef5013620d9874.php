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
<form method="post" action="/practice/myproject/index.php/Admin/Subject/ajaxadd" name="listForm" onsubmit='return bexec()'>
    <div class="list-div" id="listDiv">
        <table cellpadding="3" cellspacing="1">
            <tr>
                <th><input type="checkbox" id='selall' /></th>
                                <th>id</th>
                                <th>项目标题</th>
                                <th>发布单位</th>
                                <th>发起者</th>
                                <th>是否上线</th>
                                <th>是否推荐</th>
            </tr>
            <?php foreach($data as $v):?>            <tr>
                <td align="center">
                <input class='selall' type="checkbox" name='delid[]' value="<?php echo $v['infoid'];?>" />
                </td>
                <td align="center"><?php echo $v['infoid'];?></td>
                <td class='title' align="center"><?php echo $v['title'];?></td>
                <td align="center"><?php echo $v['ownerunit'];?></td>
                <td align="center"><?php echo $v['ownercontacts'];?></td>
                <td align="center"><?php echo $v['is_on_sale'];?></td>
                <td align="center"><?php echo $v['is_hot'];?></td>
                                
            </tr>
            <?php endforeach;?>            <tr>
                <td><input type='button' name='subject' value='确认选择' onclick='a_subject()' /></td> 
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
function bexec(){
    var falg = 0;
    $(".selall").each(function () {
        if ($(this).attr("checked")) {
            falg += 1;
        }
    });
    if (falg > 0)
        return true;
    else
        return false;
}

function a_subject(){
    var subid = $('option:selected').val();
    var info_arr = {};
    
    for(var i=0;i<$('.selall:checked').length;i++){
        var info = {};
        var a = $('.selall:checked').eq(i).attr('value');
        var b = $('.selall:checked').eq(i).parent().next().next().text();
        info['id']= a;
        info['title']=b;
        info_arr[i] =info;
    }
    for(var i in info_arr){
        var id = info_arr[i]['id'];
        var title =info_arr[i]['title'];
        var str = "<div class='list_child' style='display:table-row;'>";
        str += "<div class='ajaxcont' style='display:table-cell;padding:0px 10px 5px 0px;border-bottom:1px dashed blue;'>";
        str += "<input type='text' name='subc_info[]' value='"+id+"' readonly='readolny' />";
        str += "</div><div style='display:table-cell;border-bottom:1px dashed red;'>";
        str += "<input type='text' name='infoname' value='"+title+"' readonly='readolny' />";
        str += "</div><div class='subc_del' style='display:table-cell;border-bottom:1px dashed red;'><a href='javascript:void(0)' onclick='delnode(this)'>去除</a>";
        str += "</div>";
        $(window.opener.document.getElementById('subc_list')).append(str);
    }

    window.close();
}
</script>