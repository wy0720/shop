<?php if(!class_exists("View", false)) exit("no direct access allowed");?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include $_view_obj->compile('backend/lib/meta.html'); ?>
<link rel="stylesheet" type="text/css" href="public/theme/backend/css/verydows.css" />
<link rel="stylesheet" type="text/css" href="public/theme/backend/css/main.css" />
<script type="text/javascript" src="public/script/jquery.js"></script>
<script type="text/javascript" src="public/theme/backend/js/verydows.js"></script>
<script type="text/javascript" src="public/theme/backend/js/list.js"></script>
<script type="text/javascript">
$(function(){searchRes(1)});

function searchRes(page_id){
  var dataset = {cate_id:$('#cate_id').val(),status:$('#status').val(), kw:$('#kw').val(), page:page_id}
  
  $.asynList("<?php echo url(array('m'=>$MOD, 'c'=>'article', 'a'=>'index', 'step'=>'search', ));?>", dataset, function(data){
    if(data.status == 'success'){
      juicer.register('format_date', function(v){return formatTimestamp(v, 'y-m-d<br />h:i:s');});
      juicer.register('cate_text', function(v){return cateMap(v)});
      $('#rows').append(juicer($('#table-tpl').html(), data));
      $('#rows tr').vdsRowHover();
      $('#rows tr:even').addClass('even');
      if(data.paging != null) $('#rows').append(juicer($('#paging-tpl').html(), data));
    }else{
      $('#rows').append("<div class='nors mt5'>未找到相关数据记录...</div>");
    }
  });
}

function pageturn(page_id){searchRes(page_id);}

function cateMap(cate_id){
  var text = $('#cate_id option[value="'+cate_id+'"]').text();
  if(text == '' || cate_id == 0) return '<font class="c999">未分类</font>';
  return text;
}
</script>
</head>
<body>
<div class="content">
  <div class="loc"><h2><i class="icon"></i>资讯列表</h2></div>
  <div class="box">
    <div class="doacts">
      <a class="ae add btn" href="<?php echo url(array('m'=>$MOD, 'c'=>'article', 'a'=>'add', ));?>"><i></i><font>添加新资讯</font></a>
      <a class="ae btn" onclick="doslvent('<?php echo url(array('m'=>$MOD, 'c'=>'article', 'a'=>'edit', ));?>')"><i class="edit"></i><font>编辑</font></a>
      <a class="ae btn" onclick="domulent('<?php echo url(array('m'=>$MOD, 'c'=>'article', 'a'=>'delete', ));?>')"><i class="remove"></i><font>删除</font></a>
    </div>
    <div class="stools mt5">
      <select id="cate_id" class="slt">
        <option value="" selected="selected">全部分类</option>
        <option value="0" data-name="未分类">未分类</option>
        <?php if (!empty($cate_list)) : ?>
        <?php $_foreach_v_counter = 0; $_foreach_v_total = count($cate_list);?><?php foreach( $cate_list as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
        <option value="<?php echo htmlspecialchars($v['cate_id'], ENT_QUOTES, "UTF-8"); ?>"><?php echo htmlspecialchars($v['cate_name'], ENT_QUOTES, "UTF-8"); ?></option>
        <?php endforeach; ?>
        <?php endif; ?>
      </select>
      <select id="status" class="slt">
        <option value="">全部状态</option>
        <option value="0">正常</option>
        <option value="1">禁止显示</option>
      </select>
      <input type="text" class="w300 txt" id="kw" placeholder="输入资讯标题关键词" />
      <button type="button" class="sbtn btn" onclick="searchRes(1)">搜 索</button>
    </div>
    <div class="module mt5" id="rows"></div>
  </div>
</div>
<script type="text/template" id="table-tpl">
<form method="post" id="mulentform">
<table class="datalist">
  <tr>
    <th width="60" colspan="2">编号</th>
    <th>标题</th>
    <th width="130">分类</th>
    <th width="130">创建日期</th>
    <th width="130">状态</th>
  </tr>
  {@each article_list as v}
  <tr>
    <td width="20"><input name="id[]" type="checkbox" value="${v.id}" /></td>
    <td width="40">${v.id}</td>
    <td class="ta-l"><a class="blue" href="<?php echo url(array('m'=>$MOD, 'c'=>'article', 'a'=>'edit', 'id'=>'${v.id}', ));?>">${v.title}</a></td>
    <td>$${v.cate_id|cate_text}</td>
    <td class="c888">$${v.created_date|format_date}</td>
    <td>{@if v.status == 0}<font class="green">正常</font>{@else}<font class="red">禁止显示</font>{@/if}</td>
  </tr>
  {@/each}
</table>
</form>
</script>
<?php include $_view_obj->compile('backend/lib/paging.html'); ?>
<script type="text/javascript" src="public/script/juicer.js"></script>
</body>
</html>