import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

module.exports = {
    theme: {
      extend: {
        width: {
          '2/5': '40%',
        },
      },
    },
  };
  