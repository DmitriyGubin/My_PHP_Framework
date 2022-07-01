<?php

namespace application\models;
use application\core\Model;

class Admin extends Model
{
	public $error;
	public $error_arr = [];

	public function loginValidate($POST)//+
	{
		$config = require 'application/config/admin.php';
		$POST = $this -> trimm($POST);
		if ($POST['login'] == '' or $POST['password'] == '')
		{
			$this->error = 'Fill in all the fields!';
			return false;
		}
		else if($config['login'] != $POST['login'] or !password_verify($POST['password'], $config['password']))
		{
			$this->error = 'The username or the password entered incorrectly!';
			return false;
		} 
		return true;
	}

	public function trimm($POST)//removes spaces
	{
		foreach ($POST as $key => $value) 
		{
			$POST[$key] = trim($value);
		}
		return $POST;
	}

	public function passwordСheck($password)
	{
		$capital_letters = preg_match('#[A-Z]+#', $password);
		$small_letters = preg_match('#[a-z]+#', $password);
		$numbers = preg_match('#[0-9]+#', $password);
		$symbols = preg_match('#\W+#', $password);
		$spaces = preg_match('#\s+#', $password);
		$passLen = mb_strlen($password,'UTF8');
		$Len = $passLen > 7;
		if($capital_letters && $small_letters && $numbers && $symbols && !$spaces && $Len)
		{
			return true;
		}
		return false;
	}

	public function nameSerСheck($nameORsurname)//to validate the user's first and last name
	{
		$format = preg_match('#^[A-Z][a-z]+$#', $nameORsurname);
		$L = mb_strlen($nameORsurname,'UTF8');
		$Len = ($L >= 2) && ($L <= 50);
		if ($format && $Len)
		{
			return true;
		}
		return false;
	}

	public function postValidate($POST,$type,$id = 0)//+ $id - for editing
	{
		$POST = $this -> trimm($POST);
		$logLen = mb_strlen($POST['login'],'UTF8');
		$check = 0;

		if($type == 'add')
		{
			if ($POST['login'] == '' or $POST['password'] == '' or $POST['name'] == '' or $POST['surname'] == '')
			{
				$this->error_arr['all'] = 'Fill in all the fields!';
				return false;
			}

			if($this->isPostExists($POST['login']))
			{
				$this->error_arr['login'] = 'This login already exists!';
				$check = 1;
			}
		}

		if($type == 'edit')
		{
			if ($POST['login'] == '' or $POST['name'] == '' or $POST['surname'] == '')
			{
				$this->error_arr['all'] = 'All fields must be filled except for the password field!';
				return false;
			}

			if($this->isPostExists($POST['login']) && $id != ($this->isPostExists($POST['login'])))
			{
				$this->error_arr['login'] = 'This login already exists!';
				$check = 1;
			}
		}

		if(!($this -> passwordСheck($POST['password'])) && $POST['password'] != '')
		{
			$this->error_arr['password'] = 'The password must contain at least one english letter (uppercase and lowercase), a number and a symbol. But it must not contain spaces. The password must also contain more than 7 characters.';
			$check = 1;
		}

		if($logLen < 5 or $logLen > 10)
		{
			$this->error_arr['login'] = 'The login must contain from 5 to 10 characters!';
			$check = 1;
		}

		if(!($this -> nameSerСheck($POST['name'])))
		{
			$this->error_arr['name'] = 'The name must consist of english letters and begin with a capital letter. Also, the name must contain from 2 to 50 characters.';
			$check = 1;
		}

		if(!($this -> nameSerСheck($POST['surname'])))
		{
			$this->error_arr['surname'] = 'The surname must consist of english letters and begin with a capital letter. Also, the surname must contain from 2 to 50 characters.';
			$check = 1;
		}

		if ($POST['DOB'] > date("Y-m-d"))
		{
			$this->error_arr['DOB'] = 'We are in the future! :)';
			$check = 1;
		}

		if ($check != 0)
		{
			return false;
		}

		return true;
	}

	public function isPostExists($login)//+
	{
		return $this->db->selectСolumn('users', 'id', ['login' => $login]);
	}

	public function postEdit($post, $id)//+post editing
	{
		$post['password'] = trim($post['password']);
		$pass = password_hash($post['password'],PASSWORD_DEFAULT);//protection
		//$pass = $post['password'];
		
		$params = [
			'login' => $post['login'],
			'name' => $post['name'],
			'surname' => $post['surname'],
			'gender' => $post['gender'],
			'DOB' => $post['DOB']
		];

		$params = $this->injectionProtection($params);
		$params['password'] = $pass;

		if ($post['password'] == '')
		{
			unset($params['password']);
		}

		//debug($params);

		$this->db->update('users', $id, $params);
	}

	public function postAdd($post)//+insert into db
	{
		$pass = password_hash(trim($post['password']),PASSWORD_DEFAULT);//protection
		//$pass = trim($post['password']);
		$params = [
			'login' => $post['login'],
			'name' => $post['name'],
			'surname' => $post['surname'],
			'gender' => $post['gender'],
			'DOB' => $post['DOB']
		];
		$params = $this->injectionProtection($params);
		$params['password'] = $pass;
		return $this -> db -> insert('users',$params);
	}

	public function injectionProtection($post)//sql-injection protection
	{
		foreach ($post as $key => $value) 
		{
			$post[$key] = trim(strip_tags(stripslashes(htmlspecialchars($post[$key]))));
		}
		return $post;
	}

	public function postDelete($id)//+
	{
		$this->db->delete('users', $id);
	}

	public function postDate($id)//+
	{
		return $this->db->selectAll('users', ['id' => $id]);
	}

	public function postsCount()//+
	{
		return $this->db->numPosts('users','id');
	}

	public function postsList($route, $num_posts_per_page, $parameter, $type)//+
	{
		$offset = (($route['page'] ?? 1) - 1)*$num_posts_per_page;
		return $this->db->selectAllonPage('users', $num_posts_per_page, $offset, $parameter, $type);
	}
} 