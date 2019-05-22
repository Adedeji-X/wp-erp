import App from './App.vue'
import router from './router'
import store from './store/store'

// get lib reference
let Vue = acct_get_lib('Vue');
let VeeValidate = acct_get_lib('VeeValidate');
let VueSweetalert2 = acct_get_lib('VueSweetalert2');
let Loading = acct_get_lib('Loading');
let commonMixins = acct_get_lib('commonMixins');

// config
Vue.config.productionTip = false

// vue uses
Vue.use(VeeValidate);
Vue.use(VueSweetalert2);
Vue.use(Loading);

// mixin
Vue.mixin(commonMixins);

// vue click outside directive
Vue.directive('click-outside', {
    bind(el, binding, vnode) {
        const bubble = binding.modifiers.bubble
        const handler = e => {
            if ( bubble || ( ! el.contains( e.target ) && el !== e.target ) ) {
                binding.value(e)
            }
        }

        el.__vueClickOutside__ = handler
        document.addEventListener('click', handler)
    },

    unbind(el, binding) {
        document.removeEventListener('click', el.__vueClickOutside__)
        el.__vueClickOutside__ = null
    }
})

/* eslint-disable no-new */
new Vue({
    el: '#erp-accounting',
    router,
    store,
    render: h => h(App)
});
