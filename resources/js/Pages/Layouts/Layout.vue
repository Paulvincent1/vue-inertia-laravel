<template>
    <div class="h-screen">
        <header class="h-[4rem] bg-slate-500 shadow-sm">
            <div
                class="container xl:max-w-[1280px] px-[0.5rem] h-[100%] mx-auto flex items-center justify-between"
            >
                <div class="text-white">logo</div>
                <nav
                    :class="[
                        'fixed top-[4rem] right-0 pb-7 md:pb-0 md:h-auto flex flex-col bg-slate-500 w-full md:translate-x-0 md:items-end md:w-full md:static md:bg-transparent transition-all',
                        isActive ? 'translate-x-0' : 'translate-x-[100%]',
                    ]"
                >
                    <ul
                        class="flex flex-col justify-center items-center md:flex-row gap-10 text-white"
                    >
                        <li>
                            <Link
                                :class="{
                                    'bg-slate-700 p-2 rounded-lg':
                                        $page.component === 'Home',
                                }"
                                :href="route('home')"
                                @click="isActive = !isActive"
                                >Home</Link
                            >
                        </li>
                        <li v-if="!$page.props.auth.user">
                            <Link
                                :class="{
                                    'bg-slate-700 p-2 rounded-lg':
                                        $page.component === 'Register',
                                }"
                                :href="route('register')"
                                @click="isActive = !isActive"
                                >Register</Link
                            >
                        </li>
                        <li v-if="!$page.props.auth.user">
                            <Link
                                :class="{
                                    'bg-slate-700 p-2 rounded-lg':
                                        $page.component === 'Login',
                                }"
                                :href="route('login')"
                                @click="isActive = !isActive"
                                >Login</Link
                            >
                        </li>
                        <li v-if="$page.props.auth.user">
                            <Link
                                :class="{
                                    'bg-slate-700 p-2 rounded-lg':
                                        $page.component === 'Dashboard',
                                }"
                                :href="route('dashboard')"
                                @click="isActive = !isActive"
                                >Dashboard</Link
                            >
                        </li>
                        <li v-if="$page.props.auth.user">
                            <Link
                                :href="route('logout')"
                                as="button"
                                method="post"
                                @click="isActive = !isActive"
                                >Logout</Link
                            >
                        </li>
                    </ul>
                </nav>
                <button class="md:hidden" @click="isActive = !isActive">
                    <i
                        :class="[
                            'bi  text-2xl text-white',
                            isActive ? 'bi-x-lg' : 'bi-list',
                        ]"
                    ></i>
                </button>
            </div>
        </header>

        <main class="h-[calc(100%-4rem)]">
            <slot></slot>
        </main>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { route } from "../../../../vendor/tightenco/ziggy/src/js";

let isActive = ref(false);
</script>
