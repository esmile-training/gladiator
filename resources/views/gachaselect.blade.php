{{-- 背景 --}}
<div><img class="gacha_selectback" src="{{IMG_URL}}gacha/selectbackground.jpg" /></div>
<div class = "gacha_all">
	<div>
		<img class="gacha_signboard" 
			 src="{{IMG_URL}}gacha/kanban.png">
	</div>
	<div class = "junban0">
		<img class="gacha_frame" 
			 src="{{IMG_URL}}gacha/wakunormal.png">
		<a href="{{APP_URL}}gacha/eventsSelect">
			<input type="submit" 
					class = "eventebutton">
		</a>
	</div>
	{{-- popupボタン --}}
	<div class = "junban1">
			{{-- ノーマルガチャ --}}
			<div class = "gacha_button1">
				<input type="image" 
						class="modal_btn gacha1" 
						src="{{IMG_URL}}gacha/banner1.png" 
						name = 'gachavalue' 
						value = "1" 
						width= 100% 
						height= 100%>
			</div>
			{{-- レアガチャ --}}
			<div class = "gacha_button2">
				<input type="image" 
						class="modal_btn gacha2" 
						src="{{IMG_URL}}gacha/banner2.png" 
						name = 'gachavalue' 
						value = "2"
						width= 100% 
						height= 100%>
			</div>
			{{-- スーパーレアガチャ --}}
			<div class = "gacha_button3">
				<input type="image" 
						class="modal_btn gacha3" 
						src="{{IMG_URL}}gacha/banner3.png" 
						name = 'gachavalue'
						value = "3"
					width= 100% 
						height= 100%>
			</div>
		</div>
	</div>
</div>
{{-- CSS読み込み --}}
@include('common/css', ['file' => 'gachaselect'])

{{-- popupウインドウ --}}
<?php $count = [0=>1,2,3]; ?>
@foreach($count as $val)
<?php 
	$data['gachaId'] = $val;
	$data['money'] = $viewData['user']['money'];
?>
@include('popup/wrap', [
	'class'		=> "gacha{$val}", 
	'template'	=> 'gacha',
	'data'		=> ['data' => $data]
	])
@endforeach