<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ECSHOP 管理中心 - 添加</title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/practice/myproject/Public/Styles/general.css" rel="stylesheet" type="text/css" />
<link href="/practice/myproject/Public/Styles/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/practice/myproject/Public/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="/practice/myproject/Public/js/datetime.js"></script>
</head>
<body>
<h1>
    <span class="action-span1"><a href="#">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> 添加 </span>
    <div style="clear:both"></div>
</h1>
<div class="main-div">
    <form method="post" action="/practice/myproject/index.php/Admin/Infos/add"enctype="multipart/form-data" >
        <table cellspacing="1" cellpadding="3" width="100%">
        <tr><td>省份</td>
            <td>
                <select class='province' name="provinceid">
                <option value='0'>--请选择所在地--</option>
                <?php foreach ($pdata as $v):?>
                    <option value='<?php echo $v["provinceid"];?>'><?php echo $v["provincename"];?></option>
                <?php endforeach;?>
                </select>
            </td>
        </tr>
        <tr><td>项目标题</td>
            <td>
                <input type='text' name='title' maxlength='60' />
            </td>
        </tr>
        <tr><td>项目内容</td>
            <td>
                <input type='text' name='content' maxlength='60' />
            </td>
        </tr>
        <tr><td>发布单位</td>
            <td>
                <input type='text' name='ownerunit' maxlength='60' />
            </td>
        </tr>
        <tr><td>发起者</td>
            <td>
                <input type='text' name='ownercontacts' maxlength='60' />
            </td>
        </tr>
        <tr><td>联系方式</td>
            <td>
                <input type='text' name='ownerphone' maxlength='60' />
            </td>
        </tr>
        <tr><td>招标单位</td>
            <td>
                <input type='text' name='biddingunit' maxlength='60' />
            </td>
        </tr>
        <tr><td>招标联系人</td>
            <td>
                <input type='text' name='biddingcontacts' maxlength='60' />
            </td>
        </tr>
        <tr><td>招标办电话</td>
            <td>
                <input type='text' name='biddingphone' maxlength='60' />
            </td>
        </tr>
        <tr><td>发布时间</td>
            <td>
                <input type="date" name='putDatetime' />
            </td>
        </tr>
        <tr><td>招标时间</td>
            <td>
                <input type='text' class='date_plug' name='biddingdatetime'/>
            </td>
        </tr>
        <tr>
            <td>招标状态</td>
            <td>
                <select class='province' name="biddingstatusid">
                <option value='0'>--请招标状态--</option>
                <?php foreach ($bdata as $v):?>
                    <option value='<?php echo $v["biddingstatusid"];?>'><?php echo $v["biddingstatusname"];?></option>
                <?php endforeach;?>
                </select>
            </td>
        </tr>
        <tr>
            <td>是否上线</td>
            <td>
                <input type='radio' name='is_on_sale' value='1' checked="checked">是</input>
                <input type='radio' name='is_on_sale' value='2'>否</input>
                <tr><td>是否推荐</td>
            <td>
                <input type='radio' name='is_hot' value='1'>是</input>
                <input type='radio' name='is_hot' value='2' checked="checked">否</input>
            </td>
        <tr>
            <td>areaName</td>
            <td>
                <input type='text' name='areaName' maxlength='60' />
            </td>
        </tr>
        <tr><td>源站</td>
            <td>
                <input type='text' name='originalURL' maxlength='60' />
            </td>
        </tr>
        <tr><td>来源</td>
            <td>
                <input type='text' name='sourceWeb' maxlength='60' />
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
<script type="text/javascript">
$('.date_plug').click(function(e){
    var xx =e.pageX;
    var yy =e.pageY;
    $('.date_plug').Date_time({                        
        Event : "click",                   
        Left : xx,
        Top : yy,
        fuhao : "-",
        isTime : false,
        beginY : 2015,
        endY :2020
    });
});
</script> 
</script>
</html>