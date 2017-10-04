window.Vue = require('vue');

const app = new Vue({
    el: '#smartscriptspage',
    data: {
        name: '',
        slug: ''
    },
    watch: {
        name : function()
        {
            if(this.name)
            {
                this.slug = this.name.split(' ').join('-').toLowerCase();
            }
        }
    }
});
