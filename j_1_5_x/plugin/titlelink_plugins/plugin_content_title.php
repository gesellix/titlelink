<?php

defined( '_JEXEC' ) or die('Direct Access to this location is not allowed.');

/**
 * Get an article by searching for a matching 'title_alias' or 'title'
 */
function plugin_contentTitle($database, $phrase, $partial_match = true)
{
  global $mainframe;

  //$database = & JFactory::getDBO();

  $base_link = "index.php?option=com_content&view=article&id=";

  $result = null;
  $where_clause = ($partial_match) ? "LIKE '%$phrase%'" : "= '$phrase'";

  $database->setQuery("SELECT * FROM #__content WHERE state=1 AND alias ". $where_clause);
  $my = null;
  $my = $database->loadObject();
  if ($my)  // found something?
  {
    $result[] = $base_link.$my->id;
    $result[] = $my->alias;

    $itemid = $mainframe->getItemid( $my->id );
    if ($itemid)
    {
      $result[0] .= "&Itemid=".$itemid;
    }
  }
  else
  {
    $database->setQuery("SELECT * FROM #__content WHERE state=1 AND title ". $where_clause);
    $my = null;
    $my = $database->loadObject();
    if ($my)
    {
      $result[] = $base_link.$my->id;
      $result[] = $my->title;

      $itemid = $mainframe->getItemid( $my->id );
      if ($itemid)
      {
        $result[0] .= "&Itemid=".$itemid;
      }
    }
  }

  return $result;
}

?>