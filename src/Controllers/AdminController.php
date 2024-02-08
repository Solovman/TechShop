<?php

declare(strict_types=1);

namespace Up\Controllers;

use Exception;
use Up\Models\Product;
use Up\Services\AuthenticationService;
use Up\Services\Repository\BrandService;
use Up\Services\Repository\OrderService;
use Up\Services\Repository\ProductService;
use Up\Services\Repository\RemoveService;
use Up\Services\Repository\TagService;
use Up\Services\Repository\UserService;
use Core\Web\Json;

class AdminController extends BaseController
{
	/**
	 * @throws Exception
	 */
	public function adminAction(): string
	{
		session_start();
		if (isset($_SESSION['AdminEmail']))
		{
			$user = UserService::getUserByEmail($_SESSION['AdminEmail']);
			$params = [
				'adminFullName' => $user->name . ' ' . $user->surname,
				'adminEmail' => $user->email,
				'tags' => TagService::getTagList(),
				'brands' => BrandService::getBrandList(),
				'orders' => OrderService::getOrderList(),
				'products' => ProductService::getProductListForAdmin(),
				'users' => UserService::getUserList(),
			];
			return $this->render('admin', $params);
		}

		header('Location: /login/');

		return '';
	}

	/**
	 * @throws Exception
	 */

	public function loginAction()
	{
		session_start();
		if (isset($_SESSION['AdminEmail']))
		{
			header("Location: /admin/");
		}
		if (isset($_SESSION['UserEmail']))
		{
			header("Location: /account/");
		}

		return $this->render('login', []);
	}

	public function removeAction(): void
	{
		header('Content-Type: application/json');
		$input = file_get_contents('php://input');
		$data = Json::decode($input);

		if (isset($data['id']))
		{
			$id = $data['id'];
			$result = RemoveService::delete($id);

			echo Json::encode([
				'result' => $result > 0 ? 'Y' : 'N',
			]);
		}
		else
		{
			echo Json::encode([
				'result' => 'N',
				'error' => 'Id not provided',
			]);
		}
	}

	public function dbAction()
	{
		header('Content-Type: application/json');
		$input = file_get_contents('php://input');
		$data = Json::decode($input);

		if (isset($data['title']))
		{
			echo Json::encode([
				'result' => 'Y',
			]);
		}
		else
		{
			echo Json::encode([
				'result' => 'N',
				'error' => 'deleteDb not provided',
			]);
		}
	}

	public function executeAction()
	{
		header('Content-Type: application/json');
		$input = file_get_contents('php://input');
		$data = Json::decode($input);

		if (isset($data['title']))
		{
			echo Json::encode([
				'result' => 'Y',
			]);
		}
		else
		{
			echo Json::encode([
				'result' => 'N',
				'error' => 'executeDb not provided',
			]);
		}
	}

	/**
	 * @throws Exception
	 */
	public function addProductAction(): string
	{
		ProductService::addProduct();
		return $this->render('admin-create-product', []);
	}
}