<?php

/*
contributed by Jon Schutz
*/

defined( '_JEXEC' ) or die('Direct Access to this location is not allowed.');

/**
 * Get an entry from com_docman matching 'filename'
 */
function plugin_docman($database, $phrase, $partial_match = true)
{
  global $mainframe;

  $result = null;

  if (file_exists("components/com_docman/docman.php"))
  {
    $where_clause = ($partial_match) ? "LIKE '%$phrase%'" : "= '$phrase'";

    $my = null;
    $database->setQuery("SELECT * FROM #__docman WHERE published=1 AND dmname ". $where_clause);
    if ($database->loadObject( $my ))  // found something?
    {

      $result[] = "index.php?option=com_docman&task=doc_download&gid=".$my->id;
      $result[] = $my->dmname;

      $my = null;
      $database->setQuery("SELECT id FROM #__menu WHERE link = 'index.php?option=com_docman' AND published=1");
      if ($database->loadObject( $my ))
      {
        $result[0] .= "&Itemid=".$my->id;
      }
    }
  }

  return $result;
}

?>