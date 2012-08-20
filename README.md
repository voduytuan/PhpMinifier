PhpMinifier

Author: Vo Duy Tuan <tuanmaster2002@yahoo.com>
Version: 1.0
Release Date: August 20, 2012
------------------------------
HOW IT WORKS:
 - This script will scan the source directory and copy the file/directory structure to destination. With PHP files, it will strip the comment and un-need whitespace (same with php -v command in PHP CLI mode)

REQUIREMENT:
 - This script requires PHP 5.x to run.

CONFIGURATION & RUNNING:
 - Config Source and Destination PATH in './index.php'
 - Backup your source before using
 - Copy full source code to './_source/' directory
 - Empty './_destination/' directory. Set write permission (CHMOD 777) for script to write new file/directory.
 - Run './index.php' to start obfuscator