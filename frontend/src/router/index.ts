import {createRouter, createWebHistory} from 'vue-router';
import NotesList from '@/views/NotesList.vue';

const routes = [
    { 
        path: '/',
        name: 'Home', 
        component: NotesList
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;