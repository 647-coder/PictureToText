<?php
if(empty($_POST['beishu']))
	$beishu = 1;
else
	$beishu = $_POST['beishu'];
if ((($_FILES["file"]["type"] == "image/png")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/pjpeg"))
&& ($_FILES["file"]["size"] < 10000))
{
	if ($_FILES["file"]["error"] > 0)
	{
		echo "�ϴ�ʧ��";
	}
	else
	{
		//echo "Upload: " . $_FILES["file"]["name"] . "<br />";
		//echo "Type: " . $_FILES["file"]["type"] . "<br />";
		//echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
		//echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
		if (file_exists("/var/www/html/picture/" . $_FILES["file"]["name"]))
		{
			 echo "������ļ�����";
		}
		else
		{
			move_uploaded_file($_FILES["file"]["tmp_name"],
			"/var/www/html/picture/" . $_FILES["file"]["name"]);
			passthru('python /var/www/html/picture/run.py -r'.$beishu.' '."/var/www/html/picture/".$_FILES["file"]["name"]);
			echo "ת���ɹ���";
			header("location: http://ustil.cn/picture/".$_FILES["file"]["name"].".txt");
		}
	}
}
else
{
	echo "�ϴ�ʧ�ܡ�";
}

?>
