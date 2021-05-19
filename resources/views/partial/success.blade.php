@if(Session::has('success'))
   <div class="alert alert-dismissable alert-danger">
	<button type="button" class="close" data-dismiss="alert" aria-label="close">
		<span aria-hidden="true">&times;</span>
	</button>
	
	<li style="list-style: none;"><strong>{!! session()->get('success') !!}</strong></li>
	
   </div>
@endif