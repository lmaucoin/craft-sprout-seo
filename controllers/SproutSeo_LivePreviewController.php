<?php
namespace Craft;

class SproutSeo_LivePreviewController extends BaseController
{
	protected $allowAnonymous = true;

	public function actionGetPrioritizedMetadata()
	{
		$this->requirePostRequest();

    $post     = craft()->request->getPost();
    $data     = $post['metadata'];
    $metadata = array();

    // prepare title value
    if(is_string($data['title']))
    {
      $metadata['optimizedTitle'] = $data['title'];
    }
    if(is_array($data['title']))
    {
      $metadata['title'] = craft()->templates->renderObjectTemplate($data['title']['template'], $data['title']['fields']);
    }

    // prepare description value
    if(is_string($data['description']))
    {
      $metadata['description'] = $data['description'];
    }
    if(is_array($data['description']))
    {
      $metadata['description'] = craft()->templates->renderObjectTemplate($data['description']['template'], $data['description']['fields']);
    }

    // prepare image value 

    sproutSeo()->optimize->updateMeta($metadata);
		sproutSeo()->optimize->rawMetadata = true;

		// default response without element metadata field. (global) level
		$response = array(
			'success'   => true,
			'optimized' => sproutSeo()->optimize->getMetadata($context)
		);

		$registeredUrlEnabledSectionsTypes = craft()->plugins->call('registerSproutSeoUrlEnabledSectionTypes');

		foreach ($registeredUrlEnabledSectionsTypes as $plugin => $urlEnabledSectionTypes)
		{
			foreach ($urlEnabledSectionTypes as $urlEnabledSectionType)
			{
				// Let's get the optimized metadata model
				// $idVariableName = $urlEnabledSectionType->getIdVariableName();

				// $idVariableValue = craft()->request->getPost($idVariableName, null);

				// if ($idVariableValue)
        $idVariableValue = $post['elementId'];
        if($idVariableValue)
				{
					// example: entry, category, etc.
					$elementType = $urlEnabledSectionType->getMatchedElementVariable();
					$locale      = craft()->i18n->getLocaleById(craft()->language);
					$elementById = craft()->elements->getElementById($idVariableValue,$urlEnabledSectionType->getElementType(), $locale->id);

					if ($elementById)
					{
						$context = array(
							$elementType => $elementById
						);

						$response = array(
							'success'   => true,
							'optimized' => sproutSeo()->optimize->getMetadata($context)
						);
					}
					else
					{
						$response = array(
							'success' => false,
							'errors' => 'The '.$idVariableValue.' element id does not exists'
						);
					}
					// we don't need to continue searching the section
					$this->returnJson($response);
				}
				else
				{
					$response = array(
						'success' => false,
						'errors' => 'The '.$idVariableName.' field value is missing in the post request.'
					);
				}

			}
		}

		$this->returnJson($response);
	}
}
