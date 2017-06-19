{{-- 背景 --}}
<div><img class="gacha_selectback" src="{{IMG_URL}}gacha/selectbackground.jpg" /></div>
{{-- 全体 --}}
<div class = "gacha_all">
	{{-- 看板 --}}
	<div>
		<img class="gacha_signboard" 
			 src="{{IMG_URL}}gacha/kanban.png">
	</div>
	{{-- 枠 --}}
	<div class = "junban0">
		<img class="gacha_frame" 
			 src="{{IMG_URL}}gacha/wakuevent.png">
		{{-- イベントガチャ遷移ボタン --}}
		<a href="{{APP_URL}}gacha/select">
			<input type="submit" class = "normalbutton">
		</a>
	</div>
	{{-- popoupボタン --}}
	<div class = "junban1">
		<div class="modal_container">
			{{-- 時間の計算 --}}
			<?php $w = date("w",strtotime($viewData['nowTime'])); (int)$w +=4; ?>
			@if(date('Y-m-d',strtotime($viewData['createTime'])) < date('Y-m-d',strtotime($viewData['nowTime'])))
			{{-- 一日一回無料ガチャ --}}
			<div class = "gacha_button1">
				<input type="image" 
						class="modal_btn gacha11" 
						src="{{IMG_URL}}gacha/banner11.png" 
						name = 'gachavalue' 
						value = "11" 
						width= 100% 
						height= 100%>
			</div>
			<?php 
				$data['gachaId'] = 11;
				$data['money'] = $viewData['user']['money'];
			?>
			{{-- popupウインドウ --}}
			@include('popup/wrap', [
				'class'		=> 'gacha11', 
				'template'	=> 'gacha',
				'data'		=> ['data' => $data]
			])
			@else
			{{-- 一日一回無料ガチャ非遷移 --}}
			<input type="image" 
					class = "gacha_button1" 
					src="{{IMG_URL}}gacha/banner12.png" 
					width= 100% 
					height= 100%>
			@endif
			{{-- popupウインドウ --}}
			{{-- 曜日ガチャ --}}
			<div class = "gacha_button2">
				<input type="image" 
						class="modal_btn gacha{{$w}}" 
						accept=""src="{{IMG_URL}}gacha/banner{{$w}}.png" 
						name = 'gachavalue' value = "{{$w}}"
						width= 100% 
						height= 100%>
			</div>
			<?php 
				$data['gachaId'] = $w;
				$data['money'] = $viewData['user']['money'];
			?>
			@include('popup/wrap', [
				'class'		=> "gacha{$w}",
				'template'	=> 'gacha',
				'data'		=> ['data' => $data]
			])
			<?php
				$gachaCost = \Config::get('gacha.eRate');
			?>
			@if($gachaCost[14]['deck'][0] - (int)$viewData['deck']['count'] > 0)
			{{-- BOXガチャ --}}
			<div class = "gacha_button3">
				<input type="image"
					    class="modal_btn gacha14"
						src="{{IMG_URL}}gacha/banner14.png" 
						name = 'gachavalue' 
						value = "14" 
						width= 100% 
						height= 100%>
			</div>
			<?php 
				$data['gachaId'] = 14;
				$data['money'] = $viewData['user']['money'];
			?>
			{{-- popupウインドウ --}}
			@include('popup/wrap', [
				'class'		=> 'gacha14', 
				'template'	=> 'boxGacha',
				'data'		=> ['data' => $data]
			])
			@else
			{{-- ガチャ不活性 --}}
			<image
					class = "gacha_button3" 
					src="{{IMG_URL}}gacha/banner15.png" 
					width= 100% 
					height= 100%>
			@endif
		</div>
	</div>
</div>
{{-- CSS読み込み --}}
@include('common/css', ['file' => 'gachaselect'])