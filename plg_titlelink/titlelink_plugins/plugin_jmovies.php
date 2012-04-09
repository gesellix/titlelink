<?php

defined( '_JEXEC' ) or die('Direct Access to this location is not allowed.');

/**
 * Get an entry from #__jmovies matching 'titolo' or 'titolo2'
 */
function plugin_jmovies($database, $phrase, $partial_match = true)
{
  $result = null;
  $where_clause = ($partial_match) ? "LIKE '%$phrase%'" : "= '$phrase'";

  // jmovies installed?
  if (file_exists("components/com_jmovies/jmovies.php"))
  {
    $database->setQuery("SELECT * FROM #__jmovies WHERE published=1 AND (titolo ". $where_clause . " OR titolo2 ". $where_clause .")");
    $my = null;
    $my = $database->loadObject();
    if ($my)  // found something?
    {
      $result[] = "index.php?option=com_jmovies&task=detail&id=".$my->id;
      $result[] = $my->titolo;

      $database->setQuery("SELECT id FROM #__menu WHERE link LIKE '%com_jmovies%' AND published=1");
      $my = null;
      $my = $database->loadObject();
      if ($my)  // found something?
      {
        $result[0] .= "&Itemid=".(!empty( $my->id ) ? $my->id : "1");
      }
    }
  }

  return $result;
}

?>