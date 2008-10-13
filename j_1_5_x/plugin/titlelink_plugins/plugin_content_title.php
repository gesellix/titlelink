<?php

defined( '_JEXEC' ) or die('Direct Access to this location is not allowed.');

/**
 * Get an article by searching for a matching 'title_alias' or 'title'
 */
function plugin_contentTitle($database, $phrase, $partial_match = true)
{
  global $mainframe;

  if(!class_exists('ContentHelperRoute'))
  {
    require_once( JPATH_SITE.DS.'components'.DS.'com_content'.DS.'helpers'.DS.'route.php' );
  }

  //$database = & JFactory::getDBO();

  $base_link = "index.php?option=com_content&view=article&id=";

  $result = null;

  $query  = "SELECT a.id, a.title AS arttitle, a.alias AS artalias, c.id as catid, c.alias AS catalias, a.sectionid";
  $query .= " FROM #__content AS a ";
  $query .= " LEFT JOIN #__categories AS c ON a.catid = c.id ";
  $query .= " LEFT JOIN #__sections AS s ON a.sectionid = s.id ";

  $where_clause = " WHERE a.state=1 ";

  $where_variant = " AND a.alias " . (($partial_match) ? " LIKE '%$phrase%'" : "= '$phrase'");

  $database->setQuery($query.$where_clause.$where_variant);

  $my = null;
  $my = $database->loadObject();
  if ($my)  // found something?
  {
	if (empty($my->catid) || empty($my->catalias) || empty($my->sectionid))
	{
	    $result[] = $base_link.ContentHelperRoute::getArticleRoute($my->id.':'.$my->artalias);
	    $result[] = $my->artalias;
	}
	else
	{
	    $result[] = $base_link.ContentHelperRoute::getArticleRoute($my->id.':'.$my->artalias, $my->catid.':'.$my->catalias, $my->sectionid);
	    $result[] = $my->artalias;
	}

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
	  if (empty($my->catid) || empty($my->catalias) || empty($my->sectionid))
	  {
	      $result[] = $base_link.ContentHelperRoute::getArticleRoute($my->id.':'.$my->artalias);
	      $result[] = $my->arttitle;
	  }
	  else
	  {
	      $result[] = $base_link.ContentHelperRoute::getArticleRoute($my->id.':'.$my->artalias, $my->catid.':'.$my->catalias, $my->sectionid);
	      $result[] = $my->arttitle;
	  }

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