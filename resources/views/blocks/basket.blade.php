@include('blocks.basket_btn')
<!--.b-order(data-order)-->
<form action="{{ route('ajax.order') }}" data-order-form="data-order-form">
    <div class="b-order" data-order="data-order">
        <div class="b-order__head">
            <div class="b-order__title">Корзина</div>
            <button class="b-order__btn btn-reset" type="button" data-order-close="data-order-close"
                    aria-label="Закрыть корзину">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor">
                    <path fill-rule="evenodd"
                          d="M13.243 4.757a.857.857 0 0 0-1.213 0L9 7.787l-3.03-3.03A.857.857 0 1 0 4.757 5.97L7.787 9l-3.03 3.03a.857.857 0 0 0 1.213 1.213L9 10.213l3.03 3.03a.857.857 0 1 0 1.213-1.213L10.213 9l3.03-3.03a.857.857 0 0 0 0-1.213Z"
                          clip-rule="evenodd"/>
                </svg>
            </button>
        </div>
        <div class="b-order__body">
            @if($cart = Session::get('cart', []))
                @foreach($cart as $item)
                    @include('cart.cart_item')
                @endforeach
            @endif
        </div>
        <div class="b-order__foot">
            <div class="b-order__sum">
                <div class="b-order__sum-label">Итого</div>
                @include('cart.total_sum')
            </div>
            <button class="b-order__action btn-reset" type="button" data-order-next="data-order-next"
                    aria-label="Оформить заказ">
                <span>Оформить заказ</span>
            </button>
            <div class="b-order__policy">Нажимая на кнопку, я даю согласие
                <a href="{{ route('contacts') }}" target="_blank">с офертой</a>&nbsp;и
                <a href="{{ route('policy') }}" target="_blank">политикой конфиденциальности</a>
            </div>
        </div>
    </div>
    <!--.b-order.-complete(data-order-complete)-->
    <div class="b-order b-order--complete" data-order-complete="data-order-complete">
        <div class="b-order__head">
            <div class="b-order__heading">
                <button class="b-order__btn btn-reset" type="button" data-order-prev="data-order-prev"
                        aria-label="Назад к заказу">
                    <svg xmlns="http://www.w3.org/2000/svg" width="6" height="10" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M5.707 8.293a1 1 0 0 1-1.414 1.414L1 6.414a2 2 0 0 1 0-2.828L4.293.293a1 1 0 0 1 1.414 1.414L2.414 5l3.293 3.293Z"
                              clip-rule="evenodd"/>
                    </svg>
                </button>
                <div class="b-order__title">Оформление заказа</div>
            </div>
            <button class="b-order__btn btn-reset" type="button" data-order-close="data-order-close"
                    aria-label="Закрыть корзину">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor">
                    <path fill-rule="evenodd"
                          d="M13.243 4.757a.857.857 0 0 0-1.213 0L9 7.787l-3.03-3.03A.857.857 0 1 0 4.757 5.97L7.787 9l-3.03 3.03a.857.857 0 0 0 1.213 1.213L9 10.213l3.03 3.03a.857.857 0 1 0 1.213-1.213L10.213 9l3.03-3.03a.857.857 0 0 0 0-1.213Z"
                          clip-rule="evenodd"/>
                </svg>
            </button>
        </div>
        <div class="b-order__body">
            <div class="b-order__row">
                <div class="b-order__subtitle">Контактные данные</div>
                <div class="b-order__fields">
                    <div class="field field--black">
                        <input class="field__input" type="text" name="name" required="required" autocomplete="off"/>
                        <span class="field__highlight"></span>
                        <span class="field__bar"></span>
                        <label class="field__label">Имя *</label>
                        <span class="field__required">Поле обязательно для заполнения</span>
                    </div>
                    <div class="field field--black">
                        <input class="field__input" type="tel" name="phone" required="required" autocomplete="off"/>
                        <span class="field__highlight"></span>
                        <span class="field__bar"></span>
                        <label class="field__label">Телефон *</label>
                        <span class="field__required">Поле обязательно для заполнения</span>
                    </div>
                    <div class="field field--black">
                        <input class="field__input" type="text" name="address" autocomplete="off"/>
                        <span class="field__highlight"></span>
                        <span class="field__bar"></span>
                        <label class="field__label">Адрес</label>
                    </div>
                    <div class="field field--black">
                        <input class="field__input" type="text" name="text" autocomplete="off"/>
                        <span class="field__highlight"></span>
                        <span class="field__bar"></span>
                        <label class="field__label">Комментарий</label>
                    </div>
                </div>
            </div>
            <div class="b-order__row">
                <div class="b-order__subtitle">Оплата</div>
                <div class="b-order__fields">
                    <div class="cart-radio">
                        <label class="cart-radio__label">
                            <input class="cart-radio__input" type="radio" name="payment" value="Наличными при получении"
                                   checked="checked"/>
                            <span class="cart-radio__body">
                                <span>Наличными при получении</span>
                            </span>
                        </label>
                    </div>
                    <div class="cart-radio">
                        <label class="cart-radio__label">
                            <input class="cart-radio__input" type="radio" name="payment" value="Картой при получении"/>
                            <span class="cart-radio__body">
                                <span>Картой при получении</span>
                            </span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="b-order__foot">
            <div class="b-order__sum">
                <div class="b-order__sum-label">Итого</div>
                @include('cart.total_sum')
            </div>
            <button class="b-order__action btn-reset" type="submit" aria-label="Подтвердить заказ">
                <span>Подтвердить заказ</span>
            </button>
        </div>
    </div>
    <!--.b-order.-final(data-order-final)-->
    <div class="b-order b-order--final" data-order-final="data-order-final">
        <div class="b-order__head">
            <div class="b-order__title">Готово</div>
            <button class="b-order__btn btn-reset" type="button" data-order-close="data-order-close"
                    aria-label="Закрыть корзину">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor">
                    <path fill-rule="evenodd"
                          d="M13.243 4.757a.857.857 0 0 0-1.213 0L9 7.787l-3.03-3.03A.857.857 0 1 0 4.757 5.97L7.787 9l-3.03 3.03a.857.857 0 0 0 1.213 1.213L9 10.213l3.03 3.03a.857.857 0 1 0 1.213-1.213L10.213 9l3.03-3.03a.857.857 0 0 0 0-1.213Z"
                          clip-rule="evenodd"/>
                </svg>
            </button>
        </div>
        <div class="b-order__body">
            <div class="b-order__complete">
                <div class="b-order__icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="42" height="36" fill="currentColor">
                        <path fill="#CBCFD3"
                              d="M30.534 13.194 22.241.754C21.864.377 21.298 0 20.733 0c-.566 0-1.13.188-1.508.754l-8.293 12.44H1.885C.754 13.194 0 13.948 0 15.078v.566l4.712 17.529C5.089 34.68 6.597 36 8.293 36h24.503c1.696 0 3.204-1.13 3.581-2.827l4.712-17.529v-.566c0-1.13-.754-1.884-1.885-1.884h-8.67Zm-15.455 0L20.733 4.9l5.654 8.293H15.078Z"
                        />
                    </svg>
                </div>
                <div class="b-order__output">Заказ №1</div>
                <div class="b-order__output">Спасибо за оформление заказа</div>
                <div class="b-order__context">Мы получили ваш заказ и скоро свяжемся с вами</div>
            </div>
        </div>
        <div class="b-order__foot">
            <button class="b-order__action btn-reset" type="button" data-order-close="data-order-close"
                    aria-label="Закрыть корзину">
                <span>Закрыть корзину</span>
            </button>
        </div>
    </div>
    <!--.b-order.-backdrop(data-order-backdrop)-->
    <div class="b-order b-order--backdrop" data-order-backdrop="data-order-backdrop"></div>
</form>
