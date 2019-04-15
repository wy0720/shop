<?php if(!class_exists("View", false)) exit("no direct access allowed");?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include $_view_obj->compile('backend/lib/meta.html'); ?>
<link rel="stylesheet" type="text/css" href="public/theme/backend/css/verydows.css" />
<link rel="stylesheet" type="text/css" href="public/theme/backend/css/main.css" />
<script type="text/javascript" src="public/script/jquery.js"></script>
<script type="text/javascript" src="public/theme/backend/js/verydows.js"></script>
<script type="text/javascript" src="public/theme/backend/js/list.js"></script>
</head>
<body>
<div class="content">
  <div class="loc"><h2><i class="icon"></i>商品选项类型</h2></div>
  <div class="box">
    <div class="doacts">
      <a class="ae add btn" href="<?php echo url(array('m'=>$MOD, 'c'=>'goods_optional_type', 'a'=>'add', ));?>"><i></i><font>新增选项类型</font></a>
      <a class="ae btn" onclick="doslvent('<?php echo url(array('m'=>$MOD, 'c'=>'goods_optional_type', 'a'=>'edit', ));?>', 'id')"><i class="edit"></i><font>编辑</font></a>
      <a class="ae btn" onclick="doslvent('<?php echo url(array('m'=>$MOD, 'c'=>'goods_optional_type', 'a'=>'delete', ));?>', 'id')"><i class="remove"></i><font>删除</font></a>
    </div>
    <?php if (!empty($results)) : ?>
    <div class="module mt5">
      <table class="datalist">
        <tr>
          <th width="50" colspan="2">编号</th>
          <th class="ta-l">类型名称</th>
        </tr>
        <?php $_foreach_v_counter = 0; $_foreach_v_total = count($results);?><?php foreach( $results as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
        <tr>
          <td width="20"><input name="id" type="checkbox" value="<?php echo htmlspecialchars($v['type_id'], ENT_QUOTES, "UTF-8"); ?>" /></td>
          <td width="30"><?php echo htmlspecialchars($v['type_id'], ENT_QUOTES, "UTF-8"); ?></td>
          <td class="ta-l"><a class="blue" href="<?php echo url(array('m'=>$MOD, 'c'=>'goods_optional_type', 'a'=>'edit', 'id'=>$v['type_id'], ));?>"><?php echo htmlspecialchars($v['name'], ENT_QUOTES, "UTF-8"); ?></a></td>
        </tr>
        <?php endforeach; ?>
      </table>
    </div>
    <?php if (!empty($paging)) : ?>
    <div class="bom mt5"><?php echo html_paging(array('paging'=>$paging, 'm'=>$MOD, 'c'=>'goods_optional_type', 'a'=>'index', 'class'=>'paging', ));?></div>
    <?php endif; ?>
    <?php else : ?>
    <div class="nors mt5">未找到相关数据记录...</div>
    <?php endif; ?>
  </div>
</div>
</body>
</html>