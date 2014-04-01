<?php
/**
 * @copyright	@copyright	Copyright (c) 2014 Joomla. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

// include the syndicate functions only once
require_once dirname(__FILE__) . '/helper.php';


$class_sfx = htmlspecialchars($params->get('class_sfx'));

require(JModuleHelper::getLayoutPath('mod_zenskills', $params->get('layout', 'default')));

if($params->get('css-load')) {
	JHtml::stylesheet(Juri::base() . 'modules/mod_zenskills/css/zenskills.css');
}

if($params->get('jquery-load')) {
	JLoader::import( 'joomla.version' );
	$version = new JVersion();
	if (version_compare( $version->RELEASE, '2.5', '<=')) {
	    if(JFactory::getApplication()->get('jquery') !== true) {
	        // load jQuery here
	        JFactory::getApplication()->set('jquery', true);
	    }
	} else {
	    JHtml::_('jquery.framework');
	}
}