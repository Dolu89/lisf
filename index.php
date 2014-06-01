<!doctype html>
<!--[if lte IE 7]> <html class="no-js ie67 ie678" lang="fr"> <![endif]-->
<!--[if IE 8]> <html class="no-js ie8 ie678" lang="fr"> <![endif]-->
<!--[if IE 9]> <html class="no-js ie9" lang="fr"> <![endif]-->
<!--[if gt IE 9]> <!--><html class="no-js" lang="fr"> <!--<![endif]-->
<head>
		<meta charset="UTF-8">
		<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
		<title>lisf</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!--[if lt IE 9]>
		<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
</head>
<body>
	<?php 

		$folders = array();

		$exclude_list = array(".", "..", ".git", ".gitignore", "README.md", "index.php", ".DS_Store");
		$install_path = "/lisf/";

		if (isset($_GET["dir"])) {
		  $dir_path = $_SERVER["DOCUMENT_ROOT"].$install_path.$_GET["dir"];
		}
		else {
		  $dir_path = $_SERVER["DOCUMENT_ROOT"].$install_path;
		}

		function dir_nav() {
			global $exclude_list, $dir_path;
			$directories = array_diff(scandir($dir_path), $exclude_list);
			echo "<ul>";
			foreach($directories as $entry) {
				if(is_dir($dir_path.$entry)) {
					echo "<li><a href='?dir=".$_GET["dir"].$entry."/"."'>".$entry."</a></li>";
				}
			}
			echo "</ul>";

			echo "<ul>";
			foreach($directories as $entry) {
				if(is_file($dir_path.$entry)) {
					echo "<li><a href=".$install_path.$_GET["dir"].$entry.">".$entry."</a></li>";
				}
			}
			echo "</ul>";
		}

		dir_nav();

	 ?>
</body>
</html>