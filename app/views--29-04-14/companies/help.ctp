<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo (!empty($dataprojects['Project']['sitename'])) ? $dataprojects['Project']['sitename'] : $dataprojects['Project']['project_name'];?> :: Help</title>
	<style type="text/css">
		body {
    		color: #222222;
    		font-family: Arial,Verdana,sans-serif;
    		font-size: 12px;
		}
	</style>

</head>
<body>
	<?php echo $hlpdata[0]['HelpContent']['content'];?>
</body>
</html>
