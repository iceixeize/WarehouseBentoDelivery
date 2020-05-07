<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<style>
    @page {
	size: @php $pageWidth; @endphp mm @php $pageHeight+ 0.4; @endphp mm; 
	margin:0; margin-header:0; 
	margin-footer:0;
}



@media print {
	.page-break { 
		page-break-after: always; 
		page-break-before: always; 
	}
}



div{
	text-align: center;
}

body {
	margin: 0;
	padding: 0;
}

img {
	max-width: 100%;
	max-height: 80%;
	margin-top: 3 !important;
	width: 100%; 
	image-resolution: 600dpi;
}

.text {
	margin-top: 0 !important;
	margin-bottom: 0 !important;

}


.main-label:not(:nth-last-child(1)) {
	margin: 0;
	padding: 0;

}
</style>
    <body>
        <div id="app">
            @php
                $allamount = array_sum($barcode);
                $pageAmt = ceil($allamount / ($rowDefault * $colDefault));
                
                // dd(['barcode' => $barcode, 'rowDefault' => $rowDefault, 'colDefault' => $colDefault]);
                
                foreach ($jsBarcode as $number => $value) {
                    for ($b = 1; $b <= $barcode[$number]; $b++) {     
                        $src[] = $jsBarcode[$number];
                        $text[] = $textBarcode[$number];
                    }
                }

                $amount = array_sum($barcode); //จำนวนที่ต้อการทั้งหมด
                $width = $widthBox - $barcodePaddingL - $barcodePaddingR;
                $height = $heightBox - $barcodePaddingT - $barcodePaddingB;
                $count = 1;
                $totalPage = 1;


				$totalBox = $rowDefault * $colDefault; //จำนวนช่องทั้งหมด ต่อกระดาษ 1 แผ่น
				
				$start = $rowStart * $colStart; //เลขที่เริ่มสร้างบาร์โค้ด
				$sum = abs($totalBox - $start);//จำนวนที่สามารถพิมพ์ได้
				$page = 1;
				$left = $pageSpaceL;
				$bottom = $pageSpaceT;
				$isStartBarcode = FALSE;
				while(count($src) > 0) { 

            @endphp
            <div 
                class="main-label @php if(count($src) != '2') { echo 'page-break'; } @endphp" 
                style="position: relative; width: {{$pageWidth}}mm; height: {{$pageHeight}}mm;"
            >
                
            @php 
            $top = $pageSpaceT;
					$bottom = $pageSpaceT;
					$totalPage;

					for ($i = 1; $i <= $rowDefault; $i++) {
						for ($j = 1; $j <= $colDefault; $j++) {

							$cAmt = 0;
							$countImg = 0;
							if ($i == 1 && $j == 1) {
								$top = $pageSpaceT;
								$left = $pageSpaceL;
							} else {
								if ($j == 1) {
									$left = $pageSpaceL;
								} else {
									$left = $left + $widthBox + $gapCol;
								}
							}
							if($i == $rowStart and $j == $colStart) {
								$isStartBarcode = TRUE;
							}

							if($isStartBarcode === TRUE) {
								$current_barcode = array_shift($src);
								$current_text = array_shift($text);
								if(!is_null($current_barcode)) {
									$barcode = '<svg class="barcode" jsbarcode-format="CODE128" jsbarcode-value="' . $current_barcode . '" jsbarcode-textmargin="0" jsbarcode-fontoptions="bold" jsbarcode-height="50" jsbarcode-width="3" jsbarcode-margin="0" jsbarcode-fontsize="30"
									id="img' . $page . '-' . $i . '-' . $j . '"></svg>';

									if($isSubshelf == 1) {
										$textName = '<span class="text" style="word-break: break-all; max-height: ' . ($heightBox/2) . 'mm">' . $current_text . '</span>';
									} else {
										$textName = '<span class="text" style="word-break: break-all; max-width:34mm; max-height: ' . ($heightBox/2) . 'mm">' . $current_text . '</span>';
									}
								}
								else {
									$barcode = '';
									$textName = '';
								}
							}
							else {
								$current_barcode = '';
								$barcode = '';
								$textName = '';
								$current_text = '';
							}
							@endphp 

							<div class="main" style="position: absolute; width: {{$widthBox}}mm; height: {{$heightBox}}mm; top: {{$bottom}}mm; left: {{$left}}mm;">
								<div class="divall" id="@php echo $totalPage . '-' . $i . '-' . $j; @endphp" 
									style="
									width: {{$width}}mm; 
									height: {{$height}}mm; 
									padding-top: {{$barcodePaddingT}}mm;
									padding-right: {{$barcodePaddingR}}mm;
									padding-bottom: {{$barcodePaddingB}}mm;
									padding-left: {{$barcodePaddingL}}mm;
									position: absolute;
									max-height: {{$height}}mm; align: center;">
                                    <div class="all" >
                                        @php echo ($showText == 1) ? $textName : ''; @endphp 
										<print-barcode-component 
										barcode="{{$current_barcode}}"
										:textmargin="0" 
										:height="35" 
										:width="1.3" 
										:margin="5" 
										:fontsize="12"></print-barcode-component>

									</div>

								</div>
							</div>
							@php
						}
						$totalPage++;
						$bottom = $bottom + $heightBox + $gapRow;
					}
					@endphp
            
            </div>
            
            
            @php
                }
			@endphp
			{{-- <print-barcode-component 
			barcode="{{$current_barcode}}"
			:textmargin="0" 
			:fontoptions="bold" 
			:height="30" 
			:width="1" 
			:margin="0" 
			:fontsize="10"></print-barcode-component> --}}
            {{-- <print-barcode-component :barcode="54321"></print-barcode-component>
            <print-barcode-component :barcode="12345"></print-barcode-component> --}}

        </div>
		<script src="{{ asset('js/app.js') }}"></script>
		<script>
			var pixelCal = 0.2645833333333;

			// $(function() {
				$(window).on('load', function() {
				// JsBarcode(".barcode").init();
				// $('svg').each(function() {
				// 	$(this).width('35mm');
				// });

				// var maxheight = <?php echo $height; ?>;

				// var max = parseInt(maxheight);

				// $('.all').each(function() {
				// 	var issubshelf = <?php echo $isSubshelf; ?>;
				// 	var fontsize = 24;
				// 	var breakWhile = true;
				// 	var tryWhile = 0;
				// 	if (issubshelf == '1') {
				// 		fontsize = 200;
				// 	}

				// 	var barcodeH = $(this).find('.barcode').height();
				// 	var barcodeW = <?php echo $widthBox - $barcodePaddingL - $barcodePaddingR; ?>;
				// 	console.log('barcodeH : ' + barcodeH + ' barcodeW : ' + barcodeW + ' max height : ' + maxheight);
				// 	if(barcodeH !== null) {
				// 		while((($(this).find('.text').height() * pixelCal) + ($(this).find('.barcode').height() * pixelCal)) > max && breakWhile) {
				// 			if(issubshelf == 1) {
				// 				// fontsize-=1.0; // แก้ bug มันลบเยอะไปจนฟ้อนต์ไม่ขึ้น
				// 				fontsize = Math.round(fontsize * 0.87);
				// 				barcodeH = Math.round(barcodeH * 0.95);
				// 				barcodeH-=1.5;
				// 			} else {
				// 				fontsize = Math.round(fontsize * 0.90);
				// 				barcodeH = Math.round(barcodeH * 0.85);								
				// 			}
				// 			$(this).find('.barcode').data('height', barcodeH + 'mm').height(barcodeH + 'mm');
				// 			$(this).css('font-size', fontsize + 'px');
				// 			$(this).find('.barcode').width(barcodeW + 'mm');

				// 		}

				// 	}
				// });
				window.print();
				setTimeout(function() {
					close();
				}, 800);
			});

			// });

		</script>
    </body>
</html>