<section class="s-contacts" id="contacts-extensible">
    <div class="s-contacts__container container">
        <div class="page-title">{{ Settings::get('block_contacts_title') }}</div>
        <div class="s-contacts__text">
            <p>{{ Settings::get('block_contacts_subtitle') }}</p>
        </div>
        <div class="s-contacts__grid">
            @if($emails = Settings::get('block_contacts_emails'))
                @foreach($emails as $email)
                    <div class="s-contacts__item">
                        <div class="s-contacts__icon lazy" data-bg="/static/images/common/ico_email.png"></div>
                        <a class="s-contacts__label" href="mailto:{{ $email }}">{{ $email }}</a>
                    </div>
                @endforeach
            @endif

            @if($phones = Settings::get('block_contacts_phones'))
                @foreach($phones as $phone)
                    <div class="s-contacts__item">
                        <div class="s-contacts__icon lazy" data-bg="/static/images/common/ico_tel.png"></div>
                        <a class="s-contacts__label" href="tel:{{ preg_replace('/[^\d+]/', '', $phone) }}">{{ $phone }}</a>
                    </div>
                    @if($loop->iteration == 1)
                        <div class="s-contacts__item">
                            <div class="s-contacts__icon lazy" data-bg="/static/images/common/ico_tel.png"></div>
                            <button class="s-contacts__label btn-reset" type="button" data-popup="data-popup" data-src="#callback">Обратный звонок</button>
                        </div>
                    @endif
                @endforeach
            @else
                <div class="s-contacts__item">
                    <div class="s-contacts__icon lazy" data-bg="/static/images/common/ico_tel.png"></div>
                    <button class="s-contacts__label btn-reset" type="button" data-popup="data-popup" data-src="#callback">Обратный звонок</button>
                </div>
            @endif
        </div>
    </div>
</section>
