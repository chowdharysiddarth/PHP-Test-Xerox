# PHP-Test-Xerox
Repository created for PHP Test [Xerox]

How to Execute This Script
--------------------------

To Execute this script 

path_to_php_compiler init.php username password path_to_repository contributor-name

IMPORTANT : Pass the parameters (4) in the order specified.

1. first parameter is the user name

2. second is password

3. third is the repository url

4. fourth is the contributor name

no -u and -p tag are required explicitly [handled in code]

NOTE : Make sure the parameters are in the order and are correct.


Ex : 
----
1. php init.php username password https://github.com/chowdharysiddarth/PHP-Test-Xerox siddarthchowdhary

2. php init.php username password https://bitbucket.org/testsc123/first siddarthchowdhary


To Extend the functionality 
---------------------------
1. Add a case in the init.php file

2. Create a class for that service and extend it with the abstract class MasterService.
