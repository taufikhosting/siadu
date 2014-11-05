<?php

/******************** IMAGE PROCESSING ********************/
define ("MAX_SIZE","1366");

$imessage="";
 
 $errors=0;
 
 if($_SERVER["REQUEST_METHOD"] == "POST" || true)
 {
	$image =$_FILES["file"]["name"];
	$uploadedfile = $_FILES['file']['tmp_name'];

	if ($image) 
	{
		$filename = stripslashes($_FILES['file']['name']);
		$extension = getExtension($filename);
		$extension = strtolower($extension);
		if (($extension != "jpg") && ($extension != "jpeg") 
		&& ($extension != "png") && ($extension != "gif")) 
		{
			$imessage='Unknown Image extension';
			$errors=1;
		}
		else
		{
			$size=filesize($_FILES['file']['tmp_name']);

			if ($size > MAX_SIZE*1024)
			{
				$imessage="You have exceeded the size limit";
				$errors=1;
			}

			if($extension=="jpg" || $extension=="jpeg" )
			{
				$uploadedfile = $_FILES['file']['tmp_name'];
				$src = imagecreatefromjpeg($uploadedfile);
			}
			else if($extension=="png")
			{
				$uploadedfile = $_FILES['file']['tmp_name'];
				$src = imagecreatefrompng($uploadedfile);
			}
			else 
			{
				$src = imagecreatefromgif($uploadedfile);
			}

			list($width,$height)=getimagesize($uploadedfile);

			$newwidth=140;
			
			if($width>$newwidth)
			{
				$newheight=($height/$width)*$newwidth;
				$tmp=imagecreatetruecolor($newwidth,$newheight);

				imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,
				$width,$height);
			} else {
				$newwidth=$width;
				$newheight=($height/$width)*$newwidth;
				$tmp=imagecreatetruecolor($newwidth,$newheight);

				imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,
				$width,$height);
			}

			$filename = $UFPATH.$UFNAME.".".$extension;

			imagejpeg($tmp,$filename,100);

			imagedestroy($src);
			imagedestroy($tmp);
		}
	}
}
/******************** END OF IMAGE PROCESSING ********************/