<template>
    <div>
        <h2>Notes</h2>
            <p>hOLA</p>
    </div>

</template>
<script setup lang="ts">

import { onMounted, ref, watch } from 'vue';
import axios from 'axios';
const notes = ref([]);
const currentPage = ref(1);
const lastPage = ref(1);

const fetchNotes = async () => {
    try {
        const res = await axios
            .get(`http://localhost/api/notes?page=${currentPage.value}`, {
                headers: {
                    Authentication: 'Doonamis',
                },
            });
            console.log(notes.value);
            notes.value = res.data.data;
            lastPage.value = res.data.last_page;

        } catch (err) {
            console.error('Error trying to recive notes', err);
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


</script>