<?php

if($_POST){
	// use for debugging
	// print "<pre>";
	// print_r($_POST);
	// print "</pre>";

	// generate html strings for inputs
	$div_class = $_POST['div_class'];
	$all_inputs_html = "";
	$name_array = array();

	foreach($_POST['input_fields'] as $single_input){
		$single_input_html = "";
		$name_array[] = $single_input['input_name'];
		$display_name = trim($single_input['input_name']);
		$name = str_replace(' ', '_', trim($single_input['input_name'])); // replace spaces with underscores

		switch ($single_input['input_type']){
			
			case 'text':
				$what_text_type = $single_input['text_type'];
				if($what_text_type == "") $what_text_type = 'text';

				$single_input_html .= '
				<div class="'.$div_class.'">
					<label for="'.$name.'">'.ucwords($display_name).'</label>
					<input id="'.$name.'" name="'.$name.'" value="'.'<?= $post_'.$name.' ?>'.'"/>
				</div>';
				break;
			
			case 'textarea':
				$single_input_html .= '				
				<div class="'.$div_class.'">
					<label for="'.$name.'">'.ucwords($display_name).'</label>
					<textarea id="'.$name.'" name="'.$name.'" ><?= $post_'.$name.' ?></textarea>
				</div>';
				break;
			
			case 'checkbox':
				$values = explode(",",$single_input['input_values']);
				foreach($values as $single_value){
					$is_checked = '<?php if(isset($post_'.$name.')){if(in_array('.'"'.$single_value.'"'.',$post_'.$name.')){ echo "checked"; }} ?>';
					$single_input_html .= '
					<input '.$is_checked.' type="checkbox" id="'.$name.'" name="'.$name.'[]" value="'.$single_value.'" />'.$single_value;
				}
				
				$single_input_html = '
				<div class="'.$div_class.'">
				<label for="'.$name.'">'.ucwords($display_name).'</label>
				'.$single_input_html.'
				</div>';
				break;
			
			case 'radio':
				$values = explode(",",$single_input['input_values']);
				foreach($values as $single_value){
					$is_checked = '<?php if(isset($post_'.$name.')){if('.'"'.$single_value.'"'.'==$post_'.$name.'){ echo "checked"; }} ?>';
					$single_input_html .= '
					<input '.$is_checked.' type="radio" id="'.$name.'" name="'.$name.'" value="'.$single_value.'" />'.$single_value;
				}
				
				$single_input_html = '
				<div class="'.$div_class.'">
				<label for="'.$name.'">'.ucwords($display_name).'</label>
				'.$single_input_html.'
				</div>';
				break;
			
			case 'dropdown':
				$values = "'".str_replace(",","','",$single_input['input_values'])."'";
				$values = 'array('.$values.');';
				$values_php = '
				<?php
				$values_array = '.$values.'
				foreach($values_array as $single_value){
					echo "<option value='."'".'$single_value'."'".' ";
					if($post_'.$name.' == $single_value) echo "selected";
					echo ">$single_value</option>";
				}
				?>';
				
				$single_input_html = '
				<div class="'.$div_class.'">
				<label for="'.$name.'">'.ucwords($display_name).'</label>
				<select name="'.$name.'">
				<option value="">Select '.ucwords($display_name).'</option>
				'.$values_php.'
				</select>
				</div>';
				break;
			
			default:
				break;
		}

		$all_inputs_html .= $single_input_html;
	}

	// generate string for php for form processing, variable setting, and form processing
	$php_set_vars = "";
	$php_db_vars = "";
	$php_update_vars = "";
	$php_insert_vars1 = "";
	$php_insert_vars2 = "";
	$count = 1;
	foreach($name_array as $single_name){
		$single_name = str_replace(' ','_',$single_name);
		$php_set_vars .= '$post_'.$single_name.' = $_POST["'.$single_name.'"];';
		$php_db_vars .= '$db_'.$single_name.' = $db->real_escape_string($_POST["'.$single_name.'"]);';
		if($count != count($name_array)){
			$php_update_vars .= $single_name.' = '."'{"."$"."db_".$single_name."},'";
			$php_insert_vars1 .= $single_name.',';
			$php_insert_vars2 .= "'{"."$"."db_".$single_name."},'";
		}
		else{
			$php_update_vars .= $single_name.' = '."'{"."$"."db_".$single_name."}'";
			$php_insert_vars1 .= $single_name;
			$php_insert_vars2 .= "'{"."$"."db_".$single_name."}'";
		}
	}
	$php_db_vars = "/* ".$php_db_vars." */";
	$php_update_vars = "/* UPDATE TABLE SET ".$php_update_vars." WHERE id='{"."$"."id"."}' */";
	$php_insert_vars1 = "(".$php_insert_vars1.")";
	$php_insert_vars2 = "(".$php_insert_vars2.")";
	$php_insert_vars = "/* INSERT INTO TABLE ".$php_insert_vars1." VALUES ".$php_insert_vars2." */";
	
	$php_if_post = '
	if($_POST){
		print "<pre>";
		print_r($_POST);
		print "</pre>";
		'.$php_set_vars.'
		'.$php_db_vars.'
		'.$php_insert_vars.'
		'.$php_update_vars.'
	}';
	$php_string = '<?php '.$php_if_post.' ?>';

	// generate body html
	$body_string = '
	<body>
		<form method="post" id="#sample_form">
		'.$all_inputs_html.'
		<input type="submit" />
		</form>
	</body>';

	// generate html string for the head
	$head_string = '';
	foreach(explode(",",$_POST['css_files']) as $single_file){
		$head_string .= '<link rel="stylesheet" href="'.$_POST['css_file_location'].$single_file.'">';
	}
	$head_string = '
	<head>
		<meta charset="utf-8">
		<title>Sample Form</title>
		'.$head_string.'
	</head>';

	// generate string for javascript
	$js_string = '';
	$js_string .= '<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>';
	foreach(explode(",",$_POST['js_files']) as $single_file){
		if($single_file != "") $js_string .= '<script src="'.$_POST['js_file_location'].$single_file.'"></script>';
	}

}

?>
<?php

$file = 'process.php';
$toadd .= 
	$php_string.
	'<!doctype html>'.
	'<html lang="en">'.
		$head_string.
		$body_string.
		$js_string.
	'</html>';

file_put_contents($file, $toadd);

header('Content-disposition: attachment; filename="new_form.php"');
header('Content-type: "text/html"; charset="UTF-8" ');
print $toadd

?>