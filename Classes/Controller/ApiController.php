<?php
namespace TYPO3\BocApiexample\Controller;

/***************************************************************
 * Copyright notice
 *
 * (c) 2011 Felix Nagel <info@felixnagel.com>
 * All rights reserved
 *
 * This script is part of the TYPO3 project. The TYPO3 project is
 * free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * The GNU General Public License can be found at
 * http://www.gnu.org/copyleft/gpl.html.
 *
 * This script is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

/**
 * Plugin 'BeautyOfCode API Example' for the 'boc_apiexample' extension.
 *
 * @author Felix Nagel <info@felixnagel.com>
 * @package TYPO3\BocApiexample\Controller
 */
class ApiController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * renderAction
	 *
	 * @return void
	 */
	function renderAction() {
		$flexform = $this->objectManager->get(
			'TYPO3\\Beautyofcode\\Domain\\Model\\Flexform'
		);

		$flexform->setCCode = 'console.log("Hello World!");';
		$flexform->setCLang = 'javascript';
		$flexform->setCLabel = 'Generated via BoC API';

		$this->view->setLayoutRootPath(
			ExtensionManagementUtility::extPath(
				'beautyofcode',
				'Resources/Private/Layouts/'
			)
		);
		$this->view->setPartialRootPath(
			ExtensionManagementUtility::extPath(
				'beautyofcode',
				'Resoources/Private/Partials/'
			)
		);

		$templatePath = ExtensionManagementUtility::extPath(
			'beautyofcode',
			'Resources/Private/Templates/Content/Render.html'
		);
		$this->view->setTemplatePathAndFileName($templatePath);

		$this->view->assign('flexform', $flexform);
	}
}