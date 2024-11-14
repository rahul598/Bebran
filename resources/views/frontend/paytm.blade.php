@extends('layouts.app') 
@section('content')
<center><h1>{{__("Please do not refresh this page...")}}</h1></center>
<form action="{{ $paytm_txn_url }}" method="post"  >
    @csrf
    <table border="1">
        <tbody>
		<?php
		foreach($paramList as $name => $value) {
			echo '<input type="hidden" name="' . $name .'" value="' . $value . '">';
		}
		?>
        <input type="hidden" name="CHECKSUMHASH" value="<?php echo $checkSum ?>">
        </tbody>
    </table>
    
</form>

@endsection

@section('more-scripts')
<script type="text/javascript">
    document.f1.submit();
</script>
@endsection