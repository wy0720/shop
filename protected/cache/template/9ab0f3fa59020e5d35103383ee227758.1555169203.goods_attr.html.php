<?php if(!class_exists("View", false)) exit("no direct access allowed");?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include $_view_obj->compile('backend/lib/meta.html'); ?>
<link rel="stylesheet" type="text/css" href="public/theme/backend/css/verydows.css" />
<link rel="stylesheet" type="text/css" href="public/theme/backend/css/main.css" />
<link rel="stylesheet" type="text/css" href="public/theme/backend/css/goods.css" />
<script type="text/javascript" src="public/script/jquery.js"></script>
<script type="text/javascript" src="public/theme/backend/js/verydows.js"></script>
<script type="text/javascript">
$(function(){
  getAttrs();
  $('#cate_id').change(function(){getAttrs();});
});

function getAttrs(){
  var cate_id = $('#cate_id').val(), goods_id = $('#goods_id').val();
  $.asynList("<?php echo url(array('m'=>$MOD, 'c'=>'goods', 'a'=>'edit', 'step'=>'attr', 'op'=>'list', ));?>", {'cate_id':cate_id, 'goods_id':goods_id}, function(data){
    $('#attrs .attrli').empty();
    if(data.list && data.list != ''){
      var attrhtml = juicer($('#attr-tpl').html(), data);
      $('#attrs .attrli').append(attrhtml);
    }else{
      $('#attrs').empty().append("<div class='nors mt5'>该商品分类尚未设置相关属性，清先设置分类属性.</div>");
    }
  });
}
</script>
</head>
<body>
<div class="content">
  <div class="loc"><h2><i class="icon"></i>商品属性规格:<font class="ml5">[<?php echo htmlspecialchars($goods['goods_id'], ENT_QUOTES, "UTF-8"); ?>]</font></h2></div>
  <div class="box">
    <div class="bw-row ta-c pad10 cut">
      <h3 class="c666"><?php echo htmlspecialchars($goods['goods_name'], ENT_QUOTES, "UTF-8"); ?></h3>
      <p class="c999 mt10">货号:<font class="c666 ml5"><?php echo htmlspecialchars($goods['goods_sn'], ENT_QUOTES, "UTF-8"); ?></font></p>
      <div class="ta-c mt10">
        <label><font class="c999 mr5">分类:</font>
        <select class="slt" id="cate_id">
          <option value="0">选择分类</option>
          <?php $_foreach_v_counter = 0; $_foreach_v_total = count($cate_list);?><?php foreach( $cate_list as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?> <?php if ($v['cate_id'] == $goods['cate_id']) : ?>
          <option value="<?php echo htmlspecialchars($v['cate_id'], ENT_QUOTES, "UTF-8"); ?>" selected="selected"><?php echo str_repeat('|— ',$v['lv']);?> <?php echo htmlspecialchars($v['cate_name'], ENT_QUOTES, "UTF-8"); ?></option>
          <?php else : ?>
          <option value="<?php echo htmlspecialchars($v['cate_id'], ENT_QUOTES, "UTF-8"); ?>"><?php echo str_repeat('|— ',$v['lv']);?> <?php echo htmlspecialchars($v['cate_name'], ENT_QUOTES, "UTF-8"); ?></option>
          <?php endif; ?>
          <?php endforeach; ?>
        </select>
        </label>
      </div>
    </div>
    <div class="module cut" id="attrs">
    <form method="post" action="<?php echo url(array('m'=>$MOD, 'c'=>'goods', 'a'=>'edit', 'step'=>'attr', 'op'=>'update', ));?>">
      <input name="goods_id" type="hidden" id="goods_id" value="<?php echo htmlspecialchars($goods['goods_id'], ENT_QUOTES, "UTF-8"); ?>" />
      <div class="bw-row mt5 pad10">
        <div class="attrli x-auto"></div>
      </div>
      <div class="mt10 pad10 ta-c"><button type="submit" class="ubtn btn">保存并更新</button></div>
    </form>
    </div>
  </div>
</div>
<script type="text/template" id="attr-tpl">
{@each list as v}
  <dl>
    <dt>${v.name}:<input name="attrs[id][]" type="hidden" value="${v.attr_id}" /></dt>
    {@if v.opts == ''}
    <dd><input class="w200 txt" name="attrs[value][]" type="text" value="${v.value}" /><font class="c999 ml5">${v.uom}</font></dd>
    {@else}
    <dd>
      <select name="attrs[value][]" class="slt">
      {@each v.opts as vv}<option value="${vv}" {@if v.value == vv}selected="selected"{@/if}>${vv}</option>{@/each}
      </select>
      <font class="c999 ml5">${v.uom}</font>
    </dd>
    {@/if}
  </dl>
{@/each}
</script>
<script type="text/javascript" src="public/script/juicer.js"></script>
</body>
</html>