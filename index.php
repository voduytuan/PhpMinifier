<?php


/**
* Ung dung dung de tao version obfuscate cho cac file php
* 
* Doi voi cac file php thi su dung PHP CLI php -w filename de strip comment va whitespace
* con doi voi cac file khac thi tu dong copy ma thoi
* 
* @author: Vo Duy Tuan <webmaster@vinabranding.com>
* @website: http://bloghoctap.com
*/


//no timeout
set_time_limit(0);

include('class.read_full_dir.php');
$workingPath = dirname(__FILE__);


//Thu muc chua source cua website can obfuscate
//ket thuc khong co dau slash '/'
//tip:ban nen backup thu muc nay, boi vi co the neu co truc trac thi se khong co van de gi voi source goc
$sourceDirectory = $workingPath . DIRECTORY_SEPARATOR . '_source';
$destinationDirectory = $workingPath . DIRECTORY_SEPARATOR . '_destination';

//false neu khong muon tao cau truc thu muc
$createDirectory = true;

//init
$showSubmitButton = false;

//create directory in destination folder
echo '<html>
		<head>
			<title>BHT Fuscator - Lightweight PHP Obfuscator</title>
		</head>
		<body>
		<h1>BHT Fuscator - Lightweight PHP Obfuscator</h1>
		<hr />';
echo '	<h2>Obfuscate directory <em><u>' . $sourceDirectory . '</u></em> </h2>';

$startObfuscate = true;

//kiem tra destinationDirectory co empty khong
if ( ($files = @scandir($destinationDirectory)) && count($files) > 2)
{
	echo '<h3 style="color:#f00">Destination Directory (<em><u>'.$destinationDirectory.'</u></em>) is not empty. Delete all its subdirectories and files before start.</h3>';
	$startObfuscate = false;
}

if(!file_exists($sourceDirectory) || !is_dir($sourceDirectory))
{
	echo '<h3 style="color:#f00">Source Directory (<em><u>'.$sourceDirectory.'</u></em>) is not found.</h3>';
	$startObfuscate = false;
}

if(!file_exists($destinationDirectory) || !is_dir($destinationDirectory))
{
	echo '<h3 style="color:#f00">Destination Directory (<em><u>'.$destinationDirectory.'</u></em>) is not found. <a href="?createdes" title="click here to create destination directory">[Click here to create]</a></h3>';
	$startObfuscate = false;
}

if(isset($_GET['createdes']))
{
	if(!file_exists($destinationDirectory) || !is_dir($destinationDirectory))
	{
		if(mkdir($destinationDirectory, 0777))
		{
			echo '<h3 style="color:#00f">Create Destination Directory (<em><u>'.$destinationDirectory.'</u></em>) successfully.</h3>';
			echo '<form method="post" action="?"><input type="submit" name="fsubmit" value="  START OBFUSCATOR  " /></form>';
			$showSubmitButton = true;
		}
		else
		{
			echo '<h3 style="color:#f00">Create Destination Directory (<em><u>'.$destinationDirectory.'</u></em>) fail.</h3>';
			
		}
	}
	else
	{
		echo '<h3 style="color:#f00">Destination Directory (<em><u>'.$destinationDirectory.'</u></em>) is existed.</h3>';
	}
}

if($startObfuscate)
{
	if(isset($_POST['fsubmit']))
	{
		$obj = new read_full_dir($sourceDirectory);
		
		echo '<h2>Create Directory Structure</h2>';
		for($i = 0; $createDirectory && $i < count($obj->dir_tree['directories']); $i++)
		{
			$dirname = $obj->dir_tree['directories'][$i];
			$newdirname = str_replace($sourceDirectory, $destinationDirectory, $dirname);
			if(mkdir($newdirname))
			{
				echo '<div style="color:#090">Creating directory <strong><em>' . $newdirname . '</em></strong>...OK</div>';	
			}
			else
			{
				echo '<div style="color:#f00">Creating directory <strong><em>' . $newdirname . '</em></strong>...Fail</div>';	
			}
		}

		echo '<h2>Copy Normal Files &amp; SCAN PHP files for obfuscator</h2>';
		//process file (copy normal file and obfusce php file)

		for($i = 0; $i < count($obj->dir_tree['files']); $i++)
		{
			$filename = $obj->dir_tree['files'][$i];
			$newfilename = str_replace($sourceDirectory, $destinationDirectory, $filename);
			
			$sourceExt = strtolower(substr($filename, strrpos($filename, '.') + 1));
			
			//normal file, just copy file
			if($sourceExt != 'php')
			{
				if(copy($filename, $newfilename))
				{
					echo '<div style="color:#090">Copying file <strong><em>' . $newfilename . '</em></strong>...OK</div>';	
				}
				else
				{
					echo '<div style="color:#f00">Copying file <strong><em>' . $newfilename . '</em></strong>...Fail</div>';	
				}
			}
			else
			{
				$strippedsource = php_strip_whitespace($filename);
				if($strippedsource !== false)
				{
					file_put_contents($newfilename, $strippedsource);
					echo '<div style="color:#00f">Process file <strong style="font-family:Courier New;"><em><small>' . $filename . '</small></em></strong>...OK</div>';	
				}
				else
				{
					echo '<div style="color:#f00">Process file <strong style="font-family:Courier New;"><em><small>' . $filename . '</small></em></strong>...Fail</div>';	
				}
			}
		}
		
		echo '<hr /><h2>SCAN Structure successfully.</h2>';
	}
	else
	{
		if(!$showSubmitButton)
			echo '<form method="post" action="?"><input type="submit" name="fsubmit" value="  START OBFUSCATOR  " /></form>';

	}
}

echo '<hr /><p style="text-align:center;">Copyright &copy; 2011 BlogHoctap.com. Developed by Vo Duy Tuan &lt;tuanmaster2002@yahoo.com&gt;</p>
</body></html>';


