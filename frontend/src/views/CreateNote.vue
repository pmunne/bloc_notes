<template>
    <div class="create-note">
        <form @submit.prevent="addNote">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" v-model="note.title" required>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" id="content" v-model="note.content" rows="6" required></textarea>
            </div>

            <button type="submit">Save note</button>
        </form>
    </div>
</template>

<script setup lang="ts">
import { reactive } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';

const router = useRouter();
const note = reactive({
    title: '',
    content: ''
})

const addNote = async () => {
    try {
        await axios
            .post('http://localhost:8000/api/notes', note, {
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
<style scoped lang="scss">
    
</style>