<section class="s-form">
    <form class="s-form__container container" action="{{ route('ajax.request') }}">
        <h2 class="s-form__title">Оставьте заявку</h2>
        <div class="s-form__fields">
            <div class="field">
                <input class="field__input" type="text" name="name" required="required" />
                <span class="field__highlight"></span>
                <span class="field__bar"></span>
                <label class="field__label">Имя *</label>
                <span class="field__required">Поле обязательно для заполнения</span>
            </div>
            <div class="field">
                <input class="field__input" type="text" name="email" required="required" />
                <span class="field__highlight"></span>
                <span class="field__bar"></span>
                <label class="field__label">Email *</label>
                <span class="field__required">Поле обязательно для заполнения</span>
            </div>
            <div class="field">
                <input class="field__input" type="tel" name="phone" required="required" />
                <span class="field__highlight"></span>
                <span class="field__bar"></span>
                <label class="field__label">Телефон *</label>
                <span class="field__required">Поле обязательно для заполнения</span>
            </div>
            <div class="field">
                <input class="field__input" type="text" name="text" />
                <span class="field__highlight"></span>
                <span class="field__bar"></span>
                <label class="field__label">Комментарий</label>
            </div>
        </div>
        <div class="s-form__foot">
            <button class="btn btn--outlined btn--dust btn-reset" type="submit" aria-label="Отправить">
                <span>Отправить</span>
            </button>
            <div class="s-form__policy">Нажимая на кнопку, вы соглашаетесь с условиями обработки персональных данных и
                <a href="{{ route('policy') }}" target="_blank">политикой конфиденциальности</a>
            </div>
        </div>
    </form>
</section>
