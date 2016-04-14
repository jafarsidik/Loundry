<div class="nav nav-sidebar list-group">
	<?php
	$module_id = array();
	foreach($tree_menu_lists as $value){
		if($value->MODULE_ID != 1 && $value->MODULE_ID != 2){
			if($value->READ==1){
				if($value->READ==1 || $value->CREATE==1 || $value->UPDATE==1 || $value->DELETE==1){
					$module_id[] = $value->MODULE_ID;
					$module_name[$value->MODULE_ID] = $value->MODULE_NAME;
				}
			}
		}
	}
	$module_id_lists = array_unique($module_id);
	$col = 1;
	foreach($module_id_lists as $module){
		echo '<a href="javascript:void(0)" class="list-group-item" data-toggle="collapse" data-target="#collapse'.$col.'"><span class="fa fa-caret-square-o-right"></span> '.$module_name[$module].'</a>';
		echo '<div class="panel panel-default collapse" id="collapse'.$col.'">';
		echo '<div class="panel-body">';
		echo '<ul class="nav nav-sidebar nav-pills nav-stacked">';
		foreach($tree_menu_lists as $function){
			if($function->MODULE_ID != 1 && $function->MODULE_ID != 2){
				if($function->MODULE_ID==$module){
					if($function->READ==1){
						if($function->READ==1 || $function->CREATE==1 || $function->UPDATE==1 || $function->DELETE==1){
							echo '<li><a href="'.base_url($function->CONTROLLER).'"><span class="fa fa-caret-right"></span> '.$function->MODULE_FUNCTION_NAME.'</a></li>';
						}
					}
				}
			}
		}
		echo '</ul>';
		echo '</div>';
		echo '</div>';
		$col += 1;
	}
	?>
</div>