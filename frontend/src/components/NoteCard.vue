<template>
    <div class="note-card">
        <h3>{{ note.title }}</h3>
        <p>{{ note.content }}</p>
        <small>{{ formatDate(note.created_at) }}</small>
        <router-link :to="`/edit/${note.id}`">Edit</router-link>
        <button @click="$emit('delete',note.id)">Delete</button>
    </div>
</template>
<script setup lang="ts">
defineProps<{
    note: {
        id: number;
        title: string;
        content: string;
        created_at: string;

    }
}>();

//Converts the date into a (dd/mm/yyyy) format
const formatDate = (dateStr: string) => {
    return new Date(dateStr).toLocaleDateString();
}

</script>
<style scoped lang="scss">
small {
    color: $primary_color;
}

</style>