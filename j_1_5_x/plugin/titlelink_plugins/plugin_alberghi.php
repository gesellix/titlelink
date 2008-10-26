<?php

/*
contributed by Sebastian Famulok and siddan
*/

defined( '_JEXEC' ) or die('Direct Access to this location is not allowed.');

/**
 * Get an entry from jos_alberghi matching 'title'
 */
function plugin_alberghi($database, $phrase, $partial_match = true)
{
  global $mainframe;

  $result = null;

  if (file_exists("components/com_alberghi/alberghi.php"))
  {
    $where_clause = ($partial_match) ? "LIKE '%$phrase%'" : "= '$phrase'";
  	
    $my = null;
    $database->setQuery("SELECT * FROM #__alberghi WHERE published=1 AND title ". $where_clause);
    if ($database->loadObject( $my ))  // found something?
    {
      $result[] = "index.php?option=com_alberghi&task=detail&id=".$my->id;
      $result[] = $my->title;

      $my = null;
      $database->setQuery("SELECT id FROM #__menu WHERE link = 'index.php?option=com_alberghi' AND published=1");
      if ($database->loadObject( $my ))
      {
        $result[0] .= "&Itemid=".$my->id;
      }
    }
  }

  return $result;
}

?>