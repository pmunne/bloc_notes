<template>
    <div class="edit-note">
        <div v-if="isLoading" class="loading-spinner">
            <p>Wait a moment...</p>
        </div>
        <form v-else @submit.prevent="updateNote">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" v-model="note.title" required>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" id="content" v-model="note.content" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Save note</button>
        </form>

    </div>

</template>
<script setup lang="ts">
import { onMounted, reactive, ref } from 'vue';
import axios from 'axios';
import { useRouter, useRoute } from 'vue-router';

const route = useRoute();
const router = useRouter();
const note_id = route.params.id;
const isLoading = ref(true);

const note = reactive({
    title: '',
    content: ''
})

//Fetch the note by its ID.
const fetchNote = async () => {
    try {
        const res = await axios
            .get(`http://localhost:8000/api/notes/${note_id}`, {
                headers: {
                    Authentication: 'Doonamis',
                },
            });
            note.title = res.data.title;
            note.content = res.data.content;
    }catch (error) {
        console.error('Error recieveing note', error);
    } finally {
        isLoading.value = false
    }
};
onMounted(fetchNote);

//Update the note. 
const updateNote = async () => {
    try {
        await axios
            .put(`http://localhost:8000/api/notes/${note_id}`, note, {
                headers: {
                    Authentication: 'Doonamis', 
                },
            });

            router.push('/');
    } catch (error) {
        console.error('Error creating the note', error);
    }
};




</script>