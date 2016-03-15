<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<title>微项目</title>
<link rel="stylesheet" href="/practice/myproject/Public/styles/atheme.css" />
<link rel="stylesheet" href="/practice/myproject/Public/styles/jquery.mobile.icons.min.css" />
<link rel="stylesheet" href="/practice/myproject/Public/styles/jquery.mobile.structure-1.4.5.min.css" />
<script src="/practice/myproject/Public/js/jquery.min.js"></script>
<script src="/practice/myproject/Public/js/jquery.mobile-1.4.5.min.js"></script>
</head>

<body>
<div data-role="page" id="s2">
  <div data-role="header" data-position="fixed">
    <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-btn-icon-notext ui-icon-carat-l"></a>
    <h1>微项目</h1>
  </div>
  <div data-role="content" style="margin:-10px" data-theme="d">
<a href="/practice/myproject/index.php/Home/Searchhot/search" class="ui-btn ui-btn-inline ui-icon-search ui-btn-icon-left">重新搜索</a>
    <ul data-role="listview" style="margin:0px">
      <li data-role="list-divider"><h1 style="font-size:1.3em; border-left:5px #4e7f16 solid; padding-left:10px;">"<?php echo ($search_word); ?>"的搜索结果</h1> <span class="ui-li-count" style="color:#fd6804"><?php echo $page;?></span></li>
      
      <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "太高深了" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><li><a href="/practice/myproject/index.php/Home/Searchhot/view/id/<?php echo ($vol['infoid']); ?>">     
        <h2 style="margin-top:-0.5em; font-size:0.95em;"><span class="a1">编号<?php echo ($vol['infoid']); ?></span> <?php echo ($vol['title']); ?>----省份<?php echo ($vol['provinceid']); ?></h2>
        
        <p style="font-size:0.9em"><?php echo ($vol['content']); ?></p>
        </a>
      </li><?php endforeach; endif; else: echo "太高深了" ;endif; ?>
    </ul>
    
    <div id='similar' class="ui-body ui-body-a ui-corner-all" style="margin-top:1em;">
    <h4>相关搜索</h4>
    </div>
  </div>
  <div data-role="footer" data-position="fixed" data-theme="b">
    <div data-role="navbar">
      <ul>
        <li><a href="/practice/myproject/index.php/Home/Index/index" class="ui-icon-info ui-btn-icon-top">推荐</a></li>
        <li><a href="/practice/myproject/index.php/Home/Searchhot/search" class="ui-icon-search ui-btn-icon-top ui-btn-active">搜索</a></li>
        <li><a href="/practice/myproject/index.php/Home/Favorites/my" class="ui-icon-heart ui-btn-icon-top">我的...</a></li>
        <li><a href="about.php" class="ui-icon-user ui-btn-icon-top">关于</a></li>
      </ul>
    </div>
    <h4 data-theme="a" style="background:#232323; width:110%; margin-left:-20px; margin-bottom:-1px;">联系电话：400-1010-110</h4>
  </div>
</div>
</body>
<script type="text/javascript">
  $(function(){
    $.ajax({
      url:'/practice/myproject/index.php/Home/Searchhot/ajax_similar_search/search/'+'牛',
      type:'get',
      dataType:'json',
      success:function(nsg){
        for(var key in nsg){
          $('#similar').append('<button data-role="snone" onclick="similar_search(this)">'+nsg[key]['search_hot']+'</span>');
        }
      }      
    });
  });
 function similar_search(e){
      var search = $(e).text();
      location.href='/practice/myproject/index.php/Home/Searchhot/ajax_records/search/'+search;
 }
</script>
</html>