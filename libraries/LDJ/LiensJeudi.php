<script type="text/javascript">
	setTimeout("window.close()", 500);
</script>

<?php
if(!isset($_GET['URL'],$_GET['Titre'],$_GET['Type']))
	exit("Appel incorrect.");

$_GET['URL']=preg_replace('`(youtube\.com/watch\?v=[^&])&.+$`','$1',$_GET['URL']);

$Remplacements=array('Ã©'=>'é','Ã¨'=>'è','Ã'=>'à','Ãª'=>'ê','àª'=>'ê','Â»'=>'»','Â´'=>'´','à§'=>'ç','à®'=>'î','à¶'=>'ö','Ã»'=>'û');
$_GET['Titre']=str_replace(array_keys($Remplacements),array_values($Remplacements),$_GET['Titre']);

include('../../../ConnectBDD.php');
mysql_query('INSERT INTO MISC_LDJ VALUES("", NOW(),"' . $_GET['Type'] . '","' . $_GET['URL'] . '","' . $_GET['Titre'] . '")') or die(mysql_error());

$LDJs=mysql_fetch_assoc(mysql_query('SELECT COUNT(*) AS Somme FROM MISC_LDJ
WHERE Date>=DATE_SUB(NOW(),INTERVAL 7 DAY)'));

echo '<h1>' . stripslashes($_GET['Titre']) . '</h1>
<small>En mémoire : ' . $LDJs['Somme'] . '</small><br />
<img src="http://s.wordpress.com/mshots/v1/' . urlencode($_GET['URL']) . '/?w=202" />';
?>