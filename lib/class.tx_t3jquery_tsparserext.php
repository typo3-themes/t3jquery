<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2009 Juergen Furrer <juergen.furrer@gmail.com>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *  A copy is found in the textfile GPL.txt and important notices to the license
 *  from the author is found in LICENSE.txt distributed with these scripts.
 *
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Class that renders fields for the extensionmanager configuration
 *
 * @author     Juergen Furrer <juergen.furrer@gmail.com>
 * @package    TYPO3
 * @subpackage tx_t3jquery
 */
class tx_t3jquery_tsparserext
{
	/**
	 * Unsupported jQuery versions
	 * @var array
	 */
	var $supportedUiVersion = array();

	/**
	 * Shows the update Message
	 * @return	string
	 */
	function displayMessage(&$params, &$tsObj)
	{
		$out = '';
		// get all supported varsions from folder
		$this->supportedUiVersion = t3lib_div::get_dirs(t3lib_div::getFileAbsFileName("EXT:t3jquery/res/jquery/ui/"));
		// get the conf array
		$confArr = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['t3jquery']);
		// check the actual version
		if (! in_array($confArr['jQueryUiVersion'], $this->supportedUiVersion)) {
			if (t3lib_div::int_from_ver(TYPO3_version) < 4003000) {
				// 4.3.0 comes with flashmessages styles. For older versions we include the needed styles here
				$cssPath = $GLOBALS['BACK_PATH'] . t3lib_extMgm::extRelPath('t3jquery');
				$out .= '<link rel="stylesheet" type="text/css" href="' . $cssPath . 'compat/flashmessages.css" media="screen" />';
			}
			$out .= '
<div style="position:absolute;top:10px;right:10px; width:300px;">
	<div class="typo3-message message-information">
		<div class="message-header">' . $GLOBALS['LANG']->sL('LLL:EXT:t3jquery/locallang.xml:extmng.updatermsgHeader') . '</div>
		<div class="message-body">
			' . $GLOBALS['LANG']->sL('LLL:EXT:t3jquery/locallang.xml:extmng.updatermsg') . '
		</div>
	</div>
</div>';
		}
		return $out;
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/t3jquery/lib/class.tx_t3jquery_tsparserext.php']) {
	include_once ($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/t3jquery/lib/class.tx_t3jquery_tsparserext.php']);
}
?>