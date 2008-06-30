<?php

defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');

/*
 * Get an entry from mos_menu matching 'name' only from menutype 'mainmenu'
 */
function plugin_menuItem($phrase, $partial_match = true)
{
  global $database, $mosConfig_live_site;
  
  $result = null;
  $where_clause = ($partial_match) ? "LIKE '%$phrase%'" : "= '$phrase'";

  $my = null;

  // try mainmenu first
  $database->setQuery("SELECT * FROM #__menu WHERE menutype='mainmenu' AND published=1 AND name ".$where_clause);
  if ($database->loadObject( $my ))  // found something?
  {
    $result[] = $my->link."&Itemid=".$my->id;
    $result[] = $my->name;
  }
  else
  {
    $database->setQuery("SELECT * FROM #__menu WHERE published=1 AND name ".$where_clause);
    if ($database->loadObject( $my ))  // found something?
    {
      $result[] = $my->link."&Itemid=".$my->id;
      $result[] = $my->name;
    }
  }

  return $result;
}

?>