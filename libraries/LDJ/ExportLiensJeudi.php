<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr-fr" lang="fr-fr" >
<head>
  <base href="http://blog.neamar.fr/" />
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
  <meta name="robots" content="index, follow" />
  <meta name="keywords" content="blog, neamar, lien, liens, jour, jeudi, articles, programmation, geek" />
  <meta name="description" content="Blog de Neamar Welcome on the Internet" />
  <meta name="generator" content="Joomla! 1.5 - Open Source Content Management" />
  <title>Exportation des LDJ</title>

  <link href="/templates/siteground-j15-68/favicon.ico" rel="shortcut icon" type="image/x-icon" />
  <script type="text/javascript" src="/media/system/js/mootools.js"></script>
  <script type="text/javascript" src="/media/system/js/caption.js"></script>

<link href="http://feeds.feedburner.com/Neamar" type="application/rss+xml" rel="alternate" title="Le flux Ã  suivre ;)" />
<link rel="stylesheet" href="http://blog.neamar.fr/templates/protostar/css/template.css" type="text/css" />

<!--[if lte IE 6]>
<link href="/templates/siteground-j15-68/css/ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->

</head>


<?php

include('../../../ConnectBDD.php');
clearstatcache();
function getFavicon($URL)
{
	$URL_parts=parse_url($URL);
	return 'http://www.google.com/s2/favicons?domain=' . $URL_parts['host'];
}

if($_GET['Type']=='LDJ')
{
	$Date=date('N');//Numéro du jour
	if($Date==4)
		$DateLimite=mktime(0,0,0,date('n'),date('j'),date('Y'))-6*3600*24;
	elseif($Date<4)
		$DateLimite=mktime(0,0,0,date('n'),date('j'),date('Y'))-(2+$Date)*3600*24;
	else
		$DateLimite=mktime(0,0,0,date('n'),date('j'),date('Y'))-($Date-5)*3600*24;

	$DateSQL=date('Y-m-d',$DateLimite);
}
elseif($_GET['Type']=='LDR')
{

	if(!isset($_POST['Date']))
	{?>
		<form method="post" action="">
		<input type="text" value="2010-01-30" name="Date" id="Date" /><input type="submit" value="Afficher" />
		</form>
		<?php
		exit();
	}
	else
		$DateSQL=$_POST['Date'];//Numéro du jour
}
else
	exit('Type inconnu.');

if(isset($_GET['force']))
{
	$DateSQL=$_GET['force'];
}
echo '<p>Affichage des liens >=' . $DateSQL . '</p>';

