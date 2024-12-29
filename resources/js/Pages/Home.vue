<script setup>
import { router, usePage } from "@inertiajs/vue3";
import dayjs from "dayjs";
import { computed, ref, watch } from "vue";
import PaginationLinks from "./Components/PaginationLinks.vue";
import { throttle } from "lodash";
import { debounce } from "lodash";

let props = defineProps({
    users: Object,
    searchTerm: String,
});

let search = ref(props.searchTerm);
let id;
watch(
    search,
    debounce((q) => {
        router.get(
            "/",
            {
                search: q,
            },
            {
                preserveState: true,
            }
        );
    }, 1000)
);

let getDate = (date) => {
    return dayjs(date).format("MMMM D, YYYY");
};

console.log(dayjs("2018-08-08").format("MMMM D, YYYY")); // parse
</script>

<template>
    <div class="container mx-auto px-[0.5rem]">
        <Head title="| Home" />
        <div class="flex justify-end items-center mt-4">
            <input
                class="border p-2"
                type="search"
                placeholder="Search"
                v-model="search"
            />
        </div>

        <table class="w-full mt-8 shadow">
            <thead>
                <tr class="bg-slate-400">
                    <th class="text-start px-8 py-2">Avatar</th>
                    <th class="text-start px-8 py-2">Name</th>
                    <th class="text-start px-8 py-2">Email</th>
                    <th class="text-start px-8 py-2">Registration Date</th>
                    <th class="text-start px-8 py-2">Delete</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users.data" :key="user.id">
                    <td class="px-8 py-2">
                        <img
                            class="h-10 w-10 object-cover"
                            :src="
                                user.avatar
                                    ? 'storage/' + user.avatar
                                    : 'storage/avatars/default.jpg'
                            "
                            alt=""
                        />
                    </td>
                    <td class="px-8 py-2">{{ user.name }}</td>
                    <td class="px-8 py-2">{{ user.email }}</td>
                    <td class="px-8 py-2">{{ getDate(user.created_at) }}</td>
                    <td class="px-8 py-2 text-red-500">Delete</td>
                </tr>
            </tbody>
        </table>
        <!-- link -->
        <div>
            <PaginationLinks :users="users" />
        </div>
    </div>
</template>
