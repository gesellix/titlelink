<?php
// Check to ensure this file is included in Joomla!
defined( '_JEXEC' ) or die('Direct Access to this location is not allowed.');

?>

# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/) and this project adheres to [Semantic Versioning](https://semver.org/).

## [Unreleased]
### Changed
- Fixed various minor issues during Joomla 6 update check

## [v4.0.0] - 2025-12-22
### Changed
- Update JPlugin to new CMSPlugin supported since J4 (https://github.com/gesellix/titlelink/pull/35)
- Drop Joomla 3.x support (https://github.com/gesellix/titlelink/pull/35)

## [v3.9.0] - 2025-12-20
### Changed
- Add com_phocadownload plugin
- Updated target platform to include Joomla 4.x, 5.x

## [v3.8.3] - 2025-11-17
### Fixed
- Fix com_weblinks compatibility (https://github.com/gesellix/titlelink/pull/28)

## [v3.8.2] - 2025-11-14
### Changed
- Update package to use the correct update url (https://github.com/gesellix/titlelink/pull/26)

## [v3.8.1] - 2023-10-29
### Added
- Add Joomla! Update System support (https://github.com/gesellix/titlelink/pull/24)

## [v3.8.0] - 2023-08-01
### Changed
- Improve Joomla 4.x compatibility (https://github.com/gesellix/titlelink/pull/23)


## [] - 2022-10-22
### Changed
- Improve PHP 8.x compatibility (https://github.com/gesellix/titlelink/pull/20)

## [] - 2019-02-10
### Changed
- Improve PHP 7.2 compatibility (https://github.com/gesellix-joomla/titlelink/pull/3)

## [] - 2019-01-20
### Added
- Add com_weblinks plugin (https://github.com/gesellix-joomla/titlelink/pull/2)

## [] - 2013-11-18
### Changed
- TitleLink v3.6.1 released for Joomla! 3.2

## [] - 2012-04-12
### Changed
- transition from http://joomlacode.org/gf/project/titlelink/ (SVN) to https://github.com/gesellix/titlelink (Git)
- documentation cleanup

## [] - 2010-10-05
### Changed
- making TitleLink compatible to Joomla 1.6.0.Beta11

## [] - 2010-08-08
### Fixed
- [#20653] SQL Injection: $phrase is escaped now, yet most of the plugins have to be updated according to plugin_content_title.php

## [] - 2009-06-06
### Changed
- [#16580] Exact Match as default or plugin option

## [] - 2009-05-27
### Added
- added plugin_jmovies (thanks to Onimaro)

## [] - 2008-11-13
### Fixed
- fixed creation of wrong content article links ... though they worked correctly in Joomla *phew*

## [] - 2008-11-10
### Changed
- [#13627] link to the site-internal search
- code cleanup

## [] - 2008-10-28
### Changed
- corrections for new plugins (using new Joomla! 1.5.x API)
- implemented new sorting of plugins
- other plugins are disabled by default (only content and menuitem plugins are enabled)

## [] - 2008-10-26
### Added
- new plugins by external contributions, but there still needs to be a new option to sort plugins.

2008-10-19
### Changed
- updated documentation link http://www.gesellix.de/joomla/36-titlelink/46-titlelink-documentation.html

## [] - 2008-09-17
### Fixed
- fixes [#12606] TL 3.0.5 cannot find uncategorized articles
- fixes missing links when Joomla table prefix isn't 'jos'

## [] - 2008-08-18
### Fixed
- fixed "empty" page issue, when plugin was called from other components
### Changed
- [#10182] SEF don't work correctly
- method="upgrade" to enable users making updates without uninstall

<?php
?>
