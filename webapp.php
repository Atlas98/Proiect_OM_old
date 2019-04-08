

<?php

error_reporting(E_ALL);
set_time_limit(0);
ob_implicit_flush();

session_start();

print_r($_SESSION);
print_r($_POST);

// -- CONSTANTS --
$action_data_create = 0;
$action_free_data = 1;
$action_set_cs = 2;
$action_set_pv = 3;
$action_set_nv = 4;
$action_set_itct = 5;
$action_set_ir = 6;
$action_set_l = 7;
$action_set_g = 8;
$action_set_fm = 9;
$action_submit_a = 10;
$action_submit_c = 11;
$action_submit_dp1 = 12;
$action_submit_aprel = 13;
$action_submit_q = 14;

// prompt actions are used to receive further instructions as string
$action_prompt_a = 15;
$action_prompt_c = 16;
$action_prompt_dp1 = 17;
$action_prompt_aprel = 18;
$action_prompt_q = 19;

$action_print_base_values = 200;
$action_print_capitol_1 = 201;
$action_print_capitol_2 = 202;
$action_print_capitol_3 = 203;

$action_print_all_data = 240;


if(isset($_POST['destroy_session']) && $_POST['destroy_session'] == 'true') {
	session_destroy();
	echo "destroyed";
	return;
}

// --------- CREATE SESSION WIDE DATA POINTER FOR USER, IF NOT EXISTS
if(empty($_SESSION['data_ptr'])) {
	echo "Empty, creating a new one<br>";
	$sock = create_socket();
	$ptr_varr = send_server_message($sock, $action_data_create, 0, "I want data pointer");
	socket_close($sock);
	$_SESSION['data_ptr'] = $ptr_varr;
	echo "Done creating data ptr <br>";
}
$data_ptr = $_SESSION['data_ptr']; // data pointer
echo "Session pointer: " . $data_ptr . "<br>";



// ---------- LOGIC
if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['action'])) {
	$data_ptr = $_SESSION['data_ptr'];

	if($_POST['action'] == "submit_initial_data") {
		// send initial data
		$ret_msg = send_initial_data();
		echo $ret_msg;
	}
	elseif($_POST['action'] == "print_all_data") {
		$sock = create_socket();
		$ret_msg = send_server_message($sock, $GLOBALS['action_print_all_data'], $data_ptr, 'nope');
		socket_close($sock);
		echo $ret_msg;
	}
	elseif($_POST['action'] == "print_initial_data") {
		$sock = create_socket();
		$ret_msg = send_server_message($sock, $GLOBALS['action_print_base_values'], $data_ptr, '');
		socket_close($sock);
		echo $ret_msg;
	}
	elseif($_POST['action'] == "print_capitol_1_data") {
		$sock = create_socket();
		$ret_msg = send_server_message($sock, $GLOBALS['action_print_capitol_1'], $data_ptr, '');
		socket_close($sock);
		echo $ret_msg;
	}
	elseif($_POST['action'] == "print_capitol_2_data") {
		$sock = create_socket();
		$ret_msg = send_server_message($sock, $GLOBALS['action_print_capitol_2'], $data_ptr, '');
		socket_close($sock);
		echo $ret_msg;
	}
	elseif($_POST['action'] == "print_capitol_3_data") {
		$sock = create_socket();
		$ret_msg = send_server_message($sock, $GLOBALS['action_print_capitol_3'], $data_ptr, '');
		socket_close($sock);
		echo $ret_msg;
	}
	elseif($_POST['action'] == "get_prompt_a") {
		//$sock = create_socket();
		//$ret_msg = send_server_message($sock, $GLOBALS['action_prompt_a'], $data_ptr, '');
		//socket_close($sock);
		//return $ret_msg;
		echo 'Introdu o valoare a lui a';
	}
	elseif($_POST['action'] == "set_a") {
		$sock = create_socket();
		$ret_msg = send_server_message($sock, $GLOBALS['action_submit_a'], $data_ptr, $_POST['value']);
		socket_close($sock);
		echo $ret_msg;
	}
	elseif($_POST['action'] == "get_prompt_c") {
		//$sock = create_socket();
		//$ret_msg = send_server_message($sock, $GLOBALS['action_prompt_c'], $data_ptr, '');
		//socket_close($sock);
		//return $ret_msg;
		echo 'Introdu o valoare a lui c';
	}
	elseif($_POST['action'] == "set_c") {
		$sock = create_socket();
		$ret_msg = send_server_message($sock, $GLOBALS['action_submit_c'], $data_ptr, $_POST['value']);
		socket_close($sock);
		echo $ret_msg;
	}
	elseif($_POST['action'] == "get_prompt_dp1") {
		//$sock = create_socket();
		//$ret_msg = send_server_message($sock, $GLOBALS['action_prompt_dp1'], $data_ptr, '');
		//socket_close($sock);
		//return $ret_msg;
		echo 'Introdu o valoare a lui dp1';
	}
	elseif($_POST['action'] == "set_dp1") {
		$sock = create_socket();
		$ret_msg = send_server_message($sock, $GLOBALS['action_submit_dp1'], $data_ptr, $_POST['value']);
		socket_close($sock);
		echo $ret_msg;
	}
	elseif($_POST['action'] == "get_prompt_aprel") {
		//$sock = create_socket();
		//$ret_msg = send_server_message($sock, $GLOBALS['action_prompt_aprel'], $data_ptr, '');
		//socket_close($sock);
		//return $ret_msg;
		echo 'Introdu o valoare a lui aprel';
	}
	elseif($_POST['action'] == "set_aprel") {
		$sock = create_socket();
		$ret_msg = send_server_message($sock, $GLOBALS['action_submit_dp1'], $data_ptr, $_POST['value']);
		socket_close($sock);
		echo $ret_msg;
	}
	elseif($_POST['action'] == "get_prompt_q") {
		//$sock = create_socket();
		//$ret_msg = send_server_message($sock, $GLOBALS['action_prompt_q'], $data_ptr, '');
		//socket_close($sock);
		//return $ret_msg;
		echo 'Introdu o valoare a lui q';
	}
	elseif($_POST['action'] == "set_q") {
		$sock = create_socket();
		$ret_msg = send_server_message($sock, $GLOBALS['action_submit_q'], $data_ptr, $_POST['value']);
		socket_close($sock);
		echo $ret_msg;
	}



} // if post and has action 
else {
	echo "Request method: " . $_SERVER['REQUEST_METHOD'];
	print_r($_POST);
	echo "POST_ONLY";
}


