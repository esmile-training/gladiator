@include('common/css', ['file' => 'purchase'])

<?php 
	$number[$purchaseData['productData']['id']] = 1;
?>

<script type="text/javascript">
$(function(){
	// アイテムのIDを itemId に格納
	var itemId = <?php echo $purchaseData['productData']['id']; ?>;	
	
	// 現在のチケットの枚数を ticketNumber に格納
	var ticketNumber = <?php echo $purchaseData['ticket']; ?>;
	
	// 個数を number に格納
	var number = <?php echo $number[$purchaseData['productData']['id']]; ?>;
	
	// 単品金額を price に格納
	var price = <?php echo $purchaseData['productData']['price']; ?>;
	
	// 所持金を money に格納
	var money = <?php echo $purchaseData['money']; ?>;
	
	// 合計金額を totalPrice に格納
	var totalPrice = price * number;

	// countUp ボタンが押された時
	$('img.countUp{{$purchaseData['productData']['id']}}').click(function(){
		// itemId が1(チケット)の場合の終了条件
		if(itemId == 1){
			// 枚数が5以上で入った時は false を返す
			if(number >= 5){
				return false;
			}
			// 枚数が所持チケット枚数と足して5以上の数値で入った時は false を返す
			else if(ticketNumber+number >= 5){
				return false;
			}
		}
		// itemId が1以外(アイテム)の場合の終了条件
		else{
			// 個数が10以上で入った時は false を返す
			if(number >= 10){
				return false;
			}
		}
		// 個数を増やした後の合計金額が所持金より大きい場合
		if(price*(number+1) > money){
			return false;
		}

		// 個数を1増やす
		number++;
		
		// 単品金額と個数を掛け合わせた金額を totalPrice に格納
		totalPrice = price * number;

		// 個数表示部分を書き換え
		$("#number{{$purchaseData['productData']['id']}}").html(number);
		// 合計金額表示部分を書き換え
		$("#totalPrice{{$purchaseData['productData']['id']}}").html(totalPrice);

	});

	// countDown ボタンが押された時
	$('img.countDown{{$purchaseData['productData']['id']}}').click(function(){
		// 個数が1より小さい数値で入った時は false を返す
		if(number <= 1){
			return false;
		}
		
		// 個数を1減らす
		number--;
		
		// 単品金額と個数を掛け合わせた金額を totalPrice に格納
		totalPrice = price * number;
		
		// 個数表示部分を書き換え
		$("#number{{$purchaseData['productData']['id']}}").html(number);
		// 合計金額表示部分を書き換え
		$("#totalPrice{{$purchaseData['productData']['id']}}").html(totalPrice);
	});
	
	// 購入ボタンが押された時
	$('.purchase_Button{{$purchaseData['productData']['id']}}').click(function(){
		// URLのGETで渡すデータ部分にデータを挿入
		afterUrl = $(this).attr('href').replace(new RegExp('beforeNumber', 'g'),number).replace(new RegExp('beforeTotalPrice','g'),totalPrice);
		$(this).attr('href',afterUrl);
	});
});
</script>

<div class="purchase">
	{{-- 背景画像 --}}
	<img src="{{IMG_URL}}shop/popup_Bg.png" class="purchase_bg">

	{{-- アイテムの画像 --}}
	@if( $purchaseData['productData']['id'] == 1)
		<div class="purchase_ticket_img">
			<img class="itemlist_flame_item_img" src="{{IMG_URL}}user/battleTicket.png" />
		</div>
	@else
		<div class="purchase_item_img">
			<img class="itemlist_flame_item_img" src="{{IMG_URL}}item/item{{$purchaseData['productData']['id']}}.png" />
		</div>
	@endif

	{{-- アイテムの名前 --}}
	<div class="purchase_name">
		{{$purchaseData['itemData']['name']}}
	</div>

	{{-- アイテムの使う場所 --}}
	<div class="purchase_itemWhere">
		{{$purchaseData['itemData']['where']}}
	</div>
	
	{{-- アイテムの説明 --}}
	<div class="purchase_itemInfo">
		{{$purchaseData['itemData']['abilityInfo']}}
	</div>

	{{-- アイテムの個数 --}}
	<table border="0" class="purchase_totalNumber">
		<tr>
			<td width=22%></td>
			<td width=15%>
				<img src="{{IMG_URL}}popup/minus_Button.png" class="image_change purchase_totalNumber_cntButton_img countDown{{$purchaseData['productData']['id']}}">
			</td>
			<td width=26%>
				<div id="number{{$purchaseData['productData']['id']}}">
					{{$number[$purchaseData['productData']['id']]}}
				</div>
			</td>
			<td width=15%>
				<img src="{{IMG_URL}}popup/plus_Button.png" class="image_change purchase_totalNumber_cntButton_img countUp{{$purchaseData['productData']['id']}}">
			</td>
			<td width=22%></td>
		</tr>
	</table>
	
	{{-- アイテムの合計金額--}}
	<div id="totalPrice{{$purchaseData['productData']['id']}}" class="purchase_totalPrice">
		{{$purchaseData['productData']['price']}}
	</div>
	
	{{-- 購入ボタン --}}
	<div class="purchase_button_purchase">
		<a href="{{APP_URL}}shop/updateBelongings?purchaseItemId={{$purchaseData['itemData']['id']}}&number=beforeNumber&totalPrice=beforeTotalPrice" class="purchase_Button{{$purchaseData['productData']['id']}} clickfalse">
			<img src="{{IMG_URL}}popup/purchase_Button.png" class="image_change purchase_button_purchase_img">
		</a>
	</div>
</div>