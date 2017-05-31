{{--CSS--}}
@include('common/css', ['file' => 'training'])
<div>
	<?php var_dump($viewData); ?>
</div>
<script>
	 var popup = <?php var_export($viewData['endTrainingChara']); ?>;
	 $(function (){
		 if(popup !== null)
		 {
			//$('.trainingResult').css('display','block'); 
		 }
		 else
		 {
			 //$('.trainingResult').css('display','none'); 
		 }
	 });
</script>


