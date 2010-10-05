<?php

defined( '_JEXEC' ) or die('Direct Access to this location is not allowed.');

/**
 * Get an entry from #__vm_product matching 'product_name'
 */
function plugin_virtuemart($database, $phrase, $partial_match = true)
{
  $result = null;
  $where_clause = ($partial_match) ? "LIKE '%$phrase%'" : "= '$phrase'";

  // virtuemart installed?
  if (file_exists("components/com_virtuemart/virtuemart.php"))
  {
    $database->setQuery("SELECT * FROM #__vm_product WHERE product_publish='Y' AND (product_parent_id='' OR product_parent_id='0') AND product_name ". $where_clause);
    $my = null;
    $my = $database->loadObject();
    if ($my)  // found something?
    {
      $result[] = "index.php?option=com_virtuemart&page=shop.product_details&flypage=shop.flypage&product_id=".$my->product_id;
      $result[] = $my->product_name;

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