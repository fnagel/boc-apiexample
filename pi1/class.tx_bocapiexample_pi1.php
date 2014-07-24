<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2011 Felix Nagel <info@felixnagel.com>
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
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 * Hint: use extdeveval to insert/update function index above.
 */

require_once(PATH_tslib.'class.tslib_pibase.php');


/**
 * Plugin 'BeautyOfCode API Example' for the 'boc_apiexample' extension.
 *
 * @author	Felix Nagel <info@felixnagel.com>
 * @package	TYPO3
 * @subpackage	tx_bocapiexample
 */
class tx_bocapiexample_pi1 extends tslib_pibase {
	var $prefixId      = 'tx_bocapiexample_pi1';		// Same as class name
	var $scriptRelPath = 'pi1/class.tx_bocapiexample_pi1.php';	// Path to this script relative to the extension dir.
	var $extKey        = 'boc_apiexample';	// The extension key.
	var $pi_checkCHash = true;
	
	/**
	 * The main method of the PlugIn
	 *
	 * @param	string		$content: The PlugIn content
	 * @param	array		$conf: The PlugIn configuration
	 * @return	The content that is displayed on the website
	 */
	function main($content, $conf) {
		$content = "";
		
		// make instance
		t3lib_div::requireOnce(t3lib_extMgm::extPath("beautyofcode", 'pi1/class.tx_beautyofcode_pi1.php'));
		$this->boc = t3lib_div::makeInstance('tx_beautyofcode_pi1');		
		$this->boc->cObj = $this->cObj;
		
		$temp = array();
		// set FE values
		$temp['code'] = 'console.log("Hello World!");';
		$temp['lang'] = 'javascript';
		$temp['label'] = 'Generated via BoC API';
		$this->boc->values = $temp;
		
		// get beautyofcode TS config
		$pluginConf = $GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_beautyofcode_pi1.'];	
		
		$content = $this->boc->main($content, $pluginConf);
		
		return $this->pi_wrapInBaseClass($content);
	}
}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/boc_apiexample/pi1/class.tx_bocapiexample_pi1.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/boc_apiexample/pi1/class.tx_bocapiexample_pi1.php']);
}

?>