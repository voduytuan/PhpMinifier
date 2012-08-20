PhpMinifier

Author: Vo Duy Tuan <tuanmaster2002@yahoo.com>
Version: 1.0
Release Date: August 20, 2012
------------------------------
HOW IT WORKS:
 - This script will scan the SOURCE directory and copy the file/directory structure to DESTINATION directory. With PHP files, it will strip the comment and un-need whitespace (same with php -v command in PHP CLI mode)

REQUIREMENT:
 - This script requires PHP 5.x to run.

CONFIGURATION & RUNNING:
 - Config SOURCE and DESTINATION path in './index.php'
 - Backup your SOURCE directory before using
 - Copy full source code to SOURCE directory
 - Empty DESTINATION directory. Set write permission (CHMOD 777) for script to write new file/directory.
 - Run './index.php' to start obfuscator