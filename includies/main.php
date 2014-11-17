<?php
//Core file

function arti_search()
{	
	require(dirname(__FILE__) . "/../templates/arti_search.tpl.php");
	
	getTemplate();
}

function setRender($content) 
{	

	require(dirname(__FILE__) . "/../templates/render_table.tpl.php");
	
	$content = renderTable().$content;
	
	return $content;
}