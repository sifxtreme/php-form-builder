<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Form Generator</title>
  <meta name="description" content="Write the HTML, CSS, PHP, and Javascript for a Form with a Form!">
  <meta name="author" content="Asif Ahmed">
  <link rel="stylesheet" href="validationEngine.jquery.css">
  <link rel="stylesheet" href="styles.css">
</head>

<body>

	<h2>Form Generator</h2>

	<div class='description'>
		Use this form to create a form! Set CSS classes and file paths in the "Global Settings" section.
		Create the various input fields for your form in the "Input Fields" section.
		Then click our submit button. Good luck!
	</div>

	<form id='form_maker' action='form.php' method='post'>

		<section>
			<h3>Global Settings</h3>

			<div class="inputDescription">
				Include the path to your CSS and Javascript files. 
			</div>

			<label for="css_file_location">CSS File Location</label>
			<input placeholder="ex. css/ " type="text" id="css_file_location" name="css_file_location" />

			<label for="css_files">CSS Files</label>
			<input placeholder="comma separated list" type="text" id="css_files" name="css_files" />
			
			<label for="js_file_location">Javascript File Locations</label>
			<input placeholder="ex. js/" type="text" id="js_file_location" name="js_file_location" />

			<label for="js_files">Javascript Files (jQuery 1.9.1 will be included by default from Google)</label>
			<input placeholder="comma separated list" type="text" id="js_files" name="js_files" />

			<label for="div_class">Class Name for Form Input Container Divs</label>
			<input placeholder="class name" type="text" id="div_class" name="div_class" />

		</section>

		<section>
			<h3>Input Fields</h3>

			<div class="input_fields">

				<div class="spacing">
					<fieldset>
					<legend>Input 0</legend>
					<label for="input_type">Input Type (Text Field, Textarea, Checkbox, Radio, Dropdown)</label>
					<input class="input_type validate[required]" type="radio" name="input_fields[0][input_type]" value="text" />Text<br />
					<input class="input_type validate[required]" type="radio" name="input_fields[0][input_type]" value="textarea" />Textarea<br />
					<input class="input_type validate[required]" type="radio" name="input_fields[0][input_type]" value="checkbox" />Checkbox<br />
					<input class="input_type validate[required]" type="radio" name="input_fields[0][input_type]" value="radio" />Radio<br />
					<input class="input_type validate[required]" type="radio" name="input_fields[0][input_type]" value="dropdown" />Dropdown<br />

					<label for="input_name">Input Name</label>
					<input class="validate[required]" placeholder="name attribute of input" type="text" id="input_name" name="input_fields[0][input_name]" />

					<span class="text_type">
					<label for="text_type">Text Type (if you selected "Text" for "Input Type")</label>
					<input type="radio" name="input_fields[0][text_type]" value="text" />Text<br />
					<input type="radio" name="input_fields[0][text_type]" value="date" />Date<br />
					<input type="radio" name="input_fields[0][text_type]" value="email" />Email<br />
					<input type="radio" name="input_fields[0][text_type]" value="password" />Password<br />
					</span>

					<span class="input_values">
					<label for="input_values">Input Values (if you selected "Checkbox","Radio","Dropdown" for "Input Type")</label>
					<textarea id="input_values" cols="50" rows="10" name="input_fields[0][input_values]"></textarea>
					</span>

					</fieldset>
				</div>

			</div><!-- end .input_fields -->
			<a href="#" id="addAnother">Add Another Input</a>

		</section>
		<input type="submit" />
	</form>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="jquery.validationEngine.js"></script>
<script src="jquery.validationEngine-en.js"></script>
<script>
$(document).ready(function(){
	$('#form_maker').validationEngine();

	// add more input fields
	$('#addAnother').on('click',function(){
		var input_number = $('.input_fields div').size();
		var divToAdd = $('div.input_fields');
		var input_string_to_add = generate_inputs(input_number);
		divToAdd.append(input_string_to_add);
		return false;
	});

	// show-hide additional fields based on input type selection
	$(document).on('change','.input_type',function(){
		var whatType = this.value;
		if(whatType == 'text'){
			$(this).siblings('.text_type').show();
			$(this).siblings('.input_values').hide();
		}
		else if(whatType == 'textarea'){
			$(this).siblings('.text_type').hide();
			$(this).siblings('.input_values').hide();
		}
		else{
			$(this).siblings('.text_type').hide();
			$(this).siblings('.input_values').show();			
		}
	});

	// function to generate input field html
	function generate_inputs(input_numbers){
		console.log('adfsdf');
		var input_string = "";
		input_string = '\
			<div class="spacing">\
				<fieldset>\
				<legend>Input '+input_numbers+'</legend>\
				<label for="input_type">Input Type (Text Field, Textarea, Checkbox, Radio, Dropdown)</label>\
				<input class="input_type validate[required]" type="radio" name="input_fields['+input_numbers+'][input_type]" value="text" />Text<br />\
				<input class="input_type validate[required]" type="radio" name="input_fields['+input_numbers+'][input_type]" value="textarea" />Textarea<br />\
				<input class="input_type validate[required]" type="radio" name="input_fields['+input_numbers+'][input_type]" value="checkbox" />Checkbox<br />\
				<input class="input_type validate[required]" type="radio" name="input_fields['+input_numbers+'][input_type]" value="radio" />Radio<br />\
				<input class="input_type validate[required]" type="radio" name="input_fields['+input_numbers+'][input_type]" value="dropdown" />Dropdown<br />\
				<label for="input_name">Input Name</label>\
				<input class="validate[required]" placeholder="name attribute of input" type="text" id="input_name" name="input_fields['+input_numbers+'][input_name]" />\
				<span class="text_type">\
				<label for="text_type">Text Type (if you selected "Text" for "Input Type")</label>\
				<input type="radio" name="input_fields['+input_numbers+'][text_type]" value="text" />Text<br />\
				<input type="radio" name="input_fields['+input_numbers+'][text_type]" value="date" />Date<br />\
				<input type="radio" name="input_fields['+input_numbers+'][text_type]" value="email" />Email<br />\
				<input type="radio" name="input_fields['+input_numbers+'][text_type]" value="password" />Password<br />\
				</span>\
				<span class="input_values">\
				<label for="input_values">Input Values (if you selected "Checkbox","Radio","Dropdown" for "Input Type")</label>\
				<textarea id="input_values" cols="50" rows="10" name="input_fields['+input_numbers+'][input_values]"></textarea>\
				</span>\
				</fieldset>\
			</div>';
		return input_string;
	}

});
</script>

</body>
</html>
