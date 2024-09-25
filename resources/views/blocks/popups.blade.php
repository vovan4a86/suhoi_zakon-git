<form class="popup" id="callback" action="{{ route('ajax.callback') }}" style="display: none">
    <div class="popup__heading lazy" data-bg="/static/images/common/popup.jpeg">
        <span>Заказать обратный звонок</span>
    </div>
    <div class="popup__container">
        <div class="popup__fields">
            <div class="field field--black">
                <input class="field__input" type="text" name="name" autocomplete="off">
                <span class="field__highlight"></span>
                <span class="field__bar"></span>
                <label class="field__label">Ваше имя</label>
            </div>
            <div class="field field--black">
                <input class="field__input" type="tel" name="phone" required autocomplete="off">
                <span class="field__highlight"></span>
                <span class="field__bar"></span>
                <label class="field__label">Телефон *</label>
                <span class="field__required">Поле обязательно для заполнения</span>
            </div>
        </div>
        <div class="popup__actions">
            <button class="popup__action btn-reset" type="submit" aria-label="Отправить">
                <span>Отправить</span>
            </button>
            <div class="popup__policy">Нажимая на кнопку, вы даете согласие на обработку своих персональных данных и соглашаетесь с
                <a href="{{ route('policy') }}" target="_blank">политикой конфиденциальности.</a>
            </div>
        </div>
    </div>
</form>
<div class="popup" id="thanks" style="display: none">
    <div class="popup__heading lazy" data-bg="/static/images/common/popup.jpeg">
        <span>Отправлено</span>
    </div>
    <div class="popup__container">
        <div class="popup__title">Заявка успешно отправлена!</div>
    </div>
</div>

@include('blocks.basket')

<div class="scrolltop" aria-label="В начало страницы" tabindex="1">
    <svg class="svg-sprite-icon icon-up" width="1em" height="1em">
        <use xlink:href="/static/images/sprite/symbol/sprite.svg#up"></use>
    </svg>
</div>
