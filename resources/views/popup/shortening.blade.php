@include('common/css', ['file' => 'shortening'])

<?php 
	$number[$shorteningData['charaData']['id']] = 1;
?>


<script type="text/javascript">
$(function(){	
	// 個数を number に格納
	var number	= <?php echo $number[$shorteningData['charaData']['id']]; ?>;
	var ability	= <?php echo $shorteningData['shorterData']['ability'] ?>; 
	

	// countUp ボタンが押された時
	$('img.countUp{{$shorteningData['charaData']['id']}}').click(function(){
		if(number >= 10){
			return false;
		}

		// 個数を1増やす
		number++;

		// 個数表示部分を書き換え
		$("#number{{$shorteningData['charaData']['id']}}").html(number);
	});

	// countDown ボタンが押された時
	$('img.countDown{{$shorteningData['charaData']['id']}}').click(function(){
		// 個数が1より小さい数値で入った時は false を返す
		if(number <= 1){
			return false;
		}

		// 個数を1減らす
		number--;

		// 個数表示部分を書き換え
		$("#number{{$shorteningData['charaData']['id']}}").html(number);
	});
	
	// 購入ボタンが押された時
	$('.shortening_ok_Button{{$shorteningData['charaData']['id']}}').click(function(){
		// URLのGETで渡すデータ部分にデータを挿入
		afterUrl = $(this).attr('href').replace(new RegExp('beforeNumber', 'g'),number).replace(new RegExp('beforeAbility', 'g'),ability);
		$(this).attr('href',afterUrl);
	});
});
</script>

<div class="shortening">
	<img src="{{IMG_URL}}item/popup_Bg.png" class="shortening_bg">

	{{-- アイテムの画像 --}}
	<div class="shortening_item_img">
		<img class="itemlist_flame_item_img" src="{{IMG_URL}}item/item4.png" />
	</div>

	{{-- アイテムの名前 --}}
	<div class="shortening_name">
		{{$shorteningData['shorterData']['name']}}
	</div>

	{{-- アイテムの説明 --}}
	<div class="shortening_itemInfo">
		{{$shorteningData['shorterData']['abilityInfo']}}
	</div>

	{{-- アイテムの個数 --}}
	<table border="0" class="shortening_totalNumber">
		<tr>
			<td width=22%></td>
			<td width=15%>
				<img src="{{IMG_URL}}popup/minus_Button.png" class="image_change shortening_totalNumber_cntButton_img countDown{{$shorteningData['charaData']['id']}}">
			</td>
			<td width=26%>
				<div id="number{{$shorteningData['charaData']['id']}}">
					{{$number[$shorteningData['charaData']['id']]}}
				</div>
			</td>
			<td width=15%>
				<img src="{{IMG_URL}}popup/plus_Button.png" class="image_change shortening_totalNumber_cntButton_img countUp{{$shorteningData['charaData']['id']}}">
			</td>
			<td width=22%></td>
		</tr>
	</table>

	{{-- 購入ボタン --}}
	<div class="shortening_button_ok">
		<a href="{{APP_URL}}item/item4?charaId={{$shorteningData['charaData']['id']}}&number=beforeNumber&ability=beforeAbility" class="shortening_ok_Button{{$shorteningData['charaData']['id']}} clickfalse">
			<img src="{{IMG_URL}}popup/ok_Button.png" class="image_change shortening_button_ok_img">
		</a>
	</div>
</div>