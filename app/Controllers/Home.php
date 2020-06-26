<?php

namespace App\Controllers;

use App\Models\Category;

class Home extends BaseController
{
	protected $helpers = ['url', 'form'];
	public $category;
	public function __construct()
	{

		$this->category = new  Category();
	}

	public function index()
	{
		/** @var Category categories */

		$categories = $this->category->all();
		return view('categories/index', ['categories' => $categories]);
	}

	public function store()
	{

		$errors = $this->validation();

		if (count($errors)) {
			return $this->jsonResponse($errors, 'Invalid Inputrs', 422);
		}
		$data = $this->getRequest();

		//	return var_dump($data);
		$id = $this->category->insert($data);
		$category = $this->category->findOne($id);
		return $this->jsonResponse($category, 'added sucessfully');
	}

	public function edit($id)
	{
		$category = $this->category->find($id);

		$categories = $this->category->all();
		return view(
			'categories/partials/_edit',
			[
				'categories' => $categories,
				'category' => $category,
				'ds' => DIRECTORY_SEPARATOR
			]
		);
	}
	public function show($id)
	{
		$category = $this->category->findOne($id);

		return view(
			'categories/partials/_show',
			[
				'category' => $category,
			]
		);
	}

	public function update($id)
	{
		$errors = $this->validation();

		if (count($errors)) {
			return $this->jsonResponse($errors, 'Invalid Inputrs', 422);
		}

		$data = $this->getRequest();
		$this->category->update($id, $data);

		$category = $this->category->findOne($id);

		return $this->jsonResponse($category, "updated Sucessfully");
	}

	public function destroy($id)
	{

		$this->category->delete($id);
		return $this->jsonResponse([], 'Deleted Successfully');
	}



	public function validation()
	{
		$rules = [
			'title' => "required",
			'category_id'  => 'permit_empty|integer'
		];
		if (!$this->validate($rules)) {
			return $this->validator->getErrors();
		}
		return [];
	}

	public function getRequest()
	{

		return	[
			'title' => $this->request->getPost('title'),
			'category_id' => $this->request->getPost('category_id'),
		];
	}
}
