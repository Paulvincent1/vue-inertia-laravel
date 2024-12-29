<script setup>
defineProps({
    users: Object,
});
</script>
<template>
    <component
        :is="link.url ? 'Link' : 'span'"
        v-for="link in users.links"
        :key="link.label"
        :href="link.url"
        v-html="link.label"
        :class="[
            'p-2',
            {
                'text-blue-500': link.active,
                ' text-slate-500': !link.active,
            },
        ]"
    ></component>

    <p>
        Showing {{ users.from }} to {{ users.to }} of {{ users.total }} results
    </p>
</template>
