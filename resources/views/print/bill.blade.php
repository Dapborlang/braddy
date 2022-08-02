<!DOCTYPE html>
<html>
<head>
	<title>Braddy</title>
	<style>
	td
	{
		font-size: 12px;
	}
	#table2 {
	    border-collapse: collapse;
	}
	</style>
</head>
<body>
        @php 
            $words=new NumberFormatter("en_IN", NumberFormatter::SPELLOUT);
            $figure=new NumberFormatter("en_IN",NumberFormatter::CURRENCY);
			$figure->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');
            $figure->setAttribute(\NumberFormatter::MAX_FRACTION_DIGITS, 2);
        @endphp
   	<table border="1" width="100%" id="table2">
	   	<thead>
	   		<tr>
	   			<th colspan="7">
	   				<span style="font-size: 18px;">M/S B.R MYLLIEMNGAP<br>
	   					SHILLONG<br>
	   					GSTIN NO: 17AIRPM3840R1ZD</span>
	   			</th>
	   		<tr>
	   		<tr>
	   			<th colspan="7">
	   				<table border="0" width="60%">
	   					<tr>
	   						<td style="text-align: left;" colspan="2">Subject: {{$bill->subject}} </td>
	   					</tr>
	   					<tr>
	   						<td style="text-align: left;"><span style="font-size: 12px;">Bill No: {{$bill->bill_no}}</span></td>
	   						<td style="text-align: right;><span style="font-size: 12px;">Bill Date: {{date("d/m/Y", strtotime($bill->bill_date))}}</span></td>
	   					</tr>
	   					<tr>
	   						<td style="text-align: left;"><span style="font-size: 12px;">Order No: {{$bill->order_no}}</span></td>
	   						<td style="text-align: right;><span style="font-size: 12px;">Order Date: {{date("d/m/Y", strtotime($bill->order_date))}}</span></td>
	   					</tr>
	   				</table>
	   			</th>
	   		</tr>
	   		<tr>
	   			<th>Sl. No</th>
	   			<th>Particular</th>
	   			<th>Rate</th>
	   			<th>Quantity</th>
	   			<th>GST Rate</th>
	   			<th>GST Amount</th>
	   			<th>Amount</th>
	   		</tr>
	   	</thead>
   		<tbody>
        @if($bill->tax_type=="I")
            @foreach($bill->BillDetail as $item)
                <tr>
                    <td style="text-align: center;">{{ $loop->iteration }}</td>
                    <td>{{$item->particular}}</td>
                    <td style="text-align: right;">{{round($item->rate - ($item->rate*$item->gst)/(100+$item->gst), 2)}}</td>
                    <td style="text-align: center;">{{$item->quantity}}</td>
                    <td style="text-align: center;">{{$item->gst}}</td>
                    <td style="text-align: right;">
						{{$figure->format(($item->rate * $item->quantity)-(round($item->rate - ($item->rate*$item->gst)/(100+$item->gst), 2)*$item->quantity))}}
						@php $gst[]=($item->rate * $item->quantity)-(round($item->rate - ($item->rate*$item->gst)/(100+$item->gst), 2)*$item->quantity) @endphp
					</td>
                    <td style="text-align: right;">{{$figure->format($item->rate * $item->quantity)}} @php $total[]=$item->rate * $item->quantity @endphp</td>
                </tr>
            @endforeach
        @else
			@foreach($bill->BillDetail as $item)
                <tr>
                    <td style="text-align: center;">{{ $loop->iteration }}</td>
                    <td>{{$item->particular}}</td>
                    <td style="text-align: right;">{{round($item->rate, 2)}}</td>
                    <td style="text-align: center;">{{$item->quantity}}</td>
                    <td style="text-align: center;">{{$item->gst}}</td>
                    <td style="text-align: right;">
						{{$figure->format($item->rate * ($item->gst/100))}}
						@php $gst[]=round($item->rate * ($item->gst/100)) @endphp
					</td>
                    <td style="text-align: right;">
					{{$figure->format(($item->rate * $item->quantity)+($item->rate * ($item->gst/100)))}} 
					@php $total[]=($item->rate * $item->quantity)+($item->rate * ($item->gst/100)) @endphp
				</td>
                </tr>
            @endforeach
        @endif
  			<tr>
  				<td></td>
  				<td></td>
  				<td></td>
  				<td></td>
  				<td style="text-align: right; font-size: 15px; font-weight: bold;">Total</td>
  				<td style="text-align: right; font-size: 15px; font-weight: bold;">{{$figure->format(array_sum($gst))}}</td>
  				<td style="text-align: right; font-size: 15px; font-weight: bold;">{{$figure->format(array_sum($total))}}</td>
  			</tr>
		</tbody>
		<tfoot>
		    <tr>
		      <td colspan="4">&nbsp;</td>
		      <td></td>
		      <td valign="bottom" rowspan="6" colspan="3" style="text-align: center; font-size: 15px; font-weight: bold;">M/S B.R. MYLLIEMNGAP<br>&nbsp;</td>
		    </tr>
		    <tr>
		    	<td colspan="4" style="text-align: right; font-size: 15px; font-weight: bold;">Taxable Value</td>
		    	<td style="text-align: right; font-size: 15px; font-weight: bold;">
				{{$figure->format(array_sum($total)-array_sum($gst))}}
				</td>
		    </tr>
		    <tr>
		    	<td colspan="4" style="text-align: right; font-size: 15px; font-weight: bold;">SGST</td>
		    	<td style="text-align: right; font-size: 15px; font-weight: bold;">{{$figure->format(array_sum($gst)/2)}}</td>
		    </tr>
		    <tr>
		    	<td colspan="4" style="text-align: right; font-size: 15px; font-weight: bold;">CGST</td>
		    	<td style="text-align: right; font-size: 15px; font-weight: bold;">{{$figure->format(array_sum($gst)/2)}}</td>
		    </tr>
		    <tr>
		    	<td colspan="4" style="text-align: right; font-size: 15px; font-weight: bold;">Total</td>
		    	<td style="text-align: right; font-size: 15px; font-weight: bold;">{{$figure->format(array_sum($total))}}</td>
		    </tr>
		    <tr>
		    	<td colspan="5" style="text-align: center; font-size: 15px; font-weight: bold;">(Rupees {{ucwords($words->format(array_sum($total)))}}) only.</td>
		    </tr>
		</tfoot>
	</table>
	</div>
</body>
</html>