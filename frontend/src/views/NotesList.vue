<template>
    <div>
        <h2>Notes</h2>
        <router-link to="/create">
            <button>Create new note</button>
        </router-link>
        <div v-if="notes.length === 0">
            <p>Ther are no notes yet.</p>
        </div>
        <div v-else class="note-list">
            <NoteCard v-for="note in notes" :key="note.id" :note="note" @delete="deleteNote"/>
        </div>
        <div class="pagination">
            <button @click="prevPage" :disabled="currentPage === 1">Previous</button>
            <span>{{ currentPage }}</span>
            <button @click="nextPage" :disabled="currentPage === lastPage">Next</button>
        </div>    
    </div>

</template>
<script setup lang="ts">

import { onMounted, ref, watch } from 'vue';
import axios from 'axios';
import NoteCard from '@/components/NoteCard.vue';

const notes = ref([]);
const currentPage = ref(1);
const lastPage = ref(1);

//Fetch all notes.
const fetchNotes = async () => {
    try {
        const res = await axios
            .get(`http://localhost:8000/api/notes?page=${currentPage.value}`, {
                headers: {
                    Authentication: 'Doonamis',
                },
            });
       
            notes.value = res.data.data;
            console.log(notes.value);
            lastPage.value = res.data.last_page;

        } catch (err) {
            console.error('Error trying to receive notes', err);
        }
    };
onMounted(fetchNotes);
watch(currentPage, fetchNotes);

const nextPage = () => {
    if(currentPage.value < lastPage.value) currentPage.value++;
};

const prevPage = () => {
    if (currentPage.value > 1) currentPage.value--;
};

//Deletes a note by its ID and refresh.
const deleteNote = async (id: number) => {
    const operation = confirm('Are you sure that you want to delete this note?');
    if(!operation) return;
    try {
        await axios
            .delete(`http://localhost:8000/api/notes/${id}`, {
                headers: {
                    Authentication: 'Doonamis',
                },
            });

            await fetchNotes();
    } catch (error) {
        console.error('Error deleting note', error);
    }
}

</script>