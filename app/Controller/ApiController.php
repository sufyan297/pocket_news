<?php
App::uses('HttpSocket','Network/Http');

class ApiController extends AppController
{

    public $uses = array('Admin','Category','News');
    public function beforeFilter() {
        AppController::beforeFilter();
        $this->Auth->allow('getCategories','getNewsByCategory');
        date_default_timezone_set("Asia/Kolkata");
    }


    /**
    * Get News Categories
    * @method GET
    * @author Siraj Bhana
    * @return Json data
    *
    */
    function getCategories()
    {
        $tmp = $this->Category->find('all');

        $i = 0;
        foreach ($tmp as $val) {
            $tmp[$i]['Category']['original_image_url'] = $this->_getImageUrl('Category',$val['Category']['image_dir'],$val['Category']['image_file']);
            $tmp[$i]['Category']['small_image_url'] = $this->_getImageUrl('Category',$val['Category']['image_dir'],$val['Category']['image_file'],$this->SMALL_IMG);
            $tmp[$i]['Category']['thumbnail_image_url'] = $this->_getImageUrl('Category',$val['Category']['image_dir'],$val['Category']['image_file'],$this->THUMB_IMG);
            $tmp[$i]['Category']['api_image_url'] =  $this->_getImageUrl('Category',$val['Category']['image_dir'],$val['Category']['image_file'],$this->API_IMG);

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
    * Get News By Categories.
    *
    * @method POST
    * @param category_id CATEGORY ID
    * @author Siraj Bhana
    * @return Json Data
    */
    function getNewsByCategory()
    {
        if ($this->request->is('post')) {
            $data = $this->request->input('json_decode',true);

            $tmp = $this->News->find('all',array('News.category_id'=>$data['category_id']));

            if (sizeof($tmp) > 0) {

                //Let's Get TimeAgo for All Dates
                $i = 0;
                foreach ($tmp as $val) {
                    $tmp[$i]['News']['createdAgo'] = $this->_timeago($val['News']['created']);
                    $tmp[$i]['News']['modifiedAgo'] = $this->_timeago($val['News']['modified']);

                    $tmp[$i]['News']['original_image_url'] = $this->_getImageUrl('News',$val['News']['image_dir'],$val['News']['image_file']);
                    $tmp[$i]['News']['small_image_url'] = $this->_getImageUrl('News',$val['News']['image_dir'],$val['News']['image_file'],$this->SMALL_IMG);
                    $tmp[$i]['News']['thumbnail_image_url'] = $this->_getImageUrl('News',$val['News']['image_dir'],$val['News']['image_file'],$this->THUMB_IMG);
                    $tmp[$i]['News']['api_image_url'] = $this->_getImageUrl('News',$val['News']['image_dir'],$val['News']['image_file'],$this->API_IMG);


                    $tmp[$i]['Category']['original_image_url'] = $this->_getImageUrl('Category',$val['Category']['image_dir'],$val['Category']['image_file']);
                    $tmp[$i]['Category']['small_image_url'] = $this->_getImageUrl('Category',$val['Category']['image_dir'],$val['Category']['image_file'],$this->SMALL_IMG);
                    $tmp[$i]['Category']['thumbnail_image_url'] = $this->_getImageUrl('Category',$val['Category']['image_dir'],$val['Category']['image_file'],$this->THUMB_IMG);
                    $tmp[$i]['Category']['api_image_url'] =  $this->_getImageUrl('Category',$val['Category']['image_dir'],$val['Category']['image_file'],$this->API_IMG);

                    $i++;
                }


                $res = new ResponseObject();
                $res->status = 'success';
                $res->data = $tmp;
                $res->message = 'News found.';
                $this->response->body(json_encode($res));
                return $this->response;
            } else {
                $res = new ResponseObject();
                $res->status = 'error';
                $res->message = 'News not found.';
                $this->response->body(json_encode($res));
                return $this->response;
            }
        } else {
            $res = new ResponseObject();
            $res->status = 'error';
            $res->message = 'Invalid Request.';
            $this->response->body(json_encode($res));
            return $this->response;
        }
    }

    /**
    *
    *   Get Image URL
    *
    */
    function _getImageUrl($category = null,$image_dir = null ,$image_file = null, $type = '')
    {
        $url = "";

        $category_path = strtolower($category)."/";

        $url = $this->IMAGE_BASE_URL.$category_path."image_file/".$image_dir."/".$type.$image_file;

        return $url;
    }

    /**
    *
    *   Time Ago
    * @author Siraj Bhana
    */
    private static function _timeago($date) {
	   $timestamp = strtotime($date);

	   $strTime = array("second", "minute", "hour", "day", "month", "year");
	   $length = array("60","60","24","30","12","10");

	   $currentTime = time();
	   if ($currentTime >= $timestamp) {
			$diff     = time()- $timestamp;
			for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
			$diff = $diff / $length[$i];
			}

			$diff = round($diff);
			return $diff . " " . $strTime[$i] . "(s) ago ";
	   }
	}
}

?>
