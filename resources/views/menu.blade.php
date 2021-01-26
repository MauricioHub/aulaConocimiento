@extends('layouts.app')

@section('contentheader_title')
	
@endsection


@section('main-content')
	<div class="container spark-screen">
		<div class="row">
			<div class="col-md-1"></div>
  			<div class="col-md-9">
  				@foreach ($menul as $m)
  				@if($m->activo==1)
				<div class="col-md-6">
					<div class="info-box">
			  <!-- Apply any bg-* class to to the icon to color it -->
					@if($m->activo==1)
					  	@if($m->esHoja==0)
					  		<?php $t=ucwords(strtolower($m->titulo)); ?>
						  <span class="info-box-icon bg-yellow"><i class="fa fa-cogs"></i></span>
						  <div class="info-box-content">
						    <?php echo "<span class='info-box-text'><a style='color:black; text-transform: capitalize;'href='".url('menu/'.$m->id)."'>".$t."</a></span>";?>
						  </div><!-- /.info-box-content -->
						@else
							<?php $t=ucwords(strtolower($m->titulo)); ?>
						  <span class="info-box-icon bg-red"><i class="fa fa-files-o"></i></span>
						  <div class="info-box-content">
						    <?php echo "<span class='info-box-text'><a style='color:black; text-transform: capitalize;'href='".url('ev3/'.$m->titulo)."'>".$t."</a></span>";?>
						  </div><!-- /.info-box-content -->

						@endif
					@endif
					</div><!-- /.info-box -->
				</div>
				@endif
				@endforeach
  			</div>
  			<div class="col-md-4"></div>
			
		</div>

		
	</div>
@endsection
