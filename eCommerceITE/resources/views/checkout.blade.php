@extends('layouts.app')

@section('content')
<style>
  .StripeElement {
  box-sizing: border-box;

  height: 40px;

  padding: 10px 12px;

  border: 1px solid transparent;
  border-radius: 4px;
  background-color: white;

  box-shadow: 0 1px 3px 0 #e6ebf1;
  -webkit-transition: box-shadow 150ms ease;
  transition: box-shadow 150ms ease;
}

.StripeElement--focus {
  box-shadow: 0 1px 3px 0 #cfd7df;
}

.StripeElement--invalid {
  border-color: #fa755a;
}

.StripeElement--webkit-autofill {
  background-color: #fefde5 !important;
}
</style>

 <div class="container">
    <div class="row">
        
 	<div class="col-md-6">
 		<div class="card">
 			<div class="card-header">Finalizar Compra</div>
 			<div class="card-body">

 	     <form action="/charge" method="post" id="payment-form">@csrf
                      <div class="form-group">
                        <label>Nome</label>
                        <input type="text" name="name" id="name" class="form-control" required="" value="{{auth()->user()->name}}" readonly="">
                      </div>
                    
                      <div class="form-group">

                        <label>Endereço</label>
                        <input type="text" name="address" id="address" class="form-control" required="">
                      </div>
                      <div class="form-group">

                        <label>Cidade</label>
                        <input type="text" name="city" id="city" class="form-control" required="">
                      </div>
                      <div class="form-group">

                        <label>Estado</label>
                        <input type="text" name="state" id="state" class="form-control" required="">
                      </div>
                      <div class="form-group">

                        <label>Código Postal</label>
                        <input type="text" name="postalcode" id="postalcode" class="form-control" required="">
                      </div>
                      <div class="">
              <input type="hidden" name="amount" value="{{$amount}}">

                <div class="">
                <label for="card-element">
                    Cartão de crédito ou débito
                  </label>
                  <div id="card-element">
                    <!-- Um elemento Stripe será inserido aqui. -->
                  </div>

                  <!-- Usado para exibir erros de formulário. -->
                  <div id="card-errors" role="alert"></div>
                </div>

                <button class="btn btn-primary mt-4" type="submit">Enviar Pagamento</button>
   
            </form>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6">

           <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Imagem</th>
      <th scope="col">Produto</th>
      <th scope="col">Preço</th>
      <th scope="col">Quantidade</th>

    </tr>
  </thead>
  <tbody>

    @if($cart)
  @php $i=1 @endphp

@foreach($cart->items as $product)
    <tr>
      <th scope="row">{{$i++}}</th>
      
      <td><img src="{{asset($product['image'])}}" width="100"></td>
      <td>{{$product['name']}}</td>
      <td>${{$product['price']}}</td>
      <td>
        {{$product['qty']}}
    </td>
      <td>
    
      </td>
    </tr>
   @endforeach
   @endif

  </tbody>
</table>
<hr>
Preço Total: ${{$cart->totalPrice}}
</div>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript">
  // Cria um cliente Stripe.
window.onload=function(){
var stripe = Stripe('pk_test_51PmG6zL4ALTJLCrL7czk2ZXjIzRJBfbVHi4knPRhUXyLGKVwMZuHHtap1Ah1f0juJq51R8LbeniLehLBDhDySU9M00VhkdxpvB');

// Cria uma instância de Elements.
var elements = stripe.elements();

// Estilos personalizados podem ser passados para opções ao criar um Element.
// (Note que este demo usa um conjunto mais amplo de estilos do que o guia abaixo.)
var style = {
  base: {
    color: '#32325d',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};

// Cria uma instância do elemento de cartão.
var card = elements.create('card', {style: style});

// Adiciona uma instância do elemento de cartão ao <div> `card-element`.
card.mount('#card-element');

// Lida com erros de validação em tempo real do elemento de cartão.
card.addEventListener('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

// Lida com a submissão do formulário.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  var options={
    name:document.getElementById('name').value,
    address_line1:document.getElementById('address').value,
    address_city:document.getElementById('city').value,
    address_state:document.getElementById('state').value,
    address_zip:document.getElementById('postalcode').value
  }

  stripe.createToken(card,options).then(function(result) {
    if (result.error) {
      // Informa o usuário se houve um erro.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Envie o token para seu servidor.
      stripeTokenHandler(result.token);
    }
  });
});

// Envie o formulário com o ID do token.
function stripeTokenHandler(token) {
  // Insira o ID do token no formulário para que ele seja enviado ao servidor
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Envie o formulário
  form.submit();
}
}
</script>
@endsection
