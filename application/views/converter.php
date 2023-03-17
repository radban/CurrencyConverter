<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Currency converter</title>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

</head>
<body>
	<div id="container" style="width:900px;margin:40px auto;padding:40px;border:1px solid #ccc">
		<h1>Currency Converter</h1>

		<div id="body">
			<form action="" method="get">
				<div class="row">
					<div class="form-group">
						<label for="Amount">Amount</label>
						<input type="text" name="amount" value="1" size="3">

						<label for="From Currency">From</label>
						<select name="from">
							<option value=""></option>
			<?php
			if (count($result['currencies'])):
				foreach ($result['currencies'] as $k => $curr){
					$sel = ((!isset($_GET['from']) && $k == 'USD') || (isset($_GET['from']) && $_GET['from'] == $k)) ? ' selected' : '';
					echo '<option value="'.$k.'"'.$sel.'>'.$curr.' ('.$k.')</option>';
					?>
			<?php
				}
			endif;
			?>
						</select>

						<label for="To Currency">To</label>
						<select name="to">
							<option value=""></option>
			<?php
			if (count($result['currencies'])):
				foreach ($result['currencies'] as $k => $curr){
					$sel = ((!isset($_GET['from']) && $k == 'EUR') || (isset($_GET['from']) && $_GET['from'] == $k)) ? ' selected' : '';
					echo '<option value="'.$k.'"'.$sel.'>'.$curr.' ('.$k.')</option>';
					?>
			<?php
				}
			endif;
			?>
						</select>
						<label for="Date">Date</label>
						<input type="text" name="date" value="" size="7" class="datepicker" autocomplete="off" />
						<button type="button" id="btn">Convert</button>
					</div>
				</div>
</form>


		</div>

		<p class="footer" id="result"></p>
	</div>

<script type="text/javascript">
$( function() {
	$( ".datepicker" ).datepicker();
	$( "#btn" ).on('click', function(){
		if ($(this).hasClass('disabled')) return;
		$(this).addClass('disabled');
		let frm = $(this).closest('form').serialize();
		let self = this;
		$.get('/convert?'+frm, function(json){
			if(json['status'] == 1){
				$('#result').html(json['course']);
			}else{
				$('#result').html('Error! Invalid amount!');

			}
			$(self).removeClass('disabled');
		});
	});
} );
  </script>
<style>
.row .form-group { font-size:16px}
.row .form-group input { height:24px}
.row .form-group button { height:31px;border-radius:5px}
.row .form-group button.disabled { opacity:0.6}
.row .form-group select { height:31px;width:155px}
</style>
</body>
</html>
