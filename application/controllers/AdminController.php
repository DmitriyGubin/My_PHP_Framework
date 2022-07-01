<?php

namespace application\controllers;
use application\core\Controller;
use application\lib\Pagination;

class AdminController extends Controller
{
	public function loginAction()//+
	{
		$err_inp = [
			'error' => null,
			'data' => null
		];
		if (isset($_SESSION['admin']))
		{
			$this->view->redirect('/admin/posts');
		}
		if(!empty($_POST))
		{
			if (!$this->model->loginValidate($_POST))
			{
				$err_inp['data'] = $_POST['login'];
				$err_inp['error'] = $this->model->error;
				$this->view->render('Login',$err_inp);
				exit();
			}
			$_SESSION['admin'] = true;
			$this->view->redirect('/admin/posts');
		}
		$this->view->render('Login',$err_inp);
	}

	public function postsAction($parameter = 'id', $type = 'DESC')//+
	{
		$num_posts_per_page = 3;//number of users per page
		$pagination = new Pagination($this->route, $this->model->postsCount(),$num_posts_per_page);
		
		$vars = [
			'pagination' => $pagination->get(),
			'list' => $this->model->postsList($this->route, $num_posts_per_page, $parameter, $type)
		];

		$this->view->render('Users', $vars);
	}

	public function addAction()//+
	{
		$err_inp = [
			'error' => [],
			'data' => []
		];

		if(!empty($_POST))
		{
			if (!$this->model->postValidate($_POST,'add'))
			{
				foreach ($_POST as $key => $value) 
				{
					$err_inp['data'][$key] = $value;
				}

				foreach ($this->model->error_arr as $key => $value) 
				{
					$err_inp['error'][$key] = $value;
				}
				$this->view->render('Add user',$err_inp);
				exit();
			}
			$id = $this->model->postAdd($_POST);
			if(!$id)
			{
				$err_inp['error']['DB'] = 'Database write error!';
				$this->view->render('Add user',$err_inp);
				exit();
			}
			
			$err_inp['error']['success'] = 'Data written successfully!!!';
		}
		$this->view->render('Add user',$err_inp);
	}

	public function editAction()//+
	{
		$err_inp = [
			'error' => [],
			'data' => $this->model->postDate($this->route['id'])[0]
		];

		if(!empty($_POST))
		{
			if (!($this->model->postValidate($_POST, 'edit', $this->route['id'])))
			{
				foreach ($_POST as $key => $value) 
				{
					if ($key == 'password')
					{
						$err_inp['data']['new_pass'] = $value;
						continue;
					}
					$err_inp['data'][$key] = $value;
				}

				foreach ($this->model->error_arr as $key => $value) 
				{
					$err_inp['error'][$key] = $value;
				}
				$this->view->render('Edit user',$err_inp);
				exit();
			}

			$this->model->postEdit($_POST, $this->route['id']);
			$err_inp = [
				'error' => ['success' => 'Data changed successfully!'],
				'data' => $this->model->postDate($this->route['id'])[0]
			];
		}

		$this->view->render('Edit user',$err_inp);
	}

	public function deleteAction()//+
	{
		$this->model->postDelete($this->route['id']);
		$this->view->redirect('/admin/posts');
	}

	public function logoutAction()//+
	{
		unset($_SESSION['admin']);
		$this->view->redirect('/');
	}

	public function postAction()//+
	{ 
		$vars = [
			'data' => $this->model->postDate($this->route['id'])[0]
		];

		$this->view->render('User', $vars);
	}

	public function sortingAction()//+
	{
		$this -> postsAction($this->route['parameter'], $this->route['type']);
	}
} 