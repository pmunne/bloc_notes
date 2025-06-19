<template>
    <div class="note-form">
        <!-- Shows a spinner if is loading -->
        <div v-if="isLoading" class="loading-spinner">
            <p>Wait a moment...</p>
        </div>
        <form v-else @submit.prevent="handleSubmit">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" v-model="note.title" required>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" id="content" v-model="note.content" rows="6" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">
                {{ isSaving ? (isUpdating ? 'Updating...' : 'Saving...') :(isUpdating ? 'Update note' : 'Save note') }}
                <span v-if="isSaving" class="loading-spinner inline"/>
            </button>
            <button v-if="isUpdating" type="button" class="btn" @click="$emit('cancel')" >Cancel</button>
        </form>

    </div>

</template>
<script setup lang="ts">
import axios from 'axios';
import { computed, onMounted, reactive, ref } from 'vue';

const isLoading = ref(false);
const isSaving = ref(false);
const props = defineProps<{
    id?: number;
}>();


const emit = defineEmits(['saved','cancel']);

// Detect is there is an Id, if it is, is updating
const isUpdating = computed(() => props.id !== undefined);

// Reactive state of the note
const note = reactive ({
    title: '',
    content: ''
})


//Fetch a note from the DB
const fetchNote = async () => {
    try {
        const res = await axios
            .get(`http://localhost:8000/api/notes/${props.id}`, {
                headers: {
                    Authentication: 'Doonamis',
                },
            });
            note.title = res.data.title;
            note.content = res.data.content;
    }catch (error) {
        console.error('Error fetching note', error);
    } finally {
        isLoading.value = false
    }
};
if(props.id !== undefined) {
    isLoading.value = true;
    onMounted(fetchNote);
}


//Handle submit depends on isUpdating or not.
const handleSubmit = async () => {
    isSaving.value = true;
    try {
        if(isUpdating.value) {
            //Update the note form   
            await axios
                .put(`http://localhost:8000/api/notes/${props.id}`, note, {
                headers: {
                    Authentication: 'Doonamis', 
                },
            });
        }else {
            //Insert a new note
            await axios
                .post('http://localhost:8000/api/notes', note, {
                    headers: {
                        Authentication: 'Doonamis', 
                    },
                });

        }
        emit('saved');
    }catch (error) {
        console.error('Error saving note', error);
    } finally {
        isSaving.value = false;
    }
}



</script>