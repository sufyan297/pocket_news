<?php

App::uses('AppController', 'Controller');

class NewsController extends AppController
{
    public $components = array('Paginator');
    public $uses = array('Admin','Category','News');

    public function beforeFilter()
    {
        AppController::beforeFilter();
    }

    public function add()
    {
        $this->layout = 'base_layout';
        $this -> set('page_title', 'Add News');

        $this->set('categories',$this->Category->find('list'));
        if($this->request->is('post'))
        {
            $temp = $this->request->data;
            if($this->News->save($temp))
            {
              $tempMsg = "<div class=\"alert alert-success alert-dismissable\">
                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                            News <b>`".$temp['News']['title']."`</b> has been added.</div>";

                $this->Session->setFlash($tempMsg);
                $this -> redirect(array('controller' => 'news', 'action' => 'view'));
              }
              else {
              # code...
              $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                          <b>Oops! Something went wrong. Please try again later.</b>
                                        </div>');
              $this -> redirect(array('controller' => 'news', 'action' => 'view'));
            }
        }
    }

    public function view()
    {
        $this->layout = 'base_layout';
        $this -> set('page_title', 'View News');

        $this->Paginator->settings = array(
            'limit' => 10,
            'order' => 'News.created DESC'
        );
        $data = $this->Paginator->paginate('News');
        $this->set('news', $data);
    }

    public function edit($id = null)
    {
        if($id !== null) {
            $this->layout = 'base_layout';
            $this -> set('page_title', 'Edit News');
            $temp2 = $this->News->findById($id);
            $this->set('categories',$this->Category->find('list'));

            if($temp2) {
                $this->set('news', $temp2);
            }

            if ($this->request->is('post'))
            {
                $temp = $this->request->data;

                $this->News->id = $id;
                if ($this->News->save($temp))
                {
                    $tempMsg = "<div class=\"alert alert-success alert-dismissable\">
                                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                                  News <b>`".$temp2['News']['title']."`</b> has been edited.</div>";

                    $this->Session->setFlash($tempMsg);
                    return $this -> redirect(array('controller' => 'news', 'action' => 'view'));
                }
                else
                {
                    $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <b>Oops! Something went wrong! Please try again later.</b>
                                              </div>');
                }
            }
        }
        else {
            return $this -> redirect ( array('controller' => 'news', 'action' => 'view'));
        }
    }

    public function delete($id = null)
    {
        if($id !== null) {
            if ($this->News->delete($id)) {
                $this->Session->setFlash('<div class="alert alert-success alert-dismissable">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                          The News has been deleted.
                                        </div>');
                    return $this-> redirect( array('controller' => 'news', 'action'=>'view'));
            }
            else {
                $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            Oops! Something went wrong! Please try again later.
                                          </div>');
                    return $this-> redirect( array('controller' => 'news', 'action'=>'view'));
            }
        }
        else {
            return $this -> redirect ( array('controller' => 'news', 'action' => 'view'));
        }
    }
}
