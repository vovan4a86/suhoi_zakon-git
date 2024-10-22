<footer class="site-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-7">
                        @if($about = S::get('footer_about'))
                            <h2 class="footer-heading mb-4">О нас</h2>
                            <p>{!! $about !!}</p>
                        @endif
                    </div>
                    <div class="col-md-4 ml-auto">
                        <h2 class="footer-heading mb-4">Разделы</h2>
                        <ul class="list-unstyled">
                            @foreach($footer_menu as $item)
                                <li><a href="/#{{ $item->alias }}">{{ $item->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>


            <div class="col-md-4 ml-auto">
                <div class="mb-5">
                    <h2 class="footer-heading mb-4">подписка на рассылку</h2>
                    <form action="#" method="post" class="footer-suscribe-form">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control border-secondary text-white bg-transparent"
                                   placeholder="Адрес эл.почты" aria-label="Enter Email"
                                   aria-describedby="button-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary text-white" type="button" id="button-addon2">
                                    Подписаться
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <ul class="list-unstyled">
                    <li><a href="{{ route('policy') }}" target="_blank">Политика обработки персональных данных</a></li>
                </ul>
            </div>
        </div>
        <div class="row pt-5 mt-5 text-center">
            <div class="col-md-12">
                <div class="border-top pt-5">
                    <p class="copyright">
                       {!! S::get('footer_copy') !!}
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>