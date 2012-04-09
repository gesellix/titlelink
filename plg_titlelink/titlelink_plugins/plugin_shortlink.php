<?php

defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');

function plugin_shortlink($phrase, $partial_match = true)
{
  global $database;

  $result = null;
  $where_clause = ($partial_match) ? "LIKE '%$phrase%'" : "= '$phrase'";

  if (file_exists("components/com_shortlink/shortlink.php"))
  {
    $my = null;
    $database->setQuery("SELECT * FROM #__shortlink WHERE phrase ". $where_clause);
    if ($database->loadObject( $my ))  // found something?
    {
      $result[] = "index.php?option=com_shortlink&phrase=".$my->phrase;
      $result[] = $my->phrase;
    }
  }

  return $result;
}

?>