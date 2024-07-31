<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>match One Ticket</title>
  <link rel="icon" type="image/x-icon" href="{{ asset("css/3.png") }}">
  <meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel="stylesheet" href="{{ asset('css/ticket.css') }}">


</head>
<body>
<!-- partial:index.partial.html -->
<link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>

<div class="ticket">
	<div class="left">
		<div class="image">
			<p class="admit-one">
				<span>MATCH DAY</span>
				<span>MATCH DAY</span>
				<span>MATCH DAY</span>
			</p>
			<div class="ticket-number">
				<p style="color: rgba(54, 65, 66, 0.822);">
					{{ $ticket->name }}
				</p>
			</div>
		</div>
		<div class="ticket-info">
			<p class="date">
				<span>{{ date('l', strtotime($ticket->match->date)) }}</span>
				<span class="june-29">{{ date('M-d', strtotime($ticket->match->date)) }}TH</span>
				<span>2030</span>
			</p>
			<div class="show-name">
				<h1>{{ $ticket->match->type }}</h1>
				<h2>{{ $ticket->match->name }}</h2>
			</div>
			<div class="time">
				<p> <span>STARTED AT</span> {{ date('g:i a', strtotime($ticket->match->date)) }}</p>
				<p style="color: green"> ZONE {{ $ticket->category }}</p>
			</div>
	<div class="table">
		<table>
			<thead>
				<tr>
					<th> DOOR</th>
					<th>RANK</th>
					<th>SEAT</th>
					<th>price</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>{{ $ticket->door }}</td>
					<td>{{ $ticket->rank }}</td>
					<td>{{ $ticket->seat }}</td>
					<td>{{ $ticket->price }} DH</td>
				</tr>
			</tbody>
		</table>
	
	</div>
			<p class="location"><span>{{ $ticket->match->field->name}}</span>
				<span class="separator"><i class="fas fa-futbol"></i></span><span>{{ $ticket->match->field->location }}</span>
			</p>
		</div>
	</div>
	<div class="right">
		<p class="admit-one">
			<span>MATCH DAY</span>
			<span>MATCH DAY</span>
			<span>MATCH DAY</span>
		</p>
		<div class="right-info-container">
			<div class="show-name">
				<h1>WORLD CUP 2030</h1>
			</div>
			<div class="time">
				<p> <span>STARTED AT</span>{{ date('g:i a', strtotime($ticket->match->date)) }}</p>
								<p>ZONE {{ $ticket->category }}</p>
			</div>
			<div class="barcode">
				<img src="https://external-preview.redd.it/cg8k976AV52mDvDb5jDVJABPrSZ3tpi1aXhPjgcDTbw.png?auto=webp&s=1c205ba303c1fa0370b813ea83b9e1bddb7215eb" alt="QR code">
			</div>
			<p class="ticket-number">
				#{{ $ticket->serial_code }}
			</p>
		</div>
	</div>
</div>
<div class="buttons">
    <a href="{{ route('download', ['id' => $ticket->id]) }}">
        <button class="download"><i class="fas fa-file-pdf"></i>Download <b>PDF</b></button></a>
    <a href="{{ URL::previous() }}"><button class="back"><i class="fas fa-arrow-left"></i>Go Back</button></a>
  </div>
  
<!-- partial -->
  <script  src="./script.js"></script>

</body>
</html>
