require('./bootstrap');

import { createApp } from 'vue'
import Home from './components/Home'

// console.log('is running')
Vue.component('upload-file-component', require('./components/UploadFileComponent.vue').default);
const myApp = createApp(Home)
myApp.mount('#app')


