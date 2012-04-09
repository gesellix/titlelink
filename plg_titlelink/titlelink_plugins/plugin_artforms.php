<?php

/*
contributed by siddan
*/

defined( '_JEXEC' ) or die('Direct Access to this location is not allowed.');

/**
 * Get an entry from com_artforms matching 'filename'
 */
function plugin_artforms($database, $phrase, $partial_match = true)
{
  global $mainframe;

  $result = null;

  if (file_exists("components/com_artforms/artforms.php"))
  {
    $where_clause = ($partial_match) ? "LIKE '%$phrase%'" : "= '$phrase'";
  	
    $database->setQuery("SELECT * FROM #__artforms WHERE published=1 AND titel ". $where_clause);
    $my = null;
	$my = $database->loadObject();
	if ($my)  // found something?
    {
      $result[] = "index.php?option=com_artforms&formid=".$my->id;
      $result[] = $my->titel;

      $database->setQuery("SELECT id FROM #__menu WHERE link = 'index.php?option=com_artforms' AND published=1");
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