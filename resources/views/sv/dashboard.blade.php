@extends('layouts.app')
@section('content')

<style type="text/css">
	.ui-datepicker-calendar {
		display: none;
	}
</style>

{{-- <!-- fullCalendar 2.2.5-->
    <link rel="stylesheet" href="assests/plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="assests/plugins/fullcalendar/fullcalendar.print.css" media="print"> --}}


<div class="row">
	
	<div class="col-md-3">
		<div class="panel panel-success">
			<div class="panel-heading">
				<a href="/product" style="text-decoration:none;color:black;">Total Product<span class="badge pull pull-right">{{ $data['countProduct']}}</span></a>
			</div> 
		</div> 
	</div> 

	<div class="col-md-3">
		<div class="panel panel-info">
			<div class="panel-heading">
				<a href="/orders/manage" style="text-decoration:none;color:black;">Total Orders<span class="badge pull pull-right">{{ $data['countOrder']}}</span></a>
			</div> 
		</div> 
	</div> 

	<div class="col-md-3">
		<div class="panel panel-info">
			<div class="panel-heading">
				<a href="/service/manage" style="text-decoration:none;color:black;">Total Services<span class="badge pull pull-right">{{ $data['countService']}}</span></a>
			</div> 
		</div> 
	</div>

	<div class="col-md-3">
		<div class="panel panel-danger">
			<div class="panel-heading">
				<a href="/product" style="text-decoration:none;color:black;">Low Stock<span class="badge pull pull-right">{{ $data['lowStockCount']}}</span></a>
			</div> 
		</div> 
	</div> 
</div> 
@include('partials.error')

<div class="row">
	<div class="col-md-4">
		<div class="card">
		  <div class="cardHeader">
		    <h1><?php echo date('d'); ?></h1>
		  </div>

		  <div class="cardContainer">
		    <p><?php echo date('l') .' '.date('d').', '.date('Y'); ?></p>
		  </div>
		</div> 
		<br/>

		<div class="card">
		  <div class="cardHeader" style="background-color:#245580;">
		    <h1>{{ $data['totalRevenue']}}</h1>
		  </div>

		  <div class="cardContainer">
		    <p> <i class="glyphicon glyphicon-usd"></i> Total Revenue</p>
		  </div>
		</div> 

	</div>

	<div class="col-md-8">
		<div class="panel panel-default">
			<div class="panel-heading"> <i class="glyphicon glyphicon-calendar"></i> Calendar</div>
			<div class="panel-body">
				<div id="calendar"></div>
			</div>	
		</div>
		 
	</div>
</div>

<script src="{{ asset('assests/plugins/fullcalendar/dist/index.global.min.js') }}"></script>

<script>

	document.addEventListener('DOMContentLoaded', function() {
		var calendarEl = document.getElementById('calendar');
		var calendar = new FullCalendar.Calendar(calendarEl, {
			initialView: 'dayGridMonth',
		});
		calendar.render();
	});

  </script>

@endsection