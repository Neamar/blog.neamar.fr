<?php
include('../../../ConnectBDD.php');
clearstatcache();

$date = preg_replace('[^0-9-]', '', $_GET['date']);

$LDJsSQL=mysql_query('SELECT URL,Titre FROM MISC_LDJ
WHERE Type="LDJ"
AND Date LIKE "' . $date . '-%"
ORDER BY ID DESC
');

$LDJs=array();
while($LDJ=mysql_fetch_assoc($LDJsSQL))
	$LDJs[$LDJ['URL']]=$LDJ['Titre'];


$out = array();
foreach($LDJs as $URL=>$Titre)
{
	$thumbPath = 'images/LDJ/n_' . md5($URL) . '.jpeg';
	if(is_file('../../' . $thumbPath))
	{
		$out[] = array(
			'u' => $URL,
			't' => $Titre,
			'i' => 'http://blog.neamar.fr/images/LDJ/n_' . md5($URL) . '.jpeg'
		);
	}
}

echo json_encode($out);
?>

















