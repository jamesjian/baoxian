<?php

namespace App\Module\Admin\Controller;

use \App\Model\Blogcategory as Model_Blogcategory;
use \App\Transaction\Blogcategory as Transaction_Blogcategory;
use \Zx\View\View;
use \Zx\Test\Test;

class Blogcategory extends Admin {

    

    public function init() {
        $this->view_path = APPLICATION_PATH . 'module/admin/view/blogcategory/';
        parent::init();
    }

    public function create() {
        $success = false;
        if (isset($_POST['submit'])) {
            $title = isset($_POST['title']) ? trim($_POST['title']) : '';
            $description = isset($_POST['description']) ? trim($_POST['description']) : '';

            if ($title <> '') {
                $arr = array('title' => $title, 'description' => $description);
                if (Transaction_Blogcategory::create_cat($arr)) {
                    $success = true;
                }
            }
        }
        if ($success) {
            header('Location: ' . ADMIN_HTML_ROOT . 'blogcategory/retrieve/1/title/ASC');
        } else {
            $cats = Model_Blogcategory::get_all_cats();
            View::set_view_file($this->view_path . 'create.php');
            View::set_action_var('cats', $cats);
        }
    }

    public function delete() {
        $id = $this->params[0];
        Transaction_Blogcategory::delete_cat($id);
        header('Location: ' . ADMIN_HTML_ROOT . 'blogcategory/retrieve/1/title/ASC');
    }

    public function update() {
        $success = false;
        if (isset($_POST['submit']) && isset($_POST['id'])) {
            $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
		      \Zx\Test\Test::object_log('id', $id, __FILE__, __LINE__, __CLASS__, __METHOD__);
			$arr = array();
            if ($id <> 0) {
                if (isset($_POST['title']))
                    $arr['title'] = trim($_POST['title']);
                if (isset($_POST['description']))
                    $arr['description'] = trim($_POST['description']);
				
                if (Transaction_Blogcategory::update_cat($id, $arr)) {
                    $success = true;
                }
            }
        }
        if ($success) {
            header('Location: ' . ADMIN_HTML_ROOT . 'blogcategory/retrieve/1/title/ASC');
        } else {
            if (!isset($id)) {
                $id = $this->params[0];
            }
            $cat = Model_Blogcategory::get_one($id);
			
			
            View::set_view_file($this->view_path . 'update.php');
            View::set_action_var('cat', $cat);
        }
    }
	/**
	/page/orderby/direction
	*/
    public function retrieve() {
        $page_num = isset($this->params[0]) ?  intval($this->params[0]) : 1;
        $order_by = isset($this->params[1]) ? $this->params[1]: 'id';
        $direction = isset($this->params[2]) ?  $this->params[2]: 'ASC';
		$cat_list = Model_Blogcategory::get_cats_by_page_num($page_num, $order_by, $direction);
		$num_of_pages = Model_Blogcategory::get_num_of_pages_of_cats();
        View::set_view_file($this->view_path . 'retrieve.php');
        View::set_action_var('cat_list', $cat_list);
        View::set_action_var('order_by', $order_by);
        View::set_action_var('direction', $direction);
        View::set_action_var('page_num', $page_num);
        View::set_action_var('num_of_pages', $num_of_pages);
    }

}
