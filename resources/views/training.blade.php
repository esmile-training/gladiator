{{--element/characterListから呼び出し--}}
@include('element/characterList')
@include('common/css', ['file' => 'training'])


    <div id="training-header">
	<p>各訓練所の説明</p>
    </div><?php//header ?>
	
    <div id="trainig_content">
	<div class="trainig_content_wrapp">
	    <div class="training_chara_gage">
		<img src="" width="160px" height="160px" alt="">
		<p class="training_img_text">訓練所+剣闘士の合計増加値</p>
	    </div>
	    <div class="training_chara_list">
		
	    </div>
	</div>
    </div><?php//content ?>
    
    <div id="training_footer">
	
    </div><?php//footer ?>

