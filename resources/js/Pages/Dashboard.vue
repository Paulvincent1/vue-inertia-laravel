<script setup></script>

<template>
    <div class="container px-[0.5rem] mx-auto">
        <p
            v-if="$page.props.flash.message"
            class="bg-green-400 p-3 text-center"
        >
            {{ $page.props.flash.message }}
        </p>
        <h1 class="font-bold text-[2rem] text-center text-purple-900">
            Welcome
            {{ $page.props.auth.user.name }}
        </h1>
    </div>
</template>
