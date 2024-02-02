<?php

namespace Up\Controllers;

use Exception;
use Up\Services\Repository\ProductService;
use Up\Services\Repository\TagService;

class CatalogController extends BaseController
{
	/**
	 * @throws Exception
	 */
	public function catalogAction(string $tagName,$pageNumber): string
	{
        var_dump($pageNumber);
		$products = ProductService::getProductList($pageNumber);
		$tags = TagService::getTagList();

		return $this->render('layout', [
			'modal' => $this->render('/components/modals', []),
			'page' => $this->render('/pages/catalog', [
				'tag' => $tagName,
                'pageNumber'=>$pageNumber,
				'toolbar' => $this->render('/components/toolbar', ['tags' => $tags]),
				'productList' => $this->render('/components/product-list', ['products' => $products,
                    'pageNumber'=>$pageNumber,'tagName'=>$tagName]),
			]),
		]);
	}
}