<?php

namespace App\Controllers;

use App\Database\Query;
use App\Views\RedirectView;
use App\Views\TemplateView;

class FormController
{
	public function index($params = [])
	{
		$query = new Query;
		$forms = $query->getList("SELECT * FROM forms");

		return new TemplateView('form_index', [
			'title' => 'My awesome page',
			'forms' => $forms
		]);
	}

	public function view($params = [])
	{
		$query = new Query();
		$form = $query->getRow(
			"SELECT * FROM forms WHERE id = ?",
			[$params['id']]
		);

		return new TemplateView('form_view', [
			'form' => $form
		]);
	}

	public function create($params, $post)
	{
		$query = new Query();

		$query->execute(
			"INSERT INTO forms (title, content) VALUES (:title, :content)",
			$post['form']
		);

		$id = $query->getLastInsertId();

		return new RedirectView('/forms/view?id=' . $id);
	}

	public function delete($params)
	{
		(new Query)->execute("DELETE FROM forms WHERE id = ?", [$params['id']]);
		return new RedirectView('/forms');
	}

	public function update($params, $post)
	{
		$query = new Query();
		$query->execute(
			"UPDATE forms SET title = ?, content = ? WHERE id = ?",
			[$post['form']['title'], $post['form']['content'], $post['id']]
		);
		return new RedirectView('/forms/view?id=' . $post['id']);
	}

	public function viewUpdate($params = [])
	{
		$query = new Query();
		$form = $query->getRow(
			"SELECT * FROM forms WHERE id = ?",
			[$params['id']]
		);
		return new TemplateView('form_update', [
			'form' => $form
		]);
	}
}
