<script setup>
const model = defineModel({
    type: String,
    required: true,
});

defineProps({
    name: { type: String, required: true },
    type: { type: String, default: "text" },
    message: { type: String },
});
</script>
<template>
    <div>
        <label for="">{{ name }}</label> <br />
        <input
            :class="{
                'border border-gray-400 py-1 px-2 ': true,
                'border-red-300': message,
            }"
            :type="type"
            v-model="model"
        />
    </div>
    <small class="text-red-500">{{ message }}</small>
</template>
