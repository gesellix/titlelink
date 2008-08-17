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
  
  $query  = "SELECT a.id, a.alias AS artalias, c.id as catid, c.alias AS catalias, a.sectionid";
  $query .= " FROM jos_content AS a ";
  $query .= " INNER JOIN jos_categories AS c ON a.catid = c.id ";
  $query .= " INNER JOIN jos_sections AS s ON a.sectionid = s.id ";

  $where_clause = " WHERE a.state=1 ";
  
  $where_variant = " AND a.alias " . (($partial_match) ? " LIKE '%$phrase%'" : "= '$phrase'");

  $database->setQuery($query.$where_clause.$where_variant);

  $my = null;
  $my = $database->loadObject();
  if ($my)  // found something?
  {
    $result[] = $base_link.ContentHelperRoute::getArticleRoute($my->id.':'.$my->artalias, $my->catid.':'.$my->catalias, $my->sectionid);
    $result[] = $my->alias;

    $itemid = $mainframe->getItemid( $my->id );
    if ($itemid)
    {
      $result[0] .= "&Itemid=".$itemid;
    }
  }
  else
  {
    $where_variant = " AND a.title " . (($partial_match) ? " LIKE '%$phrase%'" : "= '$phrase'");

    $database->setQuery($query.$where_clause.$where_variant);

    $my = null;
    $my = $database->loadObject();
    if ($my)
    {
      $result[] = $base_link.ContentHelperRoute::getArticleRoute($my->id.':'.$my->artalias, $my->catid.':'.$my->catalias, $my->sectionid);
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