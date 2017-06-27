Hi {{$fname}}

@if ($status == 'pending')
	<p>Your account {{$status}} successfully</p>
@endif
@if ($status == 'blocked')
	<p>Your account has been {{$status}} due to some reason. Contact admin for more details.</p>
@endif
@if ($status == 'rejected')
	<p>Your account has been {{$status}} due to some reason. Contact admin for more details.</p>
@endif

Thanks<br/>
ADMIN

