<?php

/*
 * contributed by Holger Mueller 2018-12-01
 */

defined( '_JEXEC' ) or die('Direct Access to this location is not allowed.');

/**
 * Get an entry from com_weblinks matching 'alias' or 'title'
 */
function plugin_weblinks($database, $phrase, $partial_match = true)
{
  global $mainframe;

  $result = null;

  if (file_exists("components/com_weblinks/weblinks.php"))
  {
    $where_clause = ($partial_match) ? "LIKE '%$phrase%'" : "= '$phrase'";

    $database->setQuery("SELECT * FROM #__weblinks WHERE state = 1 AND (alias ". $where_clause ." OR title ". $where_clause .")");
    $my = null;
    $my = $database->loadObject();
    if ($my)  // found something?
    {
      $result[] = "index.php?option=com_weblinks&task=weblink.go&id=".$my->id;
      $result[] = $my->title;
    }
  }

  return $result;
}

?>
