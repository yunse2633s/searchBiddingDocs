<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ECSHOP 管理中心 - 添加</title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/practice/myproject/Public/Styles/general.css" rel="stylesheet" type="text/css" />
<link href="/practice/myproject/Public/Styles/main.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h1>
    <span class="action-span1"><a href="#">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> 添加 </span>
    <div style="clear:both"></div>
</h1>
<div class="main-div">
    <form method="post" action="/practice/myproject/index.php/Admin/Searchhot/add"enctype="multipart/form-data" >
        <table cellspacing="1" cellpadding="3" width="100%">
        <tr><td>搜索词</td>
            <td>
                <input type='text' name='search_hot' maxlength='60' />
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
</html>