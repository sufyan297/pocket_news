<?php $this->start("main-content"); ?>

  <!-- Content Header (Page header) -->

    <!-- Main content -->
          <section class="content">
            <div class="row">
              <div class="row" style="padding-left: 10px;">
                <div class="col-md-8">
                  <?php echo $this->Session->flash(); ?>
                </div>
              </div>
              <!-- left column -->
              <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
    	            <h3 class="box-title">View News</h3>

    		            <div class="box-tools pull-right">
    		                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
    		                </button>
    		                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            <a href="<?php echo $this->Html->url(array('controller' => 'news', 'action' => 'add')); ?>" class="btn btn-primary pull-left">
                                <i class="fa fa-plus"></i>&nbsp;&nbsp;Add News
                            </a>
    		            </div>
    	            </div>
                  <!-- form start -->

                  <div class="box-body">
                    <div class="dataTables_wrapper form-inline dt-bootstrap">
                      <table class="table table-striped table-bordered table-hover" id="dataTables">
      	            		<thead>
      			                <tr>
                                    <th>#</th>
                                    <th>##</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Category</th>
                                    <th>Author</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
      			                </tr>
      			            </thead>
                        <tbody class="tbody">
                          <?php $no = 0; $i = 1;?>
                          <?php foreach ($news as $data): ?>

                            <tr style="cursor: pointer;">

                                <td>
                                    <span>
                                    <?php
                                    echo $i++;
                                        $img_path = $this->webroot."/files/news/image_file/".$data['News']['image_dir']."/tm_".$data['News']['image_file'];

                                        if($data['News']['image_file'] == '')
                                        {
                                            $img_path = $this->webroot."/img/no_img.jpg";
                                        }
                                    ?>
                                    </span>
                                </td>
                                <td>
                                    <img src="<?php echo $img_path; ?>"  style="height: 100px; width: 100px;"/>
                                </td>
                                <td>
                                    <?php echo $data['News']['title']; ?>
                                </td>
                                <td>
                                    <?php echo $data['News']['description']; ?>
                                </td>
                                <td>
                                    <?php echo $data['Category']['name']; ?>
                                </td>
                                <td>
                                    <?php echo $data['Admin']['fname']." ".$data['Admin']['lname']; ?>
                                </td>
                                <td>
                                    <?php
                                        echo $this->Html->link($this->Html->tag('i', '',array('class' => 'fa fa-pencil')),array('controller'=>'news','action'=>'edit/'.$data['News']['id']),array('class'=>'btn btn-warning btn-circle', 'escape' => false));
                                    ?>
                                </td>

                                <td>
                                    <?php
                                        echo $this->Html->link($this->Html->tag('i', '',array('class' => 'fa fa-times')),array('controller'=>'news','action'=>'delete/'.$data['News']['id']),array('class'=>'btn btn-danger btn-circle', 'escape' => false,'onclick'=>'return confirm(\'Are you sure? This action wont be rollback.\')'));
                                    ?>
                                </td>
                            </tr>
                          <?php $no = $no + 1; ?>
                        <?php endforeach; ?>

                      </tbody>
                    </table>
            <ul class="pagination" style="float: right;">
            <?php

                echo $this->Paginator->prev(__('Previous'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
                echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
                echo $this->Paginator->next(__('Next'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));

            ?>
            </ul>
            <?php
                echo $this->Paginator->counter(array('format' => 'range'));
            ?>
                </div><!-- /.box -->
              </div>
            </div>
          </div>

          </section>
<?php $this->end("main-content"); ?>
