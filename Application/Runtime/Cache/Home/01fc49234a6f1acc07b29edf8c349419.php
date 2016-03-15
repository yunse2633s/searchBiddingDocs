<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<title>微项目</title>
<link rel="stylesheet" href="/php/practice/myproject/Public/styles/atheme.css" />
<link rel="stylesheet" href="/php/practice/myproject/Public/styles/jquery.mobile.icons.min.css" />
<link rel="stylesheet" href="/php/practice/myproject/Public/styles/jquery.mobile.structure-1.4.5.min.css" />
<script src="/php/practice/myproject/Public/js/jquery.min.js"></script>
<script src="/php/practice/myproject/Public/js/jquery.mobile-1.4.5.min.js"></script>
</head>

<body>
<div data-role="page"> 
  <div style="background:none; border:none;" data-role="header" data-position="fixed">
  <div data-role="header">
    <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-btn-icon-notext ui-icon-carat-l"></a>
    <h1>微项目</h1>
    </div>
    <div data-role="header" data-theme="e">
    <div data-role="navbar">
      <ul>
        <li><a href="my.php" class="ui-btn-active" style="font-size:0.9em">个人信息</a></li>
        <li><a href="favorite.php" style="font-size:0.9em">收藏</a></li>
        <li><a href="subscriptions.php" style="font-size:0.9em">订阅记录</a></li>
        <li><a href="newsub.php" style="font-size:0.9em">新建订阅</a></li>
      </ul>
    </div>
  </div>
  </div>
  <div data-role="content" style="margin:-10px;width:100%;text-align:center"> <img src="i/user.jpg" width="150" height="150" />
    <p>KLPP</p>
  </div>
  <form>
    <fieldset data-role="collapsible">
      <legend>补充/修改个人信息</legend>
      <label for="textinput-f">姓名:</label>
      <input type="text" name="textinput-f" id="textinput-f" placeholder="请填写您的姓名" value="">
      <label for="textinput-f">性别:</label>
      <select name="select-choice-1" id="select-choice-1">
        <option value="standard">先生</option>
        <option value="rush">女士</option>
        <option value="express">保密</option>
      </select>
      <label for="textinput-f">手机号:</label>
      <input type="text" name="textinput-f" id="textinput-f" placeholder="请填写您的手机号" value="">
      <label for="textinput-f">单位:</label>
      <input type="text" name="textinput-f" id="textinput-f" placeholder="请填写您所在单位" value="">
      <label for="textinput-f">其它联系方式:</label>
      <input type="text" name="textinput-f" id="textinput-f" placeholder="请填写您其它联系方式" value="">
      <button type="submit" data-theme="c">保存</button>
    </fieldset>
  </form>
  <div data-role="footer" data-position="fixed" data-theme="b">
    <div data-role="navbar">
      <ul>
        <li><a href="/php/practice/myproject/index.php/Home/Index/index" class="ui-icon-info ui-btn-icon-top ui-btn-active">推荐</a></li>
        <li><a href="/php/practice/myproject/index.php/Home/Searchhot/search" class="ui-icon-search ui-btn-icon-top">搜索</a></li>
        <li><a href="/php/practice/myproject/index.php/Home/Favorites/my" class="ui-icon-heart ui-btn-icon-top">我的...</a></li>
        <li><a href="about.php" class="ui-icon-user ui-btn-icon-top">关于</a></li>
      </ul>
    </div>
    <h4 data-theme="a" style="background:#232323; width:110%; margin-left:-20px; margin-bottom:-1px;">联系电话：400-1010-110</h4>
  </div>
 </div>
</body>
</html>