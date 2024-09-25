export const catalogNav = () => {
  const link = document.querySelector('[data-catalog-link]');
  const nav = document.querySelector('[data-catalog-nav]');
  const close = document.querySelector('[ data-catalog-close]');

  link?.addEventListener('click', function (e) {
    e.preventDefault();

    nav.classList.add('is-active');
    document.body.classList.add('no-scroll');
  });

  close?.addEventListener('click', function () {
    nav.classList.remove('is-active');
    document.body.classList.remove('no-scroll');
  });
};

catalogNav();
