<!-- check out section -->
<div class="checkout-section mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="checkout-accordion-wrap">
                    <div class="accordion" id="accordionExample">
                        <div class="card single-accordion">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Адрес для выставления счета
                                    </button>
                                </h5>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="billing-address-form">
                                        <form action="{{route('cart.storeOrder')}}" id="sendCheckout" method="POST">
                                            @csrf
                                            <p><input type="text" name="name" value="{{auth()->user() ? auth()->user()->name : ''}}" placeholder="Имя"></p>
                                            <p><input type="email" name="email" value="{{auth()->user() ? auth()->user()->email : ''}}"  placeholder="Email"></p>
                                            <p><input type="text" name="address"  placeholder="Адресс"></p>
                                            <p><input type="tel" name="phone"  placeholder="Номер телефона"></p>
                                            <p><textarea name="comment" id="comment" cols="30" rows="10" placeholder="Комментарий"></textarea></p>
                                            <input type="submit"  class="boxed-btn" value="Сделать заказ">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <div class="col-lg-4">
                <div class="order-details-wrap">
                    @if($orderDetail && $total)
                    <table class="order-details">
                        <thead>
                        <tr>
                            <th>Детали заказа</th>
                            <th>Стоимость</th>
                        </tr>
                        </thead>
                        <tbody class="order-details-body">
<!--                        <tr>
                            <td>Товар</td>
                            <td>Сумма</td>
                        </tr>-->
                        @foreach($orderDetail as $name => $sum)
                        <tr>
                            <td>{{$name}}</td>
                            <td>${{$sum}}.00</td>
                        </tr>
                        @endforeach
                        </tbody>
                        <tbody class="checkout-details">
                        <tr>
                            <td>Сумма</td>
                            <td>${{$total}}</td>
                        </tr>
                        <tr>
                            <td>Доставка</td>
                            <td>$45</td>
                        </tr>
                        <tr>
                            <td>Итого</td>
                            <td>${{$total + 45}}</td>
                        </tr>
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end check out section -->