// ----------- FUNCTIONS ------------

// socket_close($sock) to close;
function create_socket() {
	$address = '127.0.0.1';
	$port = 5555;

	if (($sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) === false) {
	    echo "socket_create() failed: reason: " . socket_strerror(socket_last_error()) . "\n";
	}

	if(socket_connect($sock, $address, $port) == false) {
		echo "socket_connect() failed: reason: " . socket_strerror(socket_last_error($sock)) . "\n";
	}
	return $sock;
}

// send data - predefined
function send_initial_data() {
	print_r($_POST);
	$cs   = $_POST['cs'];
	$pv   = $_POST['pv'];
	$nv   = $_POST['nv'];
	$itct = $_POST['itct'];
	$ir   = $_POST['ir'];
	$l    = $_POST['l'];
	$g    = $_POST['g'];
	$fm   = $_POST['fm'];

	if(!is_numeric($cs) 	|| empty($cs)) 		return "NaN_cs";
	if(!is_numeric($pv)		|| empty($pv))		return "NaN_pv";
	if(!is_numeric($nv)		|| empty($nv))		return "NaN_nv";
	if(!is_numeric($itct)	|| empty($itct)) 	return "NaN_itct";
	if(!is_numeric($ir)		|| empty($ir))		return "NaN_ir";
	if(!is_numeric($l)		|| empty($l)) 		return "NaN_l";
	if(!is_numeric($g)		|| empty($g)) 		return "NaN_g";
	if(!is_numeric($fm)		|| empty($fm)) 		return "NaN_fm";


	$sock = create_socket();
	$data_ptr = $_SESSION['data_ptr'];

	if($data_ptr == 0) return "data_ptr_null";
	send_server_message($sock, $GLOBALS['action_set_cs']   , $data_ptr, $cs);
	send_server_message($sock, $GLOBALS['action_set_pv']   , $data_ptr, $pv);
	send_server_message($sock, $GLOBALS['action_set_nv']   , $data_ptr, $nv);
	send_server_message($sock, $GLOBALS['action_set_itct'] , $data_ptr, $itct);
	send_server_message($sock, $GLOBALS['action_set_ir']   , $data_ptr, $ir);
	send_server_message($sock, $GLOBALS['action_set_l']    , $data_ptr, $l);
	send_server_message($sock, $GLOBALS['action_set_g']    , $data_ptr, $g);
	send_server_message($sock, $GLOBALS['action_set_fm']   , $data_ptr, $fm);
	socket_close($sock);

	return "Success";
}

function logg($msg) {
	echo $msg;
}

function print_data() {
	$sock = create_socket();
	$ret = send_local_message($sock, 'print');
	socket_close($sock);
	return $ret;
}

function send_server_message($sock,$action, $data_ptr, $msg) {
	socket_write($sock, $action, strlen($action));
	$msg_read = socket_read($sock, 1024, PHP_NORMAL_READ);

	socket_write($sock, $data_ptr, strlen($data_ptr));
	$msg_read = socket_read($sock, 1024, PHP_NORMAL_READ);

	socket_write($sock, $msg, strlen($msg));
	$msg_read = socket_read($sock, 1024, PHP_NORMAL_READ);

	return $msg_read;
}	// send local message



/*
function send_local_message($sock, $msg) {
	socket_write($sock, $msg, strlen($msg));

	$msg_read = socket_read($sock, 1024, PHP_NORMAL_READ);
	return $msg_read;
}	// send local message
*/

?>

