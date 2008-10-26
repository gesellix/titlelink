<?php

defined( '_JEXEC' ) or die('Direct Access to this location is not allowed.');

/**
 * Get an entry from mos_downloads matching 'filename'
 */
function plugin_downloadRemos($database, $phrase, $partial_match = true)
{
  $result = null;

  if (file_exists("components/com_remository/remository.php"))
  {
    $where_clause = ($partial_match) ? "LIKE '%$phrase%'" : "= '$phrase'";
  	
    $database->setQuery("SELECT * FROM #__downloads_files WHERE published=1 AND filetitle ". $where_clause);
    $my = null;
    $my = $database->loadObject();
    if ($my)  // found something?
    {
      $result[] = "index.php?option=com_remository&func=fileinfo&id=".$my->id;
      $result[] = $my->filetitle;

      $database->setQuery("SELECT id FROM #__menu WHERE link = 'index.php?option=com_remository' AND published=1");
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