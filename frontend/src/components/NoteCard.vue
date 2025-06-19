<template>
    <div class="note-card" :class="{update: isUpdateing}">
        <div v-if="isDeleteing" class="deleteNote">
            <div class="loading-spinner">Deleting...</div>
        </div>
        <div v-else>
            <h3>{{ note.title }}</h3>
            <p>{{ note.content }}</p>
        
            <div class="note-footer">
                <small>{{ formatDate(note.created_at) }}</small>
                <div class="actions">
                    <button class="btn btn-edit" @click="$emit('edit', note.id)">Edit</button>
                    <button class="btn btn-danger" @click="$emit('delete',note.id)">Delete </button>
                </div>
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

    },
    isDeleteing?: boolean,
    isUpdateing?: boolean
}>();



//Converts the date into a (dd/mm/yyyy) format
const formatDate = (dateStr: string) => {
    return new Date(dateStr).toLocaleDateString();
}

</script>