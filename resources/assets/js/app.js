
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app',

    data: {
        'body': '',
        'posts': [],
        limit: 20,
    },
    
    mounted(){
        this.getPosts();

        setInterval(function(){
            this.getPosts();
        }.bind(this), 10000);
    },

    methods:{
        postStatus() {
            axios.post('/post', this.$data)
                .then(this.onSuccessPostStatus);
        },
        getPosts(){
            axios.get('/posts', {
                'limit': this.limit
            }).then(this.onSuccessGetStatus);
        },

        onSuccessGetStatus(response){
            this.posts = response.data.posts;
        },

        onSuccessPostStatus(response) {
            this.posts.unshift(response.data);
            this.body = '';
        }
    }
});
