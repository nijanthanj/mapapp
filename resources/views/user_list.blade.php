@extends('header');            
@extends('sidebar');            
<div class="content-wrapper">
    <div class="panel-body">
        <h2>Manager List</h2>
        <div class="table-responsive">
            <table  class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user_list as $user_list)
                        <tr>                            
                            <td>{{$user_list->user_fname}} {{$user_list->user_lname}}</td>
                            <td>{{$user_list->user_email}}</td>
                            <td>{{$user_list->mobile}}</td>                                                                                               
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
@extends('footer');