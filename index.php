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

		/* Déclaration des variables */

		//Variable à modifier
		$install_path = "/lisf/";

		//Ne pas toucher au reste, sauf si vous savez ce que vous faites.
		$folders = array();
		$todayYear = date("Y");
		$todayMonth = date("m");
		$todayFolderFormat = $todayYear."-".$todayMonth;

		$exclude_list = array(".", "..", ".git", ".gitignore", "README.md", "index.php", ".DS_Store");

		$dir_path = $_SERVER["DOCUMENT_ROOT"].$install_path;
		/* Fin de la déclaration des variables */

		/* Fonctions */
		function dir_nav($specificFolder) {
			global $exclude_list, $dir_path;

			if ($specificFolder == "") {
				$directories = array_diff(scandir($dir_path), $exclude_list);
				echo "Archives";
				echo "<ul>";
				foreach($directories as $entry) {
					if(is_dir($dir_path.$entry)) {
						echo "<li><a href='?dir=".$entry."'>".$entry."</a></li>";
					}
				}
				echo "</ul>";
			}
			else {
				if (isset($_GET["dir"])) {
					$dir = $_GET["dir"];
					$files = array_diff(scandir($dir_path.$dir), $exclude_list);
				}
				else{
					$dir = $specificFolder;
					$files = array_diff(scandir($dir_path.$dir), $exclude_list);
				}
				
				if (count($files)==0) {
					echo "Rien ce mois-ci...";
				}
				else{
					echo "Les fichiers du mois<br>";

					$group = array();
					foreach ( $files as $value ) {
						$date = date("j", filectime($dir_path.$dir."/".$value));
					    $group[$date][] = array($date => $value);
					}

					foreach ($group as $subGroup) {
						$x = 0;
						foreach ($subGroup as $sSubGroup) {
							foreach ($sSubGroup as $date => $file) {
								if ($x == 0) {
									echo $date."<br>";
									echo "<a href=".$dir."/".$file.">".$file."</a><br>";
								}
								else{
									echo "<a href=".$dir."/".$file.">".$file."</a><br>";
								}
								++$x;
							}
						}
					}

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

		/* Début du programme de base */
		list_dir();
		dir_nav("");
		if (isset($_GET["dir"])) {
			dir_nav($_GET["dir"]);
		}
		else{
			foreach ($folders as $folder) {
				if ($todayFolderFormat == $folder) {
					dir_nav($folder);
				}
			}
		}
		/* Fin du programme de base*/

	 ?>
</body>
</html>