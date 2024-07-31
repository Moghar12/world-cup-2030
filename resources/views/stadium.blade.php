<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>stadium</title>
  <link rel="stylesheet" href="{{ asset('css/stadium.css') }}">

</head>
<body>
<!-- partial:index.partial.html -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Card UI Design</title>

   
   

</head>

<body>

    <div class="container">
        <div class="imgBx">
            <img src="{{ $field->image }}" alt="stadium Image">
        </div>
        <div class="details">
            <div class="content">
                <h2> {{ $field->name }}<br>
                    <span>{{ $field->location }}</span>
                </h2>
                <p>
                    {!! $field->details !!}
                </p>
                
                <h3>capacity:{{ number_format($field->capacity, 0, ',', '.') }}</h3>
                <button><a href="{{ URL::previous() }}" style="text-decoration: none; color:rgb(255, 255, 255)"> go back</a></button>
            </div>
        </div>
    </div>

   


    

</body>

</html>

  
</body>
</html>
