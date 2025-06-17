import {createRouter, createWebHistory} from 'vue-router';
import NotesList from '@/views/NotesList.vue';
import CreateNote from '@/views/CreateNote.vue';

const routes = [
    { 
        path: '/',
        name: 'Home', 
        component: NotesList
    },
    {
        path: '/create',
        name: 'CreateNote',
        component: CreateNote
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;