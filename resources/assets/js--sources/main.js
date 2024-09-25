import 'focus-visible';
import './modules';
import './plugins';
import { utils } from './modules/utility';
import { scrollTop } from './modules/scrollTop';
import { maskedInputs } from './modules/inputMask';

utils();

scrollTop({ trigger: '.scrolltop' });

maskedInputs({
  phoneSelector: 'input[name="phone"]',
  emailSelector: 'input[name="email"]'
});
