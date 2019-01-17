

require('./bootstrap');

window.Vue = require('vue');

window.Laravel = {
    "csrfToken": "foo",
    "baseUrl": "http:\/\/127.0.0.1:8000/manage\/",
    "basePublicUrl": "http:\/\/127.0.0.1:8000\/"
  }


Vue.component('CreateArticle', require('./admin/components/CreateArticle').default);
Vue.component('SingleArticle', require('./admin/components/SingleArticle').default);

Vue.component('TopNavbar', require('./guest/components/TopNavbar').default);
Vue.component('FeaturedArticles', require('./guest/components/FeaturedArticles').default);
Vue.component('LatestArticles', require('./guest/components/LatestArticles').default);
Vue.component('LatestArticles', require('./guest/components/LatestArticles').default);
Vue.component('SinglePostSlider', require('./guest/components/SinglePostSlider').default);





const app = new Vue({
    el: '.app'
});
