@include('common/css', ['file' => 'purchase'])


<?php 
	$number[$purchaseData['productData']['id']] = 1;
	//$('#purchase_Button').attr('href', '{{APP_URL}}shop/updateBelongings?purchaseItemId={{$purchaseData['itemData']['id']}}&number='+number+'&totalPrice='+totalPrice);
?>

<script type="text/javascript">
$(function(){
	var number = <?php echo $number[$purchaseData['productData']['id']]; ?>;

	$('img.countUp').click(function(){
		if(number >= 10){
			return false;
		}
		number++;
		document.getElementById("number{{$purchaseData['productData']['id']}}").innerHTML = number;

		var price = <?php echo $purchaseData['productData']['price']; ?>;
		var totalPrice = price * number;
		document.getElementById("totalPrice{{$purchaseData['productData']['id']}}").innerHTML = totalPrice;

		document.getElementById("purchase_Button").href ="{{APP_URL}}shop/updateBelongings?purchaseItemId={{$purchaseData['itemData']['id']}}&number="+number+"&totalPrice="+totalPrice;
	});
	
	$('img.countDown').click(function(){
		if(number <= 1){
			return false;
		}
		number--;
		document.getElementById("number{{$purchaseData['productData']['id']}}").innerHTML = number;

		var price = <?php echo $purchaseData['productData']['price']; ?>;
		var totalPrice = price * number;
		document.getElementById("totalPrice{{$purchaseData['productData']['id']}}").innerHTML = totalPrice;

		document.getElementById("purchase_Button").href ="{{APP_URL}}shop/updateBelongings?purchaseItemId={{$purchaseData['itemData']['id']}}&number=" + number + "&totalPrice=" + totalPrice;	
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
		{{$purchaseData['productData']['name']}}
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
				<img id="minus_Button" src="{{IMG_URL}}popup/minus_Button.png" class="image_change purchase_totalNumber_cntButton_img countDown">
			</td>
			<td width=26%>
				<div id="number{{$purchaseData['productData']['id']}}">
					{{$number[$purchaseData['productData']['id']]}}
				</div>
			</td>
			<td width=15%>
				<img id="plus_Button" src="{{IMG_URL}}popup/plus_Button.png" class="image_change purchase_totalNumber_cntButton_img countUp">
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
		<a id="purchase_Button" href="{{APP_URL}}shop/updateBelongings?purchaseItemId={{$purchaseData['itemData']['id']}}&number={{$number[$purchaseData['productData']['id']]}}&totalPrice={{$purchaseData['productData']['price']}}">
			<img src="{{IMG_URL}}popup/purchase_Button.png" class="image_change purchase_button_purchase_img">
		</a>
	</div>
</div>
