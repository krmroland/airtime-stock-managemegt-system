
import lodash from "lodash";

window._ = lodash;




 window.axios = require('axios');

 window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';



 let token = document.head.querySelector('meta[name="csrf-token"]');

 import Vue from "vue";

 window.Vue=Vue;

 window.events = new Vue();

 window.flash = function (message,type="success") {
 	let data={message,type};
 	window.events.$emit('flash', data);
 };
