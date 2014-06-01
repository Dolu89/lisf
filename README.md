lisf
====
---

Introduction
====
lisf est un script php permettant de lister les fichiers du mois en cours se trouvant dans un dossier ainsi que les archives.

----
Installation
====
Dans le fichier *index.php*, indiquez le répertoire d'installation du script dans la variable `$install_path` à la ligne 80.

Par exemple, si le script est installé dans le sous répertoire `http://dol.lu/files/`, la variables devra être initialisée comme ceci : `$install_path = "/files/";`.

Si vous souhaitez simplement installer le script à la racine, laissez la variable vide : `$install_path = "";`

Puis mettez simplement le fichier *index.php* à l'endroit où vous souhaitez lister vos dossiers/fichiers.

----
Convention à respecter
====
Le nom des dossiers doivent être datés sous cette forme `2014-06` (année-mois).

Pour être sûr de respecter cette convention, vous pouvez utiliser [lisf-client](#) (bientôt disponible)
