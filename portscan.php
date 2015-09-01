<?php
	/* fsock() PortScanner
		by jburke@wapacklabs.com */
	//BEGIN RETRO ASCII ART:
	/*

	________________$$$$			______________☆☆☆☆ 
	______________$$____$$			____________☆******* ☆
	______________$$____$$			________☆*********** ☆ 
	______________$$____$$			______☆************☆ 
	______________$$____$$			__☆*************☆???? 
	______________$$____$$			☆*********☆?????????$ 
	__________$$$$$$____$$$$$$		☆****☆$$????????????$
	________$$____$$____$$____$$$$		__☆$$????????????????$ 
	________$$____$$____$$____$$__$$	____$?????????????????$ 
	$$$$$$__$$____$$____$$____$$____$$	_____$?????????????????$
	$$____$$$$________________$$____$$	______$????????????????$$ 
	$$______$$______________________$$	_______$?????????????$$$$$ 
	__$$____$$______________________$$	________$???????????$$$$$$$
	___$$$__$$______________________$$	_________$??????????$$$$$$$$$ 
	____$$__________________________$$	_________$????????????$$$$$$$$ 
	_____$$$________________________$$	________$????????????$$$$$$$$$ 
	______$$______________________$$$	_______$????????????$$$$$$$$$ 
	_______$$$____________________$$	_____$?????????????????$$$$ 
	________$$____________________$$	___$$$??????????????????$ 
	_________$$$________________$$$		__$$$$$????????????????$ 
	__________$$________________$$		_$$$$$$$??????????????$ 
	__________$$$$$$$$$$$$$$$$$$$$		$$$$$$$$$$???????????$ 
						$$$$$$$$$$$$????????$ 
						_$$$$$$$$$$$$$?????$ 
						__$$$$$$$$$$$$$$??$ 
						____☆$$$$$$$$$$$☆			...PortScanner =P
	*/
?>
<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Latest compiled and minified CSS -->
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Optional theme -->
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css" rel="stylesheet">
</head>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<body>
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">fsock() Portscanner</a>
        </div>
    </div>
</div>
<div class="container">
    <div class="starter-template">
        <h2>^.^</h2>
    </div>
<b>If no port is specified default is 21, 22, 23, 25, 53, 80, 110, 1337, 1433, 3306, 8080:</b></BR></BR>
<form method="post" >
	Domain/IP: 
	<input type="text" name="domain" /> 
	<input type="text" name="ports" />
	<input type="submit" value="Scan" />
</form>
<br />
 
<?php
$x = 0;
//Benchmark 100 in 2 seconds:
/*while ($x != 100){
	$ports2[] .=$x;
	$x++;
}*/
if(!empty($_POST['ports'])){
	$ports = $_POST['ports'];
	if (strpos($ports,',') !== false) {
		$port = explode(",", $ports);
	}else{
		$port[] = $ports;
	}
}
if(!empty($_POST['domain'])) {	
	//list of port numbers to scan
	if(isset($port)){
		$ports = $port;
	}else{
		$ports = array(21, 22, 23, 25, 53, 80, 110, 1337, 1433, 3306, 8080);
	}
	$results = array();
	foreach($ports as $port) {
		if($pf = @fsockopen($_POST['domain'], $port, $err, $err_string, 1)) {
			$results[$port] = true;
			fclose($pf);
		} else {
			$results[$port] = false;
		}
	}
 
	foreach($results as $port=>$val)	{
		$prot = getservbyport($port,"tcp");
                echo "Port $port ($prot): ";
		if($val) {
			echo "<span style=\"color:green\">OK</span><br/>";
		}
		else {
			echo "<span style=\"color:red\">Inaccessible</span><br/>";
		}
	}
}
?>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</body>
</html>

