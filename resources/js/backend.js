// window._ = require('lodash');
window.$ = window.jQuery = require('jquery');

import 'bootstrap'
import 'select2'

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

require('./components/Delete');
require('./components/lyrics/Create');
// require('./components/lyrics/Table');