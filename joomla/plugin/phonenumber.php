<?php

use Joomla\CMS\Language\Text;
use Joomla\CMS\Plugin\CMSPlugin;

defined('_JEXEC') or die;

class PlgSystemPhonenumber extends CMSPlugin
{
	/**
	 * Load the language file on instantiation.
	 *
	 * @var    boolean
	 * @since  __DEPLOY_VERSION__
	 */
	protected $autoloadLanguage = true;

	public function onAfterInitialise()
	{
		if (!@include_once(JPATH_LIBRARIES . '/libphonenumber/vendor/autoload.php'))
		{
			throw new \RuntimeException(Text::_('PLG_SYSTEM_PHONENUMBER_ERROR_AUTOLOADER_NOT_LOAD'), 1);
		}
	}
}