$LDJsSQL=mysql_query('SELECT URL,Titre FROM MISC_LDJ
WHERE Type="' . $_GET['Type'] . '"
AND Date >= "' . $DateSQL . '"
');
$LDJs=array();
while($LDJ=mysql_fetch_assoc($LDJsSQL))
	$LDJs[$LDJ['URL']]=$LDJ['Titre'];


//Étape interne : télécharger les images sur le serveur
$Dest='../../images/LDJ/';


foreach($LDJs as $URL=>$Titre)
{
	$URLImage = $Dest . 'n_' . md5($URL) . '.jpeg';
	if(!is_file($URLImage))
	{
		echo '<br />Chargement, image ' . $URL;
		$DL = curl_init();
		curl_setopt($DL, CURLOPT_URL,'http://s0.wordpress.com/mshots/v1/' . urlencode($URL) . '/?w=202');
		curl_setopt($DL, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($DL, CURLOPT_USERAGENT, "Mozilla/5.0 (Linux; U; Android 2.3.5; fr-fr; E310 Build/GRJ90) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1");
		$image = curl_exec($DL);
		$http_status = curl_getinfo($DL, CURLINFO_HTTP_CODE);
		curl_close($DL);
		
		$sha = sha1($image);
		if($http_status != 200 or $sha == 'da39a3ee5e6b4b0d3255bfef95601890afd80709' or $sha == '6c665dcfb0303a67024de3d694f810669ae188e2')
			echo ' (<strong>image indisponible</strong>)';
		else
		{
			$handle = fopen($URLImage, 'w');
			fputs($handle,$image);
			fclose($handle);
		}
	}
}
?>


















<?php
$Sections=array('Liens'=>array(),'Images'=>array(),'Vidéos'=>array());
$Images=array('jpg','png','gif','peg');
foreach($LDJs as $URL=>$Titre)
{
	//Trier les liens par catégories
	if(strpos($URL,'youtube')!==false || strpos($URL,'dailymotion')!==false || strpos($URL,'metacafe')!==false  || strpos($URL,'video')!==false || strpos($URL,'vimeo')!==false || strpos($URL,'ted.com')!==false || stripos($Titre,'video')!==false || stripos($Titre,'vidéo')!==false)
		$Sections['Vidéos'][$URL]=$Titre;
	elseif(in_array(strtolower(substr($URL,-3)),$Images) || strpos($URL,'twitpic')!==false || strpos($URL,'xkcd')!==false || strpos($URL,'abstrusegoose')!==false || stripos($URL,'img')!==false || stripos($URL,'comic')!==false || stripos($URL,'photo')!==false || stripos($URL,'9gag')!==false || stripos($URL,'poster')!==false || stripos($URL,'image')!==false  || stripos($Titre,'image')!==false)
		$Sections['Images'][$URL]=$Titre;
	else
		$Sections['Liens'][$URL]=$Titre;
}

//Voir tous les liens
?>
<p>Et voilà une nouvelle fournée toute chaude de liens du jeudi.<br />
Attention : certains liens peuvent choquer les plus jeunes.<br />
Attention : certains liens peuvent choquer les plus vieux.<br />
Attention : certains liens peuvent choquer les amputés du second degré.<br />
Attention : certains liens contiennent des petites pièces ne convenant pas aux enfants de moins de trois mois &ndash; risques d'étouffement.</p>

<p>Je tiens à préciser que la présence de certains liens ne vaut pas comme une approbation de ma part du contenu : il y a du lol, il y a du triste, il y a du noir, il y a des moqueries, il y a des réflexions, il y a du geek, il y a des pages que je méprise et d'autres que j'adore. Je n'indique pas cet état d'esprit sur le lien, à chacun de se forger sa propre opinion en fonction de ses convictions.<br />
À consommer avec modération ; cette page n'est qu'une porte de sortie vers d'autres mondes.</p>

<p>Moisson de la semaine : <?php echo count($LDJs); ?> liens.</p>

<p>Pensées twitter :</p>
<ul>

</ul>

<hr id="system-readmore" />

<p><a href="http://blog.neamar.fr/component/content/category/3-liens-humour-jeudi" title="Tous les épisodes des liens du jeudi">Retrouvez tous les épisodes des liens du jeudi !</a></p>
<?php
foreach($Sections as $Type=>$LDJs)
{?>


<h1 style="clear:both;"><?php echo $Type; ?></h1>
<p>Pressé ? <a href="#" onclick="openAll<?php echo $Type; ?>()">Cliquez pour ouvrir tous les liens d'un seul coup</a> !</p>
<script type="text/javascript">
<!--
	function openAll<?php echo $Type; ?>()
	{
<?php
		foreach($LDJs as $URL=>$Titre)
			echo '	window.open("' . $URL . '");' . "\n";
		?>
	}
-->
</script>

<div class="ldjvignettes" style="margin:auto">
<?php
$Remplacements=array('Ã©'=>'é','Ã¨'=>'è','Ã'=>'à','Ãª'=>'ê','àª'=>'ê','Â»'=>'»','Â´'=>'´','à§'=>'ç','à®'=>'î','à¶'=>'ö','Ã»'=>'û');

	//Afficher par vignettes
	foreach($LDJs as $URL=>$Titre)
	{
		$Titre=str_replace(array_keys($Remplacements),array_values($Remplacements),$Titre);
		$URL = str_replace('&','&amp;',$URL);
		echo '
	<div class="ldjbox well">
		<h2>' . $Titre . '</h2>
		<span class="LDJPreview">
			<a href="' . $URL . '">
				<img src="/images/LDJ/n_' . md5($URL) . '.jpeg" alt="' . preg_replace('#"(.+)"#U','« $1 »',$Titre) . '"/>
			</a>
		</span>
	</div>';
	}
}
?>
<p style="clear:both">Rendez-vous la semaine prochaine pour de nouvelles aventures !</p>
</div>