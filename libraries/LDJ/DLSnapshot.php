<?php
//Clé : o35EJP1e44Kp
//Clé : 9lK08t80qLYh
//Clé : ow8ewZ512oiq
//Clé : nK7omYoeF987
define("SNAPR_KEY","nK7omYoeF987");


function getFavicon($URL)
{
	$URL_parts=parse_url($URL);
	return 'http://www.google.com/s2/favicons?domain=' . $URL_parts['host'];
}
?>