<?php 
	session_start();
?>

<html>
	<head>
		<script type="text/javascript" src="ajax.js"></script>
	</head>


	<body> 	

		<p id="log"> </p> <br>
		<p id="data"> </p>
		<p id="input_block">
			<p id="input_text">Initial text: </p>
			<input type="text" name="input" id="input_box" value=""> 
			<button id="input_button" onclick="set_A()">set A</button>
		</p>

		<form action="/webapp.php" id ="initial_form" method="POST">
			Se cer urmatoarele date:

			<input type="hidden" name="action" value="send_initial_data">
			CS:	 	<input type="text" name="cs" id="cs" value="1.4" >	<br>
			P_V: 	<input type="text" name="pv" id="pv" value="1.7">	<br>
			N_V:	<input type="text" name="nv" id="nv" value="150">	<br>
			I_TCT:	<input type="text" name="itct" id="itct" value="2.5">	<br>
			I_R:	<input type="text" name="ir" id="ir" value="6.3">	<br>
			l:		<input type="text" name="l" id="l" value="320">	<br>
			G:		<input type="text" name="g" id="g" value="380">	<br>
			F_m:	<input type="text" name="fm" id="fm" value="570">	<br>
			<input type="submit" value = "Submit" method="POST">
		</form>

		 <button id = "initial_data_button" onclick="submit_initial_data()">Click me</button> 
		 <button onclick="destroy_session()"> Destroy your session </button>
		 <button onclick="print_all_data()"> Print all data</button>
	</body>
</html>