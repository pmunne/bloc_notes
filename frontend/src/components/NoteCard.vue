<template>
    <div class="note-card">
        <h3>{{ note.title }}</h3>
        <p>{{ note.content }}</p>
        <small>{{ formatDate(note.created_at) }}</small>
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

const formatDate = (dateStr: string) => {
    return new Date(dateStr).toLocaleDateString();
}

</script>
<style scoped lang="scss">
small {
    color: $primary_color;
}

</style>