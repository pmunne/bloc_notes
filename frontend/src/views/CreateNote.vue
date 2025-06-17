<template>
    <div class="create-note">
        <p>Hello</p>
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