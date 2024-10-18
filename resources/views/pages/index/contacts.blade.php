<div class="site-section bg-light" id="contacts">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5" data-aos="fade-up" data-aos-delay="">
                @if($titles = S::get('contacts_titles'))
                    <div class="block-heading-1">
                        @if($titles['subtitle'])
                            <span>{{ $titles['subtitle'] }}</span>
                        @endif
                        @if($titles['title'])
                            <h2>{{ $titles['title'] }}</h2>
                        @endif
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 mb-5" data-aos="fade-up" data-aos-delay="100">
                <form action="#" method="post">
                    <div class="form-group row">
                        <div class="col-md-6 mb-4 mb-lg-0">
                            <input type="text" class="form-control" placeholder="Имя">
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Фамилия">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <input type="text" class="form-control" placeholder="Адрес электронной почты">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
              <textarea name="message" class="form-control" placeholder="Напишите сообщение..." cols="30"
                        rows="10"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 mr-auto">
                            <input type="submit" class="btn btn-block btn-primary text-white py-3 px-5"
                                   value="Отправить сообщение">
                        </div>
                    </div>
                </form>
            </div>

            @if($contacts = S::get('contacts'))
                <div class="col-lg-4 ml-auto" data-aos="fade-up" data-aos-delay="200">
                    <div class="bg-white p-3 p-md-5">
                        <h3 class="text-black mb-4">Контакты</h3>
                        <!-- РАЗДЕЛ О НАС -->
                        <ul class="list-unstyled footer-link">
                            @if($contacts['address'])
                                <li class="d-block mb-3">
                                    <span class="d-block text-black">Адрес редакции:</span>
                                    <span>{!! $contacts['address'] !!}</span>
                                </li>
                            @endif
                            @if($contacts['phone'])
                                <li class="d-block mb-3"><span
                                            class="d-block text-black">Телефон:</span><span>{{ $contacts['phone'] }}</span>
                                </li>
                            @endif
                            @if($contacts['email'])
                                <li class="d-block mb-3"><span class="d-block text-black">Email:</span><span>{{ $contacts['email'] }}</span>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
