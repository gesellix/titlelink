<?php

defined( '_JEXEC' ) or die('Direct Access to this location is not allowed.');

/**
 * Get an entry from #__vm_product matching 'product_name'
 */
function plugin_virtuemart_category($database, $phrase, $partial_match = true)
{
  $result = null;
  $where_clause = ($partial_match) ? "LIKE '%$phrase%'" : "= '$phrase'";

  // virtuemart installed?
  if (file_exists("components/com_virtuemart/virtuemart.php"))
  {
    $database->setQuery("SELECT * FROM #__vm_category WHERE category_name ". $where_clause);
    $my = null;
    $my = $database->loadObject();
    if ($my)  // found something?
    {
      $result[] = "index.php?option=com_virtuemart&page=shop.browse&category_id=".$my->category_id;
      $result[] = $my->category_name;

      $database->setQuery("SELECT id FROM #__menu WHERE link LIKE '%com_virtuemart%' AND published=1");
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