<?php
//Cl� : o35EJP1e44Kp
//Cl� : 9lK08t80qLYh
//Cl� : ow8ewZ512oiq
//Cl� : nK7omYoeF987
define("SNAPR_KEY","nK7omYoeF987");


function getFavicon($URL)
{
	$URL_parts=parse_url($URL);
	return 'http://www.google.com/s2/favicons?domain=' . $URL_parts['host'];
}
?>