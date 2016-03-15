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
<script src="/php/practice/myproject/Public/js/jquery.touchslider.min.js"></script>
<script src="/php/practice/myproject/Public/js/jquery.mobile-1.4.5.min.js"></script>
<script>
jQuery(function($) {
    $(".touchslider").touchSlider({
		autoplay: true
		});
});
</script>
<style>
.ui-li-aside1{top:2em; right:5em; position:absolute;}
.a1{background:#c9e8a5; display:inline-block; color:#4e7f16; font-size:0.8em; padding:5px 10px; border-radius:5px;}
</style>
</head>

<body>
<div data-role="page"> 
  <div data-role="header" data-position="fixed">
    <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-btn-icon-notext ui-icon-carat-l"></a>
    <h1>微项目</h1>
  </div>
  <div data-role="content" style="margin:-10px"> 
    <div class="touchslider">
      <div class="touchslider-viewport" style="width:100%;overflow:hidden;height:150px">
        <div>
        <?php if(is_array($data["loop_data"])): foreach($data["loop_data"] as $key=>$vol): ?><div class="touchslider-item">
            <img class='loop' src="<?php echo (IMG_URL); echo ($vol["thumb_img"]); ?>" width="618" height="246" />
          </div><?php endforeach; endif; ?>
        </div>
      </div>
    </div>
    <ul data-role="listview" style="margin:0px" data-theme="e">
      <li data-role="list-divider"><h1 style="font-size:1.3em; border-left:5px #4e7f16 solid; padding-left:10px;">今日推荐项目</h1></li>
      <li data-role="list-divider"><p style="font-size:1em;">
      <?php echo date('Y-m-n',time());?>
      <span class="ui-li-count" style="color:#fd6804">资源总量:<?php echo ($data['total']); ?></span></p></li>
      <?php if(is_array($data['info_data'])): foreach($data['info_data'] as $key=>$vol): ?><li>
        <a href="view.php"> 
          <h2 style="margin-top:-0.5em; font-size:0.95em;"><span class="a1">6:24PM</span> <?php echo ($vol["title"]); ?></h2>
        
          <p style="font-size:0.9em" infoid='<?php echo ($vol2["infoid"]); ?>'><?php echo ($vol["content"]); ?></p>
        </a>
      </li><?php endforeach; endif; ?>
     <ul data-role="listview" style="margin:0px" data-theme="e">
      <li data-role="list-divider"><h1 style="font-size:1.3em; border-left:5px #4e7f16 solid; padding-left:10px">最近浏览项目</h1></li>
      <li data-role="list-divider"><p style="font-size:0.6em;"><?php echo date('Y-m-n',time());?><span class="ui-li-count" style="color:#fd6804"><?php echo $data['browse_total'];?></span></p></li>
      <?php if(is_array($data["browse_info"])): $i = 0; $__LIST__ = $data["browse_info"];if( count($__LIST__)==0 ) : echo "暂无浏览记录" ;else: foreach($__LIST__ as $key=>$vol2): $mod = ($i % 2 );++$i;?><li><a href="view.php">     
        <h2 style="margin-top:-0.5em; font-size:0.95em;"><span class="a1">6:24PM</span><?php echo ($vol2["title"]); ?></h2>
        <p style="font-size:0.9em" infoid='<?php echo ($vol2["infoid"]); ?>'><?php echo ($vol2["content"]); ?></p>
        </a>
      </li><?php endforeach; endif; else: echo "暂无浏览记录" ;endif; ?>
    </ul>
  </div>
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