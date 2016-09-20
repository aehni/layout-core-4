<?php //strict
namespace LayoutCore\Controllers;

use Plenty\Modules\Category\Contracts\CategoryRepository;
use Plenty\Modules\Item\DataLayer\Contracts\ItemDataLayerRepositoryContract;
use Plenty\Modules\Category\Models\Category;

use LayoutCore\Helper\CategoryKey;

class CategoryController extends LayoutController
{
	
	/**
	 * Prepare and render data for categories
	 * @param CategoryRepository $category Repository to receive category data from
	 * @param string $lvl1 Level 1 of category url. Will be null at root page
	 * @param string $lvl2 Level 2 of category url.
	 * @param string $lvl3 Level 3 of category url.
	 * @param string $lvl4 Level 4 of category url.
	 * @param string $lvl5 Level 5 of category url.
	 * @param string $lvl6 Level 6 of category url.
	 * @return string
	 */
	public function showCategory(
		$lvl1 = null,
		$lvl2 = null,
		$lvl3 = null,
		$lvl4 = null,
		$lvl5 = null,
		$lvl6 = null):string
	{
		// get current category
		if($lvl1 === null)
		{
			// get start page id from layout plugin config
			$currentCategory = $this->categoryRepo->get(
				$this->categoryMap->getID(CategoryKey::HOME)
			);
		}
		else
		{
			$currentCategory = $this->categoryRepo->findCategoryByUrl($lvl1, $lvl2, $lvl3, $lvl4, $lvl5, $lvl6);
		}

		if($currentCategory instanceof Category)
		{
			return $this->renderCategory($currentCategory);
		}
		return '';
	}
	
}