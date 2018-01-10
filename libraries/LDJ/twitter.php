<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr-fr" lang="fr-fr" >
<head>
  <base href="http://blog.neamar.fr/" />
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
  <meta name="robots" content="index, follow" />
  <meta name="keywords" content="blog, neamar, lien, liens, jour, jeudi, articles, programmation, geek" />
  <meta name="description" content="Blog de Neamar" />
  <title>Des tweets, des tweets et encore des tweets.</title>

  <link href="/templates/siteground-j15-68/favicon.ico" rel="shortcut icon" type="image/x-icon" />

<link href="http://feeds.feedburner.com/Neamar" type="application/rss+xml" rel="alternate" title="Le flux Ã  suivre ;)" />
<link rel="stylesheet" href="/templates/system/css/system.css" type="text/css" />
<link rel="stylesheet" href="/templates/siteground-j15-68/css/template.css" type="text/css" />
</head>


<?php

include('../../configuration.php');
$config = new JConfig();

mysql_connect($config->host, $config->user, $config->password);
mysql_select_db($config->db);

$articles=mysql_query('SELECT introtext
FROM blog_content
WHERE (catid = 2 OR catid = 28)
AND introtext LIKE "%<ul>%"
AND alias LIKE "%jeudi%"
ORDER BY id DESC
');

$twitter=array();
$matches = array();
while($article=mysql_fetch_assoc($articles))
{
	if(preg_match_all('`<li>(.+)</li>`U', $article['introtext'], $matches) > 0)
	{
		array_splice($twitter, count($twitter), 0, $matches[1]);
	}
}

?>

<style type="text/css">
#page_bg
{
	padding-top:30px;
}
ol
{
	font-size:1.2em;
	margin-left:30px;
	padding:30px;

	width:700px;
	margin:auto;
}
li
{
	margin-bottom:2em;
}
</style>
<h1 style="clear:both;">Des tweets, des tweets et encore des tweets.</h1>
<div id="page_bg">
<ol reversed>
<li>
<?php
echo implode("</li>\n<li>", $twitter); ?>
</li>
</ol>

<p>Cette page générée automatiquement contient de nombreux tweets "contextuels", qui nécessitent d'être liés à un évènement chronologique pour être compréhensibles.<br />
La plupart de ces tweets sont honteusement volés sans même citer l'auteur original.</p>