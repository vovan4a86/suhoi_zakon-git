<!--.b-basket-->
<!-- set class unactive by default: <div class="b-basket unactive">-->
<!-- remove class unactive to show-->
<div class="b-basket {{ Cart::count() == 0 ? 'unactive' : null }}" data-basket="data-basket">
    <button class="b-basket__btn btn-reset" type="button" aria-label="Открыть корзину" data-count="{{ Cart::count() }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="26" fill="currentColor">
            <path d="M21.922 9.472 15.968.542C15.698.27 15.29 0 14.885 0c-.406 0-.812.135-1.082.541L7.849 9.472H1.353C.541 9.472 0 10.014 0 10.826v.406l3.383 12.585c.27 1.082 1.353 2.03 2.571 2.03h17.592c1.218 0 2.3-.813 2.571-2.03L29.5 11.232v-.406c0-.812-.541-1.354-1.353-1.354h-6.225Zm-11.096 0 4.06-5.954 4.059 5.954h-8.12Z"
            />
        </svg>
    </button>
</div>
