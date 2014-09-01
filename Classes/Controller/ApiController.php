<?php
namespace TYPO3\BocApiexample\Controller;

/***************************************************************
 * Copyright notice
 *
 * (c) 2014 Thomas Juhnke <typo3@van-tomas.de>
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
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Core\Utility\ArrayUtility;

/**
 * Plugin 'BeautyOfCode API Example' for the 'boc_apiexample' extension.
 *
 * @author Felix Nagel <info@felixnagel.com>
 * @package TYPO3\BocApiexample\Controller
 */
class ApiController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 *
	 * @var array
	 */
	protected $beautyofcodeSettings = array();

	/**
	 * initializeObject
	 *
	 * @return void
	 */
	public function initializeObject() {
		$configuration = $this
			->configurationManager
			->getConfiguration(
				ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT
			);

		$this->beautyofcodeSettings = ArrayUtility::getValueByPath(
			$configuration,
			'plugin./tx_beautyofcode./settings.'
		);
	}

	/**
	 * resolveView
	 *
	 * @return \TYPO3\CMS\Extbase\Mvc\View\ViewInterface
	 */
	protected function resolveView() {
		$view = $this->objectManager->get(
			'TYPO3\\CMS\\Fluid\\View\\StandaloneView'
		);

		$view->setLayoutRootPath(
			ExtensionManagementUtility::extPath(
				'beautyofcode',
				'Resources/Private/Layouts/'
			)
		);
		$view->setPartialRootPath(
			ExtensionManagementUtility::extPath(
				'beautyofcode',
				'Resources/Private/Partials/'
			)
		);

		$templatePath = ExtensionManagementUtility::extPath(
			'beautyofcode',
			'Resources/Private/Templates/Content/Render.html'
		);
		$view->setTemplatePathAndFileName($templatePath);

		$view->assign('settings', $this->beautyofcodeSettings);

		return $view;
	}

	/**
	 * renderAction
	 *
	 * @return void
	 */
	public function renderAction() {
		$flexform = $this->objectManager->get(
			'TYPO3\\Beautyofcode\\Domain\\Model\\Flexform'
		);

		$flexform->setCCode('console.log("Hello World!");');
		$flexform->setCLang('javascript');
		$flexform->setCLabel('Generated via BoC API');

		$this->view->assign('flexform', $flexform);
	}
}