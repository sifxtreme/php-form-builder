<?php 
	if($_POST){
		print "<pre>";
		print_r($_POST);
		print "</pre>";
		$post_A1_A2 = $_POST["A1_A2"];$post_B1 = $_POST["B1"];$post_C1 = $_POST["C1"];$post_qwe_rew = $_POST["qwe_rew"];$post_wr_wrew_yr = $_POST["wr_wrew_yr"];
		/* $db_A1_A2 = $db->real_escape_string($_POST["A1_A2"]);$db_B1 = $db->real_escape_string($_POST["B1"]);$db_C1 = $db->real_escape_string($_POST["C1"]);$db_qwe_rew = $db->real_escape_string($_POST["qwe_rew"]);$db_wr_wrew_yr = $db->real_escape_string($_POST["wr_wrew_yr"]); */
		/* INSERT INTO TABLE (A1_A2,B1,C1,qwe_rew,wr_wrew_yr,) VALUES ('{$db_A1_A2},''{$db_B1},''{$db_C1},''{$db_qwe_rew},''{$db_wr_wrew_yr},') */
		/* UPDATE TABLE SET A1_A2 = '{$db_A1_A2},'B1 = '{$db_B1},'C1 = '{$db_C1},'qwe_rew = '{$db_qwe_rew},'wr_wrew_yr = '{$db_wr_wrew_yr},' WHERE id='{$id}' */
	} ?><!doctype html><html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Sample Form</title>
		<link rel="stylesheet" href="css/css 1"><link rel="stylesheet" href="css/ css 2">
	</head>
	<body>
		<form method="post" id="#sample_form">
		
				<div class="qwe">
					<label for="A1_A2">A1 A2</label>
					<input id="A1_A2" name="A1_A2" value="<?= $post_A1_A2 ?>"/>
				</div>				
				<div class="qwe">
					<label for="B1">B1</label>
					<textarea id="B1" name="B1" ><?= $post_B1 ?></textarea>
				</div>
				<div class="qwe">
				<label for="C1">C1</label>
				
					<input <?php if(isset($post_C1)){if(in_array("c1",$post_C1)){ echo "checked"; }} ?> type="checkbox" id="C1" name="C1[]" value="c1" />c1
					<input <?php if(isset($post_C1)){if(in_array("c2",$post_C1)){ echo "checked"; }} ?> type="checkbox" id="C1" name="C1[]" value="c2" />c2
					<input <?php if(isset($post_C1)){if(in_array("c3 c4",$post_C1)){ echo "checked"; }} ?> type="checkbox" id="C1" name="C1[]" value="c3 c4" />c3 c4
					<input <?php if(isset($post_C1)){if(in_array("c5",$post_C1)){ echo "checked"; }} ?> type="checkbox" id="C1" name="C1[]" value="c5" />c5
				</div>
				<div class="qwe">
				<label for="qwe_rew">Qwe Rew</label>
				
					<input <?php if(isset($post_qwe_rew)){if("t"==$post_qwe_rew){ echo "checked"; }} ?> type="radio" id="qwe_rew" name="qwe_rew" value="t" />t
					<input <?php if(isset($post_qwe_rew)){if("r"==$post_qwe_rew){ echo "checked"; }} ?> type="radio" id="qwe_rew" name="qwe_rew" value="r" />r
					<input <?php if(isset($post_qwe_rew)){if("e"==$post_qwe_rew){ echo "checked"; }} ?> type="radio" id="qwe_rew" name="qwe_rew" value="e" />e
					<input <?php if(isset($post_qwe_rew)){if("y"==$post_qwe_rew){ echo "checked"; }} ?> type="radio" id="qwe_rew" name="qwe_rew" value="y" />y
				</div>
				<div class="qwe">
				<label for="wr_wrew_yr">Wr Wrew Yr</label>
				<select name="wr_wrew_yr">
				<option value="">Select Wr Wrew Yr</option>
				
				<?php
				$values_array = array('3','4','5','6','7');
				foreach($values_array as $single_value){
					echo "<option value='$single_value' ";
					if($post_wr_wrew_yr == $single_value) echo "selected";
					echo ">$single_value</option>";
				}
				?>
				</select>
				</div>
		<input type="submit" />
		</form>
	</body><script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script><script src="js/js 1"></script></html>