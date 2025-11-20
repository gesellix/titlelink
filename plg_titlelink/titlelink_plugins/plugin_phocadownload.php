<?php

/*
 * contributed by Holger Mueller 2025-11-20
 */

defined( '_JEXEC' ) or die('Direct Access to this location is not allowed.');

/**
 * Get an entry from com_phocadownload matching 'alias' or 'title'
 */
function plugin_phocadownload($database, $phrase, $partial_match = true)
{
  $result = null;

  if (file_exists("components/com_phocadownload/phocadownload.php")) {
    if (! class_exists('PhocaDownloadLoader')) {
      require_once( JPATH_ADMINISTRATOR.'/components/com_phocadownload/libraries/loader.php');
    }
    phocadownloadimport('phocadownload.path.route');

    $where_clause = ($partial_match) ? "LIKE '%$phrase%'" : "= '$phrase'";
    $query = 'SELECT a.id, a.title, a.alias, a.image_filename, a.filename, a.link_external, a.confirm_license, c.id as catid, c.title as cattitle, c.alias as catalias'
    . ' FROM #__phocadownload AS a'
    . ' LEFT JOIN #__phocadownload_categories AS c ON a.catid = c.id'
    . ' WHERE a.alias '. $where_clause ." OR a.title ". $where_clause;

    $database->setQuery($query);
    $item = $database->loadObject();
    if ($item) {  // found something?
      if (isset($item->confirm_license) && $item->confirm_license > 0) {
        $link = PhocaDownloadRoute::getFileRoute($item->id,$item->catid,$item->alias, $item->catalias,0, 'file');
      } else {
        if ($item->link_external != '') {
          $link = $item->link_external;
        } else {
          $link = PhocaDownloadRoute::getFileRoute($item->id,$item->catid,$item->alias,$item->catalias,0, 'download');
        }
      }
      $result[] = $link;
      $result[] = $item->title;
    }
  }

  return $result;
}

?>
