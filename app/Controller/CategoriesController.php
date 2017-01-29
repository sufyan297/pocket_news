<?php

App::uses('AppController', 'Controller');

class CategoriesController extends AppController
{
    public $components = array('Paginator');
    public function beforeFilter()
    {
        AppController::beforeFilter();
    }

    public function add()
    {
        $this->layout = 'base_layout';
        $this -> set('page_title', 'Add Category');

          if($this->request->is('post'))
          {
              $temp = $this->request->data;

              $check = $this->Category->find('all',array('conditions'=>array('Category.name'=>$temp['Category']['name'])));

              if(sizeof($check) > 0)
              {
                # code...
                  $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <b>Oops! Category Name already exists.</b>
                                          </div>');
                  return $this -> redirect(array('controller' => 'categories', 'action' => 'add'));
              }
              else {
                # code...
                  if($this->Category->save($temp))
                  {
                      $tempMsg = "<div class=\"alert alert-success alert-dismissable\">
                                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                                    Category <b>`".$temp['Category']['name']."`</b> has been added.</div>";

                        $this->Session->setFlash($tempMsg);
                        $this -> redirect(array('controller' => 'categories', 'action' => 'view'));
                      }
                      else {
                      # code...
                      $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                  <b>Oops! Something went wrong. Please try again later.</b>
                                                </div>');
                      $this -> redirect(array('controller' => 'categories', 'action' => 'view'));
                  }
              }
          }
    }

    public function view()
    {
        $this->layout = 'base_layout';
        $this -> set('page_title', 'View Categories');

        $this->Paginator->settings = array(
            'limit' => 10,
            'order' => 'Category.created DESC'
        );
        $data = $this->Paginator->paginate('Category');
        $this->set('categories', $data);
    }

    public function edit($id = null)
    {
        if($id !== null) {
            $this->layout = 'base_layout';
            $this -> set('page_title', 'Edit Category');
            $temp2 = $this->Category->findById($id);

            if($temp2) {
                $this->set('category', $temp2);
            }

            if ($this->request->is('post'))
            {
                $temp = $this->request->data;

                $this->Category->id = $id;
                if ($this->Category->save($temp))
                {
                    $tempMsg = "<div class=\"alert alert-success alert-dismissable\">
                                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                                  Category <b>`".$temp2['Category']['name']."`</b> has been edited.</div>";

                    $this->Session->setFlash($tempMsg);
                    return $this -> redirect(array('controller' => 'categories', 'action' => 'view'));
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
            return $this -> redirect ( array('controller' => 'categories', 'action' => 'view'));
        }
    }

    public function delete($id = null)
    {
        if($id !== null) {
            if ($this->Category->delete($id)) {
                $this->Session->setFlash('<div class="alert alert-success alert-dismissable">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                          The Category has been deleted.
                                        </div>');
                    return $this-> redirect( array('controller' => 'categories', 'action'=>'view'));
            }
            else {
                $this->Session->setFlash('<div class="alert alert-danger alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            Oops! Something went wrong! Please try again later.
                                          </div>');
                    return $this-> redirect( array('controller' => 'categories', 'action'=>'view'));
            }
        }
        else {
            return $this -> redirect ( array('controller' => 'categories', 'action' => 'view'));
        }
    }
}
