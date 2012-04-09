<?php

defined( '_JEXEC' ) or die('Direct Access to this location is not allowed.');

function plugin_shortlink($database, $phrase, $partial_match = true)
{
  $result = null;
  $where_clause = ($partial_match) ? "LIKE '%$phrase%'" : "= '$phrase'";

  if (file_exists("components/com_shortlink/shortlink.php"))
  {
    $database->setQuery("SELECT * FROM #__shortlink WHERE phrase ". $where_clause);
    $my = null;
    $my = $database->loadObject();
    if ($my)  // found something?
    {
      $result[] = "index.php?option=com_shortlink&phrase=".$my->phrase;
      $result[] = $my->phrase;
    }
  }

  return $result;
}

?>