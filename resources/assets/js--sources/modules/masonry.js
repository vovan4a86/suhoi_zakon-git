import * as Macy from 'macy';
export const masonry = () => {
  const galleries = document.querySelectorAll('[data-masonry-gallery]');

  galleries?.forEach(gallery => {
    new Macy({
      container: gallery,
      trueOrder: false,
      waitForImages: false,
      margin: 50,
      columns: 3,
      breakAt: {
        1200: {
          margin: 20,
          columns: 2
        },
        520: {
          margin: 0,
          columns: 1
        }
      }
    });
  });
};

masonry();
