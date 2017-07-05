Hi {{$fname}}

@if ($status == 'approved')
	<p>Your account has been {{$status}} successfully</p>
@endif
@if ($status == 'blocked' || $status == 'rejected')
	<p>Your account has been {{$status}} due to some reason. Contact admin for more details.</p>
@endif

Thanks<br/>
ADMIN

