<template>
    <div class="note-card">
        <h3>{{ note.title }}</h3>
        <p>{{ note.content }}</p>
    
        <div class="note-footer">
            <small>{{ formatDate(note.created_at) }}</small>
            <div class="actions">
                <router-link :to="`/edit/${note.id}`">
                    <button class="btn btn-edit">Edit</button>
                </router-link>
                <button class="btn btn-danger" @click="$emit('delete',note.id)">Delete</button>
            </div>
        </div>

  
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

</style>