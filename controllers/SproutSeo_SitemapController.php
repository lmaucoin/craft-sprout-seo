<?php
namespace Craft;

class SproutSeo_SitemapController extends BaseController
{
	/**
	 * Save Sitemap Info to the Database
	 *
	 * @return mixed Return to Page
	 */
	public function actionSaveSitemap()
	{
		$this->requireAjaxRequest();

		$sitemapSettings['id'] = craft()->request->getPost('id');
		$sitemapSettings['sectionId'] = craft()->request->getPost('sectionId');
		$sitemapSettings['url'] = craft()->request->getPost('url');
		$sitemapSettings['priority'] = craft()->request->getRequiredPost('priority');
		$sitemapSettings['changeFrequency'] = craft()->request->getRequiredPost('changeFrequency');
		$sitemapSettings['enabled'] = craft()->request->getRequiredPost('enabled');
		$sitemapSettings['ping'] = craft()->request->getPost('ping');

		$model = SproutSeo_SitemapModel::populateModel($sitemapSettings);

		$lastInsertId = craft()->sproutSeo_sitemap->saveSitemap($model);
		$this->returnJson(array(
			'lastInsertId' => $lastInsertId)
		);

	}

	public function actionSaveCustomPage()
	{
		// REQUIRE POST REQUEST
		$this->requirePostRequest();

		// HAND OFF TO MODEL
		$customPage = new SproutSeo_SitemapModel();

        // ATTRIBUTES
        $customPage->url     			= craft()->request->getPost('url');
        $customPage->priority   	 	= craft()->request->getPost('priority');
        $customPage->changeFrequency 	= craft()->request->getPost('changeFrequency');

		// SAVE CUSTOM PAGE - PASS TO SERVICE
		// @TODO clean up
        if (craft()->sproutSeo_sitemap->saveCustomPage($customPage))
        {
            craft()->userSession->setNotice(Craft::t('Custom page saved.'));
			$this->redirectToPostedUrl();
        }
        else
        {
            craft()->userSession->setError(Craft::t('Couldn’t save custom page.'));
        }

	}

	// @TODO make it delete the custom pages

    // public function actionDeleteCustomPage()
    // {
    //     $this->requirePostRequest();
    //     $this->requireAjaxRequest();
    //     die('hello');
    //     $id = craft()->request->getRequiredPost('id');
    //     craft()->sproutseo_sitemap->deleteCustomPageById($id);
	//
    //     $this->returnJson(array('success' => true));
    // }
}
