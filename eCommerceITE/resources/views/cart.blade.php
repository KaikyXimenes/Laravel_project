@extends('layouts.app')

@section('content')

<div class="container">
  @if($errors->any())

  @foreach($errors->all() as $error)
  <div class="alert alert-danger">{{$error}}</div>
  @endforeach

  @endif
  @if(flash()->message)
                <div class="alert alert-success">
                    {{ flash()->message }}
                </div>
                @endif
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Imagem</th>
        <th scope="col">Produto</th>
        <th scope="col">Preço</th>
        <th scope="col">Quantidade</th>
        <th scope="col">Remover</th>

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
          <form action="{{route('cart.update',$product['id'])}}" method="post">@csrf
            <input type="text" name="qty" value="{{$product['qty']}}">
            <button class="btn btn-secondary btn-sm">
              <i class="fas fa-sync"></i>Atualizar
            </button>
          </form>
        </td>
        <td>
          <form action="{{route('cart.remove',$product['id'])}}" method="post">@csrf

            <button class="btn btn-danger">Remover</button>
          </form>
        </td>
      </tr>
      @endforeach

    </tbody>
  </table>
  <hr>
  <div class="card-footer">
    <a href="{{url('/')}}"><button class="btn btn-primary">Continuar comprando</button></a>
    <span style="margin-left: 300px;">Preço Total: ${{$cart->totalPrice}}</span>

    <a href="{{route('cart.checkout',$cart->totalPrice)}}"><button class="btn btn-info float-right">Finalizar compra</button></a>

  </div>
  @else
  <td>Nenhum item no carrinho</td>
  @endif

</div>
@endsection
