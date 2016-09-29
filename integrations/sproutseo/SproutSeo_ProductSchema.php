<?php
namespace Craft;

class SproutSeo_ProductSchema extends SproutSeo_ThingSchema
{
	/**
	 * @return string
	 */
	public function getName()
	{
		return 'Product';
	}

	/**
	 * @return string
	 */
	public function getType()
	{
		return 'Product';
	}

	/**
	 * @return bool
	 */
	public function isUnlistedSchemaType()
	{
		return false;
	}

	/**
	 * @return array
	 */
	public function addProperties()
	{
		parent::addProperties();
	}

	// <script type="application/ld+json">
	// {
	//   "@context": ,
	//   "@type": "Product",
	//   "name": "Executive Anvil",
	//   "image": "http://www.example.com/anvil_executive.jpg",
	//   "description": "Sleeker than ACME's Classic Anvil, the Executive Anvil is perfect for the business traveler looking for something to drop from a height.",
	//   "mpn": "925872",
	//   "brand": {
	//     "@type": "Thing",
	//     "name": "ACME"
	//   },
	//   "aggregateRating": {
	//     "@type": "AggregateRating",
	//     "ratingValue": "4.4",
	//     "reviewCount": "89"
	//   },
	//   "offers": {
	//     "@type": "Offer",
	//     "priceCurrency": "USD",
	//     "price": "119.99",
	//     "priceValidUntil": "2020-11-05",
	//     "itemCondition": "http://schema.org/UsedCondition",
	//     "availability": "http://schema.org/InStock",
	//     "seller": {
	//       "@type": "Organization",
	//       "name": "Executive Objects"
	//     }
	//   }
	// }
	// </script>
}