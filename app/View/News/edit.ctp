<?php $this->start('main-content'); ?>
<?php echo $this->Html->script('ckeditor/ckeditor', array('inline' => false));?>

<section class="content-header">
      <h1>Edit News<small>News</small></h1>
</section>

<section class="content">
	<?php
		echo $this->Session->flash();
	?>

	<div class="row">
		<div class="col-md-6">
			<div class="box box-primary">
				<div class="box-header with-border">
	            <h3 class="box-title">Edit News</h3>

		            <div class="box-tools pull-right">
		                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
		                </button>
		                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		            </div>
	            </div>
	            <!-- /.box-header -->
	            <!-- form start -->
				<?php echo $this->Form->create('News',array('type'=>'file','role'=>'form', 'multiple')); ?>
	              <div class="box-body">
  					<?php
  						// echo $this->Session->flash('auth');
  						echo $this->Session->flash();
  					?>
                        <?php
                            // $img_path = $this->webroot."/files/category/image_file/".$category['Category']['image_dir']."/sm_".$category['Category']['image_file'];
                            $img_path = $this->webroot.DS.'files'.DS.'news'.DS.'image_file'.DS.$news['News']['image_dir'].DS.'sm_'.$news['News']['image_file'];
                            // if(file_exists($img_path)) {
                            // $img_path = $this->webroot.DS.'img'.DS.'no_img.jpg';
                            // }
                        ?>
                        <div class="form-group">
                            <img src="<?php echo $img_path; ?>" />
                        </div>

                        <div class="form-group">
                            <label>Image</label>
                                <!-- <span class="setrequire">*</span> -->
                            <?php
                                echo $this -> Form -> input('image_file', array('type' => 'file', 'class' => 'form-control limit-size', 'label' => false, 'div' => false , 'title' => 'Image')); //
                             ?>
                        </div>
                        <div class="form-group">
                            <?php
                                echo $this->Form->input('Change Image', array('class' => 'btn btn-primary','type'=>'submit','label'=>false));
                            ?>
                        </div>
                        <div class="form-group">
                          <?php echo $this->Form->input('category_id',array('type'=>'select','options'=>$categories,'class'=>"form-control",'value'=>$news['News']['category_id'])); ?>
                        </div>

                    	<div class="form-group">
						  <label for="inputName">News Title</label>
						  <?php echo $this->Form->input('title',array(
							'class'=>"form-control",
							'placeholder'=>'Category Name',
							'label'=>false,
							'required' => 'required',
							'autofocus' => 'autofocus',
                            'value'=>$news['News']['title']
						  ));
						  ?>
						</div>
                        <div class="form-group">
                            <label for="inputDescription">Description</label>
                            <!-- 'class'=>'ckeditor', -->
                            <?php echo $this->Form->textarea('description', array('class'=>'form-control','rows'=>15,'value'=>$news['News']['description'])); ?>
                        </div>
	            	</div>
	              <!-- /.box-body -->

		            <div class="box-footer">
						<?php
							echo $this->Form->input('Edit News',array('class'=>'btn btn-primary pull-right','type'=>'submit','label'=>false));
						?>
		            </div>
				  	<?php echo $this->Form->end(); ?>
	        </div>
		</div>
	</div>



<?php $this->end('main-content'); ?>
