<?php

defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');

/**
 * Get an article by searching for a matching 'title_alias' or 'title'
 */
function plugin_contentTitle($phrase, $partial_match = true)
{
  global $database, $mosConfig_live_site, $mainframe;

  $base_link = "index.php?option=com_content&task=view&id=";

  $result = null;
  $where_clause = ($partial_match) ? "LIKE '%$phrase%'" : "= '$phrase'";

  $my = null;
  $database->setQuery("SELECT * FROM #__content WHERE state=1 AND title_alias ". $where_clause);
  if ($database->loadObject( $my ))  // found something?
  {
    $result[] = $base_link.$my->id."&Itemid=".$mainframe->getItemid( $my->id );
    $result[] = $my->title_alias;
  }
  else
  {
    $my = null;
    $database->setQuery("SELECT * FROM #__content WHERE state=1 AND title ". $where_clause);
    if ($database->loadObject( $my ))
    {
      $result[] = $base_link.$my->id."&Itemid=".$mainframe->getItemid( $my->id );
      $result[] = $my->title;
    }
  }

  return $result;
}

?>