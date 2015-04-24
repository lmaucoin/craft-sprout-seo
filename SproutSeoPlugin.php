<?php
namespace Craft;

/**
 * Class SproutSeoPlugin
 *
 * @package Craft
 */
class SproutSeoPlugin extends BasePlugin
{
	/**
	 * @return string
	 */
	public function getName()
	{
		$pluginNameOverride = $this->getSettings()->getAttribute('pluginNameOverride');

		return empty($pluginNameOverride) ? Craft::t('Sprout SEO') : $pluginNameOverride;
	}

	/**
	 * @return string
	 */
	public function getVersion()
	{
		return '0.9.2';
	}

	/**
	 * @return string
	 */
	public function getDeveloper()
	{
		return 'Barrel Strength Design';
	}

	/**
	 * @return string
	 */
	public function getDeveloperUrl()
	{
		return 'http://barrelstrengthdesign.com';
	}

	/**
	 * @return bool
	 */
	public function hasCpSection()
	{
		return true;
	}

	/**
	 * @return array
	 */
	protected function defineSettings()
	{
		// We are managing our settings on the CP Tab but storing them
		// in the plugin table so in order to use getSettings() we need
		// these defined here
		return array(
			'pluginNameOverride'  => AttributeType::String,
			'appendSiteName'      => AttributeType::Bool,
			'seoDivider'          => AttributeType::String,
		);
	}

	/**
	 * @return array
	 */
	public function registerCpRoutes()
	{
		return array(
			'sproutseo/defaults/new' => array(
				'action' => 'sproutSeo/defaults/editDefault'
			),
			'sproutseo/defaults/(?P<defaultId>\d+)' => array(
				'action' => 'sproutSeo/defaults/editDefault'
			),
			'sproutseo/sitemap' => array(
				'action' => 'sproutSeo/sitemap/sitemapIndex'
			),
			'sproutseo/sitemap/newPage' => array(
				'action' => 'sproutSeo/sitemap/editSitemap'
			),
			'sproutseo/settings' => array(
				'action' => 'sproutSeo/settings/settingsIndex'
			)
		);
	}
}

/**
 * @return SproutSeoService
 */
function sproutSeo()
{
	return Craft::app()->getComponent('sproutSeo');
}