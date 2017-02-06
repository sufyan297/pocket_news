<?php $this->start('main-content'); ?>
<?php echo $this->Html->script('ckeditor/ckeditor', array('inline' => false));?>

<section class="content-header">
      <h1>Add News<small>News</small></h1>
</section>

<section class="content">
	<?php
		echo $this->Session->flash();
	?>

	<div class="row">
		<div class="col-md-6">
			<div class="box box-primary">
				<div class="box-header with-border">
	            <h3 class="box-title">Add News</h3>

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
                        <div class="form-group">
                            <label>Image</label>
                                <!-- <span class="setrequire">*</span> -->
                            <?php
                                echo $this -> Form -> input('image_file', array('type' => 'file', 'class' => 'form-control limit-size', 'label' => false, 'div' => false , 'title' => 'Image','required' => 'required')); //
                             ?>
                        </div>
                        <div class="form-group">
                          <?php echo $this->Form->input('category_id',array('type'=>'select','options'=>$categories,'class'=>"form-control")); ?>
						</div>
                        <div class="form-group">
                          <?php echo $this->Form->input('admin_id',array('type'=>'hidden','value'=>$this->Session->read('Auth.User.id'),'class'=>"form-control")); ?>
                        </div>
                    	<div class="form-group">
						  <label for="inputName">News Title</label>
						  <?php echo $this->Form->input('title',array(
							'class'=>"form-control",
							'placeholder'=>'News Title',
							'label'=>false,
							'required' => 'required',
							'autofocus' => 'autofocus'
						  ));
						  ?>
						</div>
                        <div class="form-group">
                            <label for="inputDescription">Description</label>
                            <?php echo $this->Form->textarea('description', array('class'=>'ckeditor')); ?>
                        </div>
	            	</div>
	              <!-- /.box-body -->

		            <div class="box-footer">
						<?php
							echo $this->Form->input('Add News',array('class'=>'btn btn-primary pull-right','type'=>'submit','label'=>false));
						?>
		            </div>
				  	<?php echo $this->Form->end(); ?>
	        </div>
		</div>
	</div>



<?php $this->end('main-content'); ?>
