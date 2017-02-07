<?php
App::uses('HttpSocket','Network/Http');

class ApiController extends AppController
{

    public $uses = array('Admin','Category','News');
    public function beforeFilter() {
        AppController::beforeFilter();
        $this->Auth->allow('getCategories');
        date_default_timezone_set("Asia/Kolkata");
    }


    /**
    * Get News Categories
    *@author Siraj Bhana
    *@return Json data
    *
    */
    function getCategories()
    {
        $tmp = $this->Category->find('all');

        $i = 0;
        foreach ($tmp as $tp) {
            $tmp[$i]['Category']['original_image_url'] = $this->IMAGE_BASE_URL."category/image_file/".$tp['Category']['image_dir']."/".$tp['Category']['image_file'];
            $tmp[$i]['Category']['small_image_url'] = $this->IMAGE_BASE_URL."category/image_file/".$tp['Category']['image_dir']."/sm_".$tp['Category']['image_file'];
            $tmp[$i]['Category']['thumbnail_image_url'] = $this->IMAGE_BASE_URL."category/image_file/".$tp['Category']['image_dir']."/tm_".$tp['Category']['image_file'];
            $tmp[$i]['Category']['api_image_url'] = $this->IMAGE_BASE_URL."category/image_file/".$tp['Category']['image_dir']."/api_".$tp['Category']['image_file'];

            $i++;
        }

        if (sizeof($tmp) > 0) {
            $res = new ResponseObject();
            $res->status = 'success';
            $res->data = $tmp;
            $res->message = 'Categories found.';
            $this->response->body(json_encode($res));
            return $this->response;
        } else {
            $res = new ResponseObject();
            $res->status = 'error';
            $res->message = 'Oops! No categories found.';
            $this->response->body(json_encode($res));
            return $this->response;
        }
    }


    /**
    *Get News By Categories
    *
    *
    *
    */
    function getNewsByCategory()
    {

    }
}

?>
