<div class="col-md-12">
  @if ($errors->any())
  <div class="alert alert-danger alert-dismissible" style="font-size: 16px;/*text-transform: uppercase;*/">
      @foreach ($errors->all() as $error)
           {{ $error }} <br/>
       @endforeach
  </div>
  @endif
  @if(Session::has('error'))
  <div class="alert alert-danger alert-dismissible">
      <h4 style="font-size: 16px;"><i class="icon fa fa-ban"></i> Error! {{ Session::get('error') }}</h4>
  </div>           
  @endif
  @if(Session::has('success'))
  <div class="alert alert-success alert-dismissible">
      <h4 style="font-size: 16px;"><i class="icon fa fa-check"></i> Success! {{ Session::get('success') }}</h4>
  </div>          
  @endif
</div>