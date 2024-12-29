<script setup>
import { useForm, router } from "@inertiajs/vue3";
import TextInput from "./Components/TextInput.vue";
import { onMounted } from "vue";

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
    avatar: null,
    preview: null,
});

onMounted(() => {
    console.log(router.remember("login"));
});

const submit = () => {
    form.post("/register", {
        onError: () => form.reset("password", "password_confirmation"),
    });
};

const change = (e) => {
    form.avatar = e.target.files[0];
    form.preview = URL.createObjectURL(e.target.files[0]);
};
</script>

<template>
    <div class="h-[calc(100vh-4rem)] flex flex-col items-center justify-center">
        <div>Register</div>
        <form
            @submit.prevent="submit"
            action=""
            class="flex flex-col items-stretch"
        >
            <label
                for="avatar"
                class="h-[100px] w-[100px] bg-slate-300 relative rounded-[1000px]"
            >
                <p class="absolute bottom-0 left-[50%] translate-x-[-50%] mb-2">
                    Avatar
                </p>

                <input hidden type="file" id="avatar" @input="change" />
                <img
                    class="w-[100%] h-[100%] object-cover rounded-[1000px]"
                    :src="form.preview ?? 'storage/avatars/default.jpg'"
                    alt=""
                />
            </label>
            <TextInput
                name="Name"
                v-model="form.name"
                :message="form.errors.name"
            ></TextInput>
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
            <TextInput
                name="Confirm Password"
                v-model="form.password_confirmation"
                :message="form.errors.password_confirmation"
                type="password"
            ></TextInput>

            <button
                class="border p-2 mt-2 bg-blue-500 text-white"
                :disabled="form.processing"
            >
                Register
            </button>
        </form>
    </div>
</template>

<style scoped></style>
