@extends('layouts.app')
@section('content')

<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="/">Home</a></li>		  
		  <li class="active">Users</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Users</div>
			</div> 
			<div class="panel-body">

				<div class="remove-messages"></div>
                @include('partials.error')

				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<a href="users/add_users"><button class="btn btn-default button1" data-toggle="modal" id="addUsersModalBtn"> <i class="glyphicon glyphicon-plus-sign"></i> Add Users </button></a>
				</div>	
				
				<table class="table" id="manageUsersTable">
					<thead>
						<tr>
                            <th>Id</th>
							<th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
							<th>Created At</th>							
                            <th style="width:15%;">Options</th>
						</tr>
					</thead>
                    @php
                        $users =  DB::table('users')->join('user_roles','user_roles.id',"=",'users.user_role')->select('user_roles.name as role_name','users.id','users.name','users.created_at','users.email')->get();
                       // dd($users);
                    @endphp
                    <tbody>
                            @foreach ($users as $user)
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role_name }}</td>
                                <td>{{ $user->created_at }}</td>
                                
                            @endforeach
                    </tbody>
				</table>
				

			</div> 
		</div> 
	</div> 
</div> 

@endsection