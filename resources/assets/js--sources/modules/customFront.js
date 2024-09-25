import $ from 'jquery';
import { showSuccessDialog } from './popups'
import {orderDialog} from "./orderDialog";
import {counter} from "./counter"

export const resetForm = (form) => {
    $(form).trigger('reset');
    $(form).find('.err-msg-block').remove();
    $(form).find('.has-error').remove();
    $(form).find('.invalid').attr('title', '').removeClass('invalid');
}

export const sendAjax = (url, data, callback, type) => {
    data = data || {};
    if (typeof type == 'undefined') type = 'json';
    $.ajax({
        type: 'post',
        url: url,
        data: data,
        // processData: false,
        // contentType: false,
        dataType: type,
        beforeSend: function (request) {
            return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
        },
        success: function (json) {
            if (typeof callback == 'function') {
                callback(json);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert('Не удалось выполнить запрос! Ошибка на сервере.');
            console.log(errorThrown);
        },
    });
}

//оставить заявку
$('.s-form form').submit(function (e) {
   e.preventDefault();
    let form = $(this);
    let data = form.serialize();
    let url = form.attr('action');
    sendAjax(url, data, function (json) {
        if (typeof json.errors !== 'undefined') {
            let focused = false;
            for (let key in json.errors) {
                if (!focused) {
                    form.find('#' + key).focus();
                    focused = true;
                }
                form.find('#' + key).after('<span class="has-error">' + json.errors[key] + '</span>');
            }
            form.find('.popup__fields').after('<div class="err-msg-block has-error">Заполните, пожалуйста, обязательные поля.</div>');
        } else {
            resetForm(form);
            // $('.carousel__button.is-close').click();
            showSuccessDialog();
        }
    });

});

//перезвонить
$('#callback').submit(function (e) {
    e.preventDefault();
    let form = $(this);
    let data = form.serialize();
    let url = form.attr('action');
    sendAjax(url, data, function (json) {
        if (typeof json.errors !== 'undefined') {
            let focused = false;
            for (let key in json.errors) {
                if (!focused) {
                    form.find('#' + key).focus();
                    focused = true;
                }
                form.find('#' + key).after('<span class="has-error">' + json.errors[key] + '</span>');
            }
            form.find('.popup__fields').after('<div class="err-msg-block has-error">Заполните, пожалуйста, обязательные поля.</div>');
        } else {
            resetForm(form);
            $('.carousel__button.is-close').click();
            showSuccessDialog();
        }
    });
})

//добавить в корзину
$('[data-cart]').click(function (e)  {
    e.preventDefault();
    const btn = $(this);
    let id = $(this).data('cart');
    let url = '/ajax/add-to-cart';
    const basket_btn = $('[data-basket]');
    const cart = $('.b-order__body');

    sendAjax(url, {id}, function (json) {
        if (json.success) {
            basket_btn.replaceWith(json.basket_btn);
            $('.b-order__sum-label').replaceWith(json.total);
            cart.append(json.cart_item);
            btn.find('span').text('В корзине');
            btn.attr('disabled', true);
            orderDialog();
            counter();
            deleteItemFromCartHandler();
        }
    });
})

//обновить количество товаров в корзине
export const updateCartCount = (id, count) => {
    sendAjax('/ajax/update-to-cart', {id, count}, function(json) {
        if(json.success) {
            $('.b-order__sum-label').replaceWith(json.total);
            $('.cart-item[data-id=' + json.id +']').find('.cart-item__data').replaceWith(json.basket_item_data);
        }
    })
}

//удаление товара из корзины
export const deleteItemFromCartHandler = () => {
    $('.cart-item__delete button').click(function (e) {
        e.preventDefault();
        const url = '/ajax/remove-from-cart';
        const item = $(this).closest('.cart-item');
        const id = $(item).data('id');

        if(!id) {
            console.error('ID товара не найден');
            return;
        }
        sendAjax(url, {id}, function (json) {
            if(json.success) {
                $(item).fadeOut(300, function(){ $(this).remove(); });
                $('.b-order__sum-label').replaceWith(json.total);
                $('[data-basket]').replaceWith(json.basket_btn);
                const btn = $('[data-cart=' + json.id +']');
                btn.text('В корзину');
                btn.attr('disabled', false);
                orderDialog();
            }
        });
    });
}
deleteItemFromCartHandler();

//подтвердить заказ
$('[data-order-form]').submit(function (e) {
    e.preventDefault();
    let form = $(this);
    let data = form.serialize();
    let url = form.attr('action');
    const final = $('[data-order-final]');
    sendAjax(url, data, function (json) {
        if (typeof json.errors !== 'undefined') {
            let focused = false;
            for (let key in json.errors) {
                if (!focused) {
                    form.find('#' + key).focus();
                    focused = true;
                }
                form.find('#' + key).after('<span class="has-error">' + json.errors[key] + '</span>');
            }
            form.find('.b-order__row:last').after('<div class="err-msg-block has-error">Заполните, пожалуйста, обязательные поля.</div>');
        } else {
            resetForm(form);
            $(final).find('.b-order__output:first').text('Заказ ' + json.order_id)
            $(final).addClass('is-active');
        }
    });

});
