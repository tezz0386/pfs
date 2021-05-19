@if(Session::has('error'))
   <div class="alert alert-dismissable alert-danger">
	<button type="button" class="close" data-dismiss="alert" aria-label="close">
		<span aria-hidden="true">&times;</span>
	</button>
	
	<li><strong>{!! session()->get('error') !!}</strong></li>
	
   </div>
@endif