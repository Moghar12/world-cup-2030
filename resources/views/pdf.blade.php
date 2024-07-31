
<!DOCTYPE html>
<html>
<head>
	<title>Football Match Ticket</title>
	<style>
		/* CSS Reset */
		@page {
  size: A4;
  margin: 0;
}

html, body {
  height: 100%;
  margin: 0;
  padding: 0;
}

.ticket {
  width: 800px;
  height: 1131px;
  margin: 50px auto;
  background-color: white;
  border: 1px solid #ccc;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  position: relative;
  overflow: hidden;
}


.left {
  display: flex;
  align-items: center;
}

.image {
  position: relative;
}

.admit-one {
  font-size: 22px;
  font-weight: bold;
  color: #fff;
  text-align: center;
  margin-top: 50px;
  letter-spacing: 2px;
  text-transform: uppercase;
}

.admit-one span {
  display: block;
}

.ticket-number {
  position: absolute;
  top: 76%;
  left: 410px;
  transform: translate(-50%, -50%);
  width: 100%;
  text-align: center;
}

.ticket-number p {
  background-color: rgba(54, 65, 66, 0.822);
  color: #fff;
  font-size: 20px;
  padding: 5px;
  letter-spacing: 1px;
  border-radius: 5px;
}

.ticket-info {
  margin-left: 41px;
}

.date {
  font-size: 18px;
  color: #e81c1c;
  text-transform: uppercase;
  margin-bottom: 10px;
}

.date span {
  display: block;
}

.june-29 {
  font-size: 28px;
  font-weight: bold;
  margin-top: 5px;
}

.show-name h1 {
  font-size: 36px;
  font-weight: bold;
  margin-bottom: 10px;
  text-transform: uppercase;
  color: #e81c1c;
}

.show-name h2 {
  font-size: 26px;
  margin-bottom: 10px;
  text-transform: uppercase;
  color: #333;
}

.time p {
  font-size: 18px;
  margin-bottom: 10px;
  color: #333;
  text-transform: uppercase;
  display: flex;
  align-items: center;
}

.time span {
  margin-right: 10px;
  color: #e81c1c;
  font-weight: bold;
}

.time p:last-child {
  color: green;
}

.table {
  margin-top: 20px;
}

table {
  border-collapse: collapse;
  width: 100%;
  font-size: 16px;
}

thead {
  background-color: #333;
  color: #fff;
}

th,
td {
  padding: 10px;
  text-align: center;
  border: 1px solid #ddd;
}

th {
  text-transform: uppercase;
  font-weight: bold;
}

tbody tr:first-child {
  background-color: #f2f2f2;
}

.location {
  font-size: 18px;
  margin-top: 20px;
  text-transform: uppercase;
  color: #333;
  display: flex;
  align-items: center;
}

.location span {
  margin-right: 10px;
}

.separator {
  margin: 0 10px;
  font-size: 24px;
  color: #e81c1c;
  font-weight: bold;
}

.right {
width: 40%;
height: 343px;
background-color: rgba(0, 128, 0, 0.646);
padding: 20px;
border-radius: 0px 10px 10px 0px;
display: flex;
flex-direction: column;
justify-content: space-between;
}

.right .admit-one {
margin: 0;
font-size: 25px;
font-weight: bold;
color: #0a0a0a;
text-align: center;
}

.right .right-info-container {
display: flex;
flex-direction: column;
justify-content: space-between;
align-items: center;
height: 100%;
}

.right .show-name h1 {
font-size: 25px;
font-weight: bold;
text-align: center;
margin: 20px 0 10px 0;
color: #ffffff;
}

.right .time {
display: flex;
flex-direction: column;
justify-content: center;
align-items: center;
font-size: 20px;
font-weight: bold;
margin: 20px 0;
}

.right .time span {
font-size: 14px;
font-weight: normal;
color: #555;
}

.right .barcode {
width: 70%;
margin: 20px auto;
position: absolute;
  top: 6px;
  left: 570px;
}

.right .ticket-number {
text-align: center;
font-size: 18px;
color: #555;
font-weight: bold;
}
 

	</style>
</head>
<body>
	<div class="ticket">
		<div class="left">
			
				
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
					<p> <span>STARTED AT</span>{{ date('g:i a', strtotime($ticket->match->date)) }}</p>
					<p >#{{ $ticket->serial_code }}</p>
					<p style="color: green">ZONE:  <b> {{ $ticket->category }}</b></p>
				</div>
				<div class="table">
					<table>
						<thead>
							<tr>
								<th>DOOR</th>
								<th>RANK</th>
								<th>SEAT</th>
								<th>PRICE</th>
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
				<p class="location">
					<span>{{ $ticket->match->field->name }}</span>
					<span class="separator"><i class="fas fa-futbol"></i></span>
					<span>{{ $ticket->match->field->location }}</span>
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
					<p> <span>STARTED AT</span> {{ date('g:i a', strtotime($ticket->match->date)) }}</p>
					<p style="color: #8b0000">ZONE:  {{ $ticket->category }}</p>
				</div>
				<div class="barcode">
					
					<img src="http://127.0.0.1:8000/css/4.png" alt="QR code">
				</div>
				<p class="ticket-number">#{{ $ticket->serial_code }}</p>
			</div>
		</div>
	</div>
</body>
</html>

