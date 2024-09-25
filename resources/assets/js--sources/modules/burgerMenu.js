export const burgerMenu = () => {
  const burger = document.querySelector('[data-burger]');
  const menu = document.querySelector('[data-burger-menu]');
  const closeTriggers = document.querySelectorAll('[data-close]');
  const body = document.body;

  burger?.addEventListener('click', openMenu);
  closeTriggers?.forEach(trigger => trigger.addEventListener('click', closeMenu));

  function openMenu() {
    burger.classList.add('is-active');
    menu.classList.add('is-active');
    body.classList.add('no-scroll');
  }

  function closeMenu() {
    burger.classList.remove('is-active');
    menu.classList.remove('is-active');
    body.classList.remove('no-scroll');
  }
};

burgerMenu();
