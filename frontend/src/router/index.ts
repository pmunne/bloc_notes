import {createRouter, createWebHistory} from 'vue-router';
import NotesList from '@/views/NotesList.vue';
import CreateNote from '@/views/CreateNote.vue';
import EditNote from '@/views/EditNote.vue';

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
    },
    {
        path: '/edit/:id',
        name: 'EditNote',
        component: EditNote
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;