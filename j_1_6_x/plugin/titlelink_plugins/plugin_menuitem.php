<?php

defined( '_JEXEC' ) or die('Direct Access to this location is not allowed.');

/*
 * Get an entry from mos_menu matching 'name' only from menutype 'mainmenu'
 */
function plugin_menuItem($database, $phrase, $partial_match = true)
{
  $result = null;
  $where_clause = ($partial_match) ? "LIKE '%$phrase%'" : "= '$phrase'";

  // try mainmenu first
  $database->setQuery("SELECT * FROM #__menu WHERE menutype='mainmenu' AND published=1 AND title ".$where_clause);
  $my = null;
  $my = $database->loadObject();
  if ($my)  // found something?
  {
    $result[] = $my->link."&Itemid=".$my->id;
    $result[] = $my->title;
  }
  else
  {
    $database->setQuery("SELECT * FROM #__menu WHERE published=1 AND title ".$where_clause);
    $my = null;
    $my = $database->loadObject();
    if ($my)  // found something?
    {
      $result[] = $my->link."&Itemid=".$my->id;
      $result[] = $my->title;
    }
  }

  return $result;
}

?>