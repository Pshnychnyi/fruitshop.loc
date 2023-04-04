<!-- cart -->
<div class="cart-section mt-150 mb-150">
    <div class="container">
        @if($products && $products->IsNotEmpty())

        <div class="row" id="cart-row">
            <div class="col-lg-8 col-md-12">
                <div class="cart-table-wrap">
                    <table class="cart-table">
                        <thead class="cart-table-head">
                        <tr class="table-head-row">
                            <th class="product-remove"></th>
                            <th class="product-image">Фото</th>
                            <th class="product-name">Наименование</th>
                            <th class="product-price">Цена</th>
                            <th class="product-quantity">Кол-во</th>
                            <th class="product-total">Сумма</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                        <tr class="table-body-row" data-id="{{$product->id}}">
                            <td class="product-remove" id="product-remove">
                                <form action="{{ route('cart.remove', ['id' => $product->id]) }}"  id="remove-from-cart" method="POST" class="d-inline">
                                    @csrf
                                    <button data-name="submit" type="submit" class="m-0 p-0 border-0 bg-transparent"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                            <td class="product-image"><a href="{{route('main.shop.show', ['shop' => $product->id])}}" class="text-decoration-none text-reset"><img src="{{asset('storage/'. $product->img)}}" alt=""></a></td>
                            <td class="product-name"><a href="{{route('main.shop.show', ['shop' => $product->id])}}" class="text-decoration-none text-reset">{{$product->title}}</a></td>
                            <td class="product-price" id="product-price">${{$product->price}}</td>
                            <td class="product-quantity">
                                <form action="{{ route('cart.changeCount', ['id' => $product->id]) }}" id="add-count-to-cart" method="POST" class="d-inline">
                                    @csrf
                                    <input type="number" data-name="submit" data-id="{{$product->id}}" min="1" name="quantity" value="{{$product->pivot->quantity}}" placeholder="{{$product->pivot->quantity}}">
                                </form>
                            <td class="product-total" id="product-total-{{$product->id}}">${{$product->pivot->quantity * $product->price}}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="total-section">
                    <table class="total-table">
                        <thead class="total-table-head">
                        <tr class="table-total-row">
                            <th>Общее</th>
                            <th>Цена</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="total-data">
                            <td><strong>Сумма: </strong></td>
                            <td id="subtotal">${{$finalPrice}}</td>
                        </tr>
                        <tr class="total-data">
                            <td><strong>Доставка: </strong></td>
                            <td id="shipping">$45</td>
                        </tr>
                        <tr class="total-data">
                            <td><strong>Итого: </strong></td>
                            <td id="final-total">${{$finalPrice + 45}}</td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="cart-buttons">
                        <form action="{{route('cart.updateCart')}}" method="GET" class="custom-control-inline">
                            @csrf
                            <a id="updateCart" data-name="submit" class="boxed-btn">Обновить счет</a>
                        </form>
                        <a href="{{route('cart.checkout')}}" class="boxed-btn black">Оформление заказа</a>
                    </div>
                </div>

                <div class="coupon-section">
                    <h3>Скидочный купон</h3>
                    <div class="coupon-form-wrap">
                        <form action="index.html">
                            <p><input type="text" placeholder="Купон"></p>
                            <p><input type="submit" value="Применить"></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @else
            <h4 id="empty-cart-row">Корзина пуста</h4>
        @endif
    </div>
</div>
<!-- end cart -->
