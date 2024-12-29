<script setup>
import { router, useForm, useRemember } from "@inertiajs/vue3";
import TextInput from "./Components/TextInput.vue";
import { route } from "../../../vendor/tightenco/ziggy/src/js";
import { watch } from "vue";

const form = useForm({
    email: "",
    password: "",
});

const submit = () => {
    form.post(route("login.post"), {
        onError: () => form.reset("password"),
    });
};
</script>

<template>
    <div class="h-[calc(100vh-4rem)] flex flex-col items-center justify-center">
        <div>Login</div>
        <form @submit.prevent="submit" class="flex flex-col items-stretch">
            <TextInput
                name="Email"
                v-model="form.email"
                :message="form.errors.email"
                type="email"
            ></TextInput>
            <TextInput
                name="Password"
                v-model="form.password"
                :message="form.errors.password"
                type="password"
            ></TextInput>
            <div>
                <label for="check"> remember me </label>
                <input type="checkbox" id="check" />
            </div>

            <button
                class="border p-2 mt-2 bg-blue-500 text-white"
                :disabled="form.processing"
            >
                Login
            </button>
        </form>
    </div>
</template>
