<?php $this->start('main-content'); ?>

<section class="content-header">
      <h1>Edit Category<small>Categories</small></h1>
</section>

<section class="content">
	<?php
		echo $this->Session->flash();
	?>

	<div class="row">
		<div class="col-md-6">
			<div class="box box-primary">
				<div class="box-header with-border">
	            <h3 class="box-title">Edit Category</h3>

		            <div class="box-tools pull-right">
		                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
		                </button>
		                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		            </div>
	            </div>
	            <!-- /.box-header -->
	            <!-- form start -->
				<?php echo $this->Form->create('Category',array('type'=>'file','role'=>'form', 'multiple')); ?>
	              <div class="box-body">
  					<?php
  						// echo $this->Session->flash('auth');
  						echo $this->Session->flash();
  					?>
                        <?php
                            // $img_path = $this->webroot."/files/category/image_file/".$category['Category']['image_dir']."/sm_".$category['Category']['image_file'];
                            $img_path = $this->webroot.DS.'files'.DS.'category'.DS.'image_file'.DS.$category['Category']['image_dir'].DS.'sm_'.$category['Category']['image_file'];
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
						  <label for="inputName">Category Name</label>
						  <?php echo $this->Form->input('name',array(
							'class'=>"form-control",
							'placeholder'=>'Category Name',
							'label'=>false,
							'required' => 'required',
							'autofocus' => 'autofocus',
                            'value'=>$category['Category']['name']
						  ));
						  ?>
						</div>
						<div class="form-group">
						  <label for="inputDescription">Description</label>
						  <?php echo $this->Form->input('description',array(
							'class'=>"form-control",
							'placeholder'=>'Description',
							'label'=>false,
							'required' => 'required',
							'autofocus' => 'autofocus',
                            'value'=>$category['Category']['description']
						  ));
						  ?>
						</div>
	            	</div>
	              <!-- /.box-body -->

		            <div class="box-footer">
						<?php
							echo $this->Form->input('Edit Category',array('class'=>'btn btn-primary pull-right','type'=>'submit','label'=>false));
						?>
		            </div>
				  	<?php echo $this->Form->end(); ?>
	        </div>
		</div>
	</div>



<?php $this->end('main-content'); ?>
