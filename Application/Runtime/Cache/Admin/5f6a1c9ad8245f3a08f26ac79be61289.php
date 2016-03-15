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
    <span class="action-span"><a href="/practice/myproject/index.php/Admin/Infos/add">添加</a></span>
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
<form method="post" action="/practice/myproject/index.php/Admin/Infos/bexec" name="listForm" onsubmit='return bexec()'>
    <div class="list-div" id="listDiv">
        <table cellpadding="3" cellspacing="1">
            <tr>
                <th><input type="checkbox" id='selall' /></th>
                                <th>id</th>
                                <th>项目标题</th>
                                <th>发布单位</th>
                                <th>发起者</th>
                                <th>联系方式</th>
                                <th>招标单位</th>
                                <th>招标联系人</th>
                                <th>是否上线</th>
                                <th>是否推荐</th>
                                <th>操作</th>
            </tr>
            <?php foreach($data as $v):?>            <tr>
                <td align="center"><input class='selall' type="checkbox" name='delid[]' value="<?php echo $v['infoid'];?>" /></td>
                                <td align="center"><?php echo $v['infoid'];?></td>
                                <td align="center"><?php echo $v['title'];?></td>
                                <td align="center"><?php echo $v['ownerunit'];?></td>
                                <td align="center"><?php echo $v['ownercontacts'];?></td>
                                <td align="center"><?php echo $v['ownerphone'];?></td>
                                <td align="center"><?php echo $v['biddingunit'];?></td>
                                <td align="center"><?php echo $v['biddingcontacts'];?></td>
                                <td align="center"><?php echo $v['is_on_sale'];?></td>
                                <td align="center"><?php echo $v['is_hot'];?></td>
                                <td align="center" width="80">
                    <a href="/practice/myproject/index.php/Admin/Infos/save/id/<?php echo $v['infoid'];?>" title="编辑">编辑</a>|<a href="/practice/myproject/index.php/Admin/Infos/del/id/<?php echo $v['infoid'];?>" title="移除" onclick="javascript:return confirm('确定删除吗')">移除</a>
                </td>
            </tr>
            <?php endforeach;?>
            <tr>
                <td><input type='submit' name='2bdel' value='批量删除' /></td>
                <td><input type='submit' name='2bhot' value='批量推荐' /></td>
                
                <td colspan='2' class='subjectid' style='display:block;'>
                    <select name='subjectid' onclick='s_subject()'>
                        <option value='0'>-请选专题-</option>
                    </select>
                </td>
                <td>
                    <a href='javascript:void(0)' onclick='a_subject()'>+加入专题</a>
                </td>
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
var loop = 1;
function s_subject(){
    if(loop <=1 ){
        $('.subjectid').css('display','block');
        $.ajax({
            url:'/practice/myproject/index.php/Admin/Subject/menu',
            dataType:'json',
            date:'get',
            success:function(e){
                for(var i=0;i<e.length;i++){
                    var id=e[i]['id'];
                    var tit = e[i]['subject'];
                    var str='<option value='+id+'>'+tit+'</option>';
                    $('select[name=subjectid]').append(str);
                }
            }
        });
        loop++;
    }
    
}
function a_subject(){
    var subid = $('option:selected').val();
    var info_arr = new Array();
    for(var i=0;i<$('.selall:checked').length;i++){
        var a = $('.selall:checked').eq(i).attr('value');
        info_arr[i]=a;
    }
    
    $.ajax({
        url:'/practice/myproject/index.php/Admin/Subject/ajaxadd',
        type:'post',
        data:"id="+subid+"&subc_info="+info_arr,
        success:function(e){
            $('.subjectid').append('<span>'+e+'</span>');
        }
    });
}

</script>