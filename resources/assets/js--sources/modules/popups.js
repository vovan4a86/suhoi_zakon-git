import { Fancybox } from '@fancyapps/ui';

export const closeBtn =
  '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M25 7 7 25M25 25 7 7"/></svg>';

// Fancybox.bind('[data-video]', {
//   Html: {
//     youtube: {
//       controls: 0,
//       rel: 0,
//       fs: 0
//     }
//   }
// });

Fancybox.bind('[data-fancybox]', {
  closeButton: 'outside',
  showClass: 'f-fadeIn',
  hideClass: 'f-fadeOut',
  infinite: false
});

Fancybox.bind('[data-popup]', {
  closeButton: 'outside',
  mainClass: 'popup--custom',
  template: { closeButton: closeBtn },
  showClass: 'f-fadeIn',
  hideClass: 'f-fadeOut',
  hideScrollbar: false
});

export const showSuccessDialog = () => {
  Fancybox.show([{ src: '#thanks', type: 'inline' }], {
    closeButton: 'outside',
    mainClass: 'popup--custom',
    template: { closeButton: closeBtn },
    showClass: 'f-fadeIn',
    hideClass: 'f-fadeOut'
  });
};

// в свой модуль форм, импортируешь функцию вызова «спасибо» → вызываешь on success
// import { showSuccessDialog } from 'путь до компонента'
// вызываешь где нужно
// showSuccessDialog();
