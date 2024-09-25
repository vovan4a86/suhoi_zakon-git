export const orderDialog = () => {
  const body = document.body;
  const basket = document.querySelector('[data-basket]');
  const mainView = document.querySelector('[data-order]');
  const completeView = document.querySelector('[data-order-complete]');
  const finalView = document.querySelector('[data-order-final]');
  const backdrop = document.querySelector('[data-order-backdrop]');
  const nextButton = document.querySelector('[data-order-next]');
  const prevButton = document.querySelector('[data-order-prev]');
  const closeButtons = document.querySelectorAll('[data-order-close]');
  // const form = document.querySelector('[data-order-form]');

  basket.addEventListener('click', showOrder);
  nextButton.addEventListener('click', openNextView);
  prevButton.addEventListener('click', closeNextView);
  backdrop.addEventListener('click', closeOrder);
  closeButtons?.forEach(button => button.addEventListener('click', closeOrder));

  // form.addEventListener('submit', function (e) {
  //   e.preventDefault();
  //   openFinalView();
  // });

  function showOrder() {
    mainView.classList.add('is-active');
    backdrop.classList.add('is-active');
    body.classList.add('no-scroll');
  }

  function closeOrder() {
    mainView.classList.remove('is-active');
    backdrop.classList.remove('is-active');
    completeView.classList.remove('is-active');
    finalView.classList.remove('is-active');
    body.classList.remove('no-scroll');
  }

  function openNextView() {
    completeView.classList.add('is-active');
  }

  function closeNextView() {
    completeView.classList.remove('is-active');
  }

  // function openFinalView() {
  //   finalView.classList.add('is-active');
  // }
};

orderDialog();
