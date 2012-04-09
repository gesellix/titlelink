<?php

/*
contributed by Jorge Amigo Lechuga
*/

defined( '_JEXEC' ) or die('Direct Access to this location is not allowed.');

/**
 * Get an article by searching for a matching 'title_alias' or 'title'
 */
function plugin_peoplebook($database, $phrase, $partial_match = true)
{
  global $mainframe;

  $result = null;

  if (file_exists("components/com_peoplebook/peoplebook.php"))
  {
  	$where_clause = ($partial_match) ? "LIKE '%$phrase%'" : "= '$phrase'";

	$database->setQuery("SELECT * FROM #__peoplebook WHERE published=1 AND name ". $where_clause);
    $my = null;
	$my = $database->loadObject();
    if ($my)  // found something?
	{
      $result[] = "index.php?option=com_peoplebook&func=fullview&staffid=".$my->id;
      $result[] = $my->name;

      $database->setQuery("SELECT id FROM #__menu WHERE published=1 AND link LIKE '%com_peoplebook'");
      $my = null;
      $my = $database->loadObject();
      if ($my)  // found something?
      {
	    $result[0] .= "&Itemid=".$my->id;
	  }
	}
  }

  return $result;
}

?>