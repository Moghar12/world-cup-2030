<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CheckOut</title>
  <link rel="icon" type="image/x-icon" href="{{ asset("css/3.png") }}">
  <link href="{{ asset('css/checkout.css') }}" rel="stylesheet"> 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />                     
</head>
<body>
  @extends('layouts\header')

  <div class="min-h-screen bg-slate-200 dark:bg-slate-200">

<!-- partial:index.partial.html -->
<div class="mainscreen">
      <div class="card">
        <div class="leftside">
          <img
            src="{{ asset('css/1.png') }}"
            class="product"
            alt="Shoes"
          />
        </div>
        <div class="rightside">
          
          <a href="/"><i class='fa-solid fa-xmark' style="float: right;"></i></a>

          <form action="{{ route('checkout') }}" method="POST">
            @csrf
            <h1>CheckOut</h1>
            <h2>{{ $match->name }} ({{ $match->type }})</h2>
            <p>ticket owner Name</p>
            <input type="text" class="inputbox" value="{{ Auth()->user()->name }}"name="name" required />
            <p>zone</p>
            <select name="category"  class="inputbox" id="category-select">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="VIP">VIP</option>

            </select>
            <p>Card number</p>
            <input type="text" class="inputbox" name="card_number" id="card_number" required pattern="[0-9]{4}[\s]*[0-9]{4}[\s]*[0-9]{4}[\s]*[0-9]{4}" maxlength="22" placeholder="0000 0000 0000 0000" />

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#card_number').on('input', function() {
                        var cardNumber = $(this).val().replace(/ /g, '');
                        var formattedCardNumber = '';
                        for (var i = 0; i < cardNumber.length; i++) {
                            if (i % 4 == 0 && i > 0) {
                                formattedCardNumber += ' ';
                            }
                            formattedCardNumber += cardNumber[i];
                            if (i == 3 || i == 7 || i == 11) {
                                formattedCardNumber += ' ';
                            }
                        }
                        $(this).val(formattedCardNumber);
                    });
                });
            </script>
            


              <p>Card Type</p>
            <select class="inputbox" name="card_type" id="card_type" required>
              <option value="">--Select a Card Type--</option>
              <option value="Visa">Visa</option>
              <option value="RuPay">RuPay</option>
              <option value="MasterCard">MasterCard</option>
            </select>
<div class="expcvv">

            <p class="expcvv_text">Expiry</p>
            <input type="month" class="inputbox" name="exp_date" id="exp_date"  required />

            <p class="expcvv_text2">CVV</p>
            <input type="password" class="inputbox" name="cvv" id="cvv" required />
        </div>
      
        <div class="price">
            <p style="color: green;">price:</p><p><span id="price"><?php echo intval($match->price);?></span> DH</p>
          </div>
          <script>
          
            // get references to the HTML elements
            const categorySelect = document.getElementById('category-select');
            const priceSpan = document.getElementById('price');
            const pricesSpan = document.getElementById('prices');

        
        
            categorySelect.addEventListener('change', function() {
              const category = categorySelect.value;
              let finalPrice = 0;
              switch (category) {
                    case '1':
                        finalPrice = <?php echo $match->price; ?>;
                        break;
                    case '2':
                        finalPrice = <?php echo $match->price; ?> * 1.5;
                        break;
                    case '3':
                        finalPrice = <?php echo $match->price; ?> * 2;
                        break;
                    case 'VIP':
                        finalPrice = <?php echo $match->price; ?> * 3;
                        break; 
                    default:
                        console.error('Invalid category');
                        return;
                }
                priceSpan.textContent = finalPrice;
                pricesSpan.textContent = finalPrice;

        
            })
                </script>
<input type="text" name="match_id" value="{{ $match->id }}" hidden>

<input type="text" name="price" value="{{ $match->price }}" hidden>



            <button type="submit" class="button">CheckOut</button>
          </form>
        </div>
      </div>
    </div>
<!-- partial -->
  
</body>
</html>
