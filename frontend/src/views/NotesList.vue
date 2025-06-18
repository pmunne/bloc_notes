<template>
    <div class="notes-list">
        <div class="notes-list_header">
            <h2>Notes</h2>
            <div class="notes-list_action">
                <input type="text" v-model="searchNote" placeholder="Search by title" class="notes-search"/>
                <router-link to="/create">
                    <button class="btn btn-primary">Create new note</button>
                </router-link>
            </div>

        </div>
     
        <div v-if="isLoading" class="notes-list_content">
            <SkeletonNoteCard v-for="(i, index) in skeletons" :key="index"/>
        </div>
        <div v-else-if="notes.length === 0">
            <p>There are no notes yet.</p>
        </div>
        <div v-else class="notes-list_content">
            <NoteCard v-for="note in notes" :key="note.id" :note="note" @delete="deleteNote"/>
        </div>
        <div class="pagination">
            <button class="btn btn-ant" @click="prevPage" :disabled="currentPage === 1">Previous</button>
            <span>{{ currentPage }}</span>
            <button class="btn btn-next" @click="nextPage" :disabled="currentPage === lastPage">Next</button>
        </div>
    </div>

</template>
<script setup lang="ts">

import { onMounted, ref, watch } from 'vue';
import axios from 'axios';
import debounce from 'lodash.debounce';
import NoteCard from '@/components/NoteCard.vue';
import SkeletonNoteCard from '@/components/SkeletonNoteCard.vue';

const notes = ref([]);
const currentPage = ref(1);
const lastPage = ref(1);
const searchNote = ref('');
const debounceSearch = ref('')
const isLoading = ref(true);

const skeletons = Array.from({ length: 6});

// Debounced call: fetchNotes() is triggered 400ms after the last keystroke
const updateSearch = debounce((val: string) => {
    debounceSearch.value = val;
    currentPage.value = 1;

    fetchNotes();
}, 400)
watch(searchNote, updateSearch);


//Fetch all notes.
const fetchNotes = async () => {
    isLoading.value = true;
    try {
        const res = await axios
            .get(`http://localhost:8000/api/notes?page=${currentPage.value}`, {
                headers: {
                    Authentication: 'Doonamis',
                },
                params: {
                    page: currentPage.value,
                    search: debounceSearch.value || undefined,
                }
            });
       
            notes.value = res.data.data;
            lastPage.value = res.data.last_page;

        } catch (err) {
            console.error('Error trying to receive notes', err);
        } finally {
            isLoading.value = false;
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