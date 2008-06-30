<?php

defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');

/**
 * Get an entry from mos_downloads matching 'filename'
 */
function plugin_downloadRemos($phrase, $partial_match = true)
{
  global $database, $mosConfig_live_site;

  $result = null;
  $where_clause = ($partial_match) ? "LIKE '%$phrase%'" : "= '$phrase'";

  if (file_exists("components/com_remository/remository.php"))
  {
    $my = null;
    $database->setQuery("SELECT * FROM #__downloads_files WHERE published=1 AND filetitle ". $where_clause);
    if ($database->loadObject( $my ))  // found something?
    {
      $result[] = "index.php?option=com_remository&func=fileinfo&id=".$my->id;
      $result[] = $my->filetitle;

      $my = null;
      $database->setQuery("SELECT id FROM #__menu WHERE link = 'index.php?option=com_remository' AND published=1");
      if ($database->loadObject( $my ))
      {
        $result[0] .= "&Itemid=".$my->id;
      }
    }
  }

  return $result;
}

?>