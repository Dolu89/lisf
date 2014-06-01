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
		/* Fonctions */
		function dir_nav($specificFolder) {
			global $exclude_list, $dir_path;

			if ($specificFolder == "") {
				$directories = array_diff(scandir($dir_path), $exclude_list);
				echo "<ul>";
				foreach($directories as $entry) {
					if(is_dir($dir_path.$entry)) {
						echo "<li><a href='?dir=".$_GET["dir"].$entry."/"."'>".$entry."</a></li>";
					}
				}
				echo "</ul>";
			}
			else {
				$files = array_diff(scandir($dir_path.$specificFolder), $exclude_list);
				
				if (count($files)==0) {
					echo "Rien ce mois-ci...";
				}
				else{
					echo "Les fichiers du mois";
					echo "<ul>";
					foreach($files as $entry) {
						if(is_file($dir_path.$specificFolder."/".$entry)) {
							echo "<li><a href=".$specificFolder."/".$entry.">".$entry."</a></li>";
						}
					}
					echo "</ul>";
				}
			}
			
		}

		function list_dir()
		{

			global $exclude_list, $dir_path, $folders;
			$directories = array_diff(scandir($dir_path), $exclude_list);
			foreach($directories as $entry) {
				if(is_dir($dir_path.$entry)) {
					array_push($folders, $entry);
				}
			}

		}
		/* Fin des fonctions */

		/* Déclaration des variables */
		$folders = array();
		$todayYear = date("Y");
		$todayMonth = date("m");
		$todayFolderFormat = $todayYear."-".$todayMonth;

		$exclude_list = array(".", "..", ".git", ".gitignore", "README.md", "index.php", ".DS_Store");
		$install_path = "/lisf/";

		if (isset($_GET["dir"])) {
		  $dir_path = $_SERVER["DOCUMENT_ROOT"].$install_path.$_GET["dir"];
		}
		else {
		  $dir_path = $_SERVER["DOCUMENT_ROOT"].$install_path;
		}
		/* Fin de la déclaration des variables */

		/* Début du programme de base */
		dir_nav("");
		list_dir();

		foreach ($folders as $folder) {
			if ($todayFolderFormat == $folder) {
				dir_nav($folder);
			}
		}
		/* Fin du programme de base*/

	 ?>
</body>
</html>