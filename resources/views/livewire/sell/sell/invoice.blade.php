<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>{{ $invoice->bill_no }}</title>

<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: x-small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }
    .gray {
        background-color: lightgray
    }
</style>

</head>
<body>

  <table width="100%">
    <tr>
        <td valign="top"><img src="assets/images/logo-sm.png" alt="" width="150"/></td>
        <td align="right">
            <h3>{{ $info->company_name }}</h3>
            <h3>Invoice No: {{ $invoice->bill_no }}</h3>
            <pre>
                {{ $info->company_name }} {{-- Company representative name --}}
                {{ $info->address_line_1 }} {{-- Company address --}}
                {{ $info->address_line_2 }} {{-- Company address --}}
                {{ $info->phone }} {{-- phone --}}
                {{ Carbon\Carbon::parse($invoice->updated_at)->format('jS, F Y h:i:s A') }}
            </pre>
        </td>
    </tr>

  </table>

  <hr>

  <table width="100%">
    <tr>
        <td>
        	<strong>Seller:</strong> {{ $invoice->user->name }}
        </td>
        <td>
        	<strong>Customer:</strong> {{ $invoice->customer->name }}
        	<br>
        	<strong>code:</strong> {{ $invoice->customer->code }}
        </td>
    </tr>

  </table>

  <hr>

  <table width="100%">
    <thead style="background-color: lightgray;">
      <tr>
        <th>#</th>
        <th>Product</th>
        <th>Quantity</th>
        <th>Unit Price BDT</th>
        <th>Total BDT</th>
      </tr>
    </thead>
    <tbody>

    	@foreach ($products as $key=>$value)

    		<tr>
		        <th scope="row">{{ $key+1 }}</th>
		        <td>{{ $value->name }}</td>
		        <td align="right">{{ $value->quantity }}</td>
		        <td align="right">{{ $value->price }}</td>
		        <td align="right">{{ $value->quantity * $value->price }}</td>
		    </tr>

		@endforeach

    </tbody>

    <tfoot>
        <tr>
            <td colspan="3"></td>
            <td align="right">Subtotal BDT</td>
            <td align="right">{{ $invoice->net_price }}</td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td align="right">Tax BDT</td>
            <td align="right">{{ $invoice->vat_amount }}</td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td align="right">Total BDT({{ $invoice->vat_percent }}%)</td>
            <td align="right" class="gray">{{ $invoice->total_price }}</td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td align="right">Paid BDT</td>
            <td align="right">{{ $invoice->paid }}</td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td align="right">Due BDT</td>
            <td align="right">{{ $invoice->due }}</td>
        </tr>
    </tfoot>
  </table>

</body>
</html>