<?php
class read_full_dir
{
  var $dir_tree;
  /*================================================
     class constructor
     ================================================*/
  function read_full_dir( $path_to_dir )
  {
    $this->read_directory( $path_to_dir );
  }
  /*================================================
      reads the full directory tree and store it in
      $dir_tree
     ================================================*/
  function read_directory( $directory )
  {
    if ( $handle =     @opendir( $directory ) )
    {
	while ( false !== ( $file = readdir( $handle ) ) )
	{
  	  if ( $file != ".." && $file != "." )
	  {
	    if( is_dir( $directory.DIRECTORY_SEPARATOR.$file))
	    {
	      $this->dir_tree['directories'][] = $directory.DIRECTORY_SEPARATOR.$file;
	      $this->read_directory( $directory.DIRECTORY_SEPARATOR.$file );
	    }
	    else
	      $this->dir_tree['files'][] = $directory.DIRECTORY_SEPARATOR.$file;
	  }
	}
    }
  }
 
  function delete_directory()
  {
	if( is_array( $this->dir_tree['files'] ) )
	{
		foreach( $this->dir_tree['files'] as $value)
			@unlink($value);
	}
	if(is_array($this->dir_tree['directories']))
	{
		$this->dir_tree['directories'] = array_reverse($this->dir_tree['directories']);
		foreach($this->dir_tree['directories'] as $value)
			rmdir($value);
	}
  }
}
?>