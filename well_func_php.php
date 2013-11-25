<?
function well_link($well_anchor,$well_link) {
/*
echo '<span style="color:#009cff; border:1px dotted #009cff; cursor:pointer;" onclick="
		$.arcticmodal({
		type: \'ajax\',
		url: \''.$well_link.'\'
		});
		">&nbsp;'.$well_anchor.'&nbsp;</span>
		';
*/
	if ($_SESSION['user_type']==2) {
			return '<div class="well_link" onclick="
					Mercury.modal(\''.$well_link.'\', { title: \''.$config_well_object[$_object]['name'].'\', fullHeight: false});
					">&nbsp;'.$well_anchor.'&nbsp;</div>
					';
	}
}

function well_edit_direct($table,$column,$id) {
	if ($_SESSION['user_type']==2) {
		return ' id="direct@'.$table.'@'.$column.'@'.$id.'" data-mercury="full"';
	}
}
?>