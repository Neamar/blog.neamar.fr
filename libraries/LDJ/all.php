<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr-fr" lang="fr-fr" >
<head>
  <base href="http://blog.neamar.fr/" />
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
  <meta name="robots" content="index, follow" />
  <meta name="keywords" content="blog, neamar, lien, liens, jour, jeudi, articles, programmation, geek" />
  <meta name="description" content="Blog de Neamar" />
  <title>Des liens, des liens et encore des liens.</title>

  <link href="/templates/siteground-j15-68/favicon.ico" rel="shortcut icon" type="image/x-icon" />

<link href="http://feeds.feedburner.com/Neamar" type="application/rss+xml" rel="alternate" title="Le flux Ã  suivre ;)" />
<link rel="stylesheet" href="/templates/system/css/system.css" type="text/css" />
<link rel="stylesheet" href="/templates/siteground-j15-68/css/template.css" type="text/css" />
</head>


<?php

include('../../../ConnectBDD.php');
function getFavicon($URL)
{
	$URL_parts=parse_url($URL);
	return 'http://www.google.com/s2/favicons?domain=' . $URL_parts['host'];
}

$LDJsSQL=mysql_query('SELECT URL,Titre FROM MISC_LDJ
WHERE Type="LDJ"
ORDER BY ID DESC
LIMIT 50, 1550
');
$LDJs=array();
while($LDJ=mysql_fetch_assoc($LDJsSQL))
	$LDJs[$LDJ['URL']]=$LDJ['Titre'];

?>

<h1 style="clear:both;">Des liens, des liens, encore et toujours des liens (les 1 500 derniers) !</h1>
<div class="ldjvignettes" style="margin:auto">
<?php
$Remplacements=array('Ã©'=>'é','Ã¨'=>'è','Ã'=>'à','Ãª'=>'ê','àª'=>'ê','Â»'=>'»','Â´'=>'´','à§'=>'ç','à®'=>'î','à¶'=>'ö','Ã»'=>'û');

//Afficher par vignettes
foreach($LDJs as $URL=>$Titre)
{
	$Titre=str_replace(array_keys($Remplacements),array_values($Remplacements),$Titre);
	$URL = str_replace('&','&amp;',$URL);
	echo '
<div class="ldjbox" style="background:url(' . getFavicon($URL) . ') no-repeat">
	<h2>' . $Titre . '</h2>
	<span class="LDJPreview"><a href="' . $URL . '"><img src="/images/LDJ/n_' . md5($URL) . '.jpeg" alt="' . preg_replace('#"(.+)"#U','« $1 »',$Titre) . '"/></a></span>
</div>';
}
?>
</div>