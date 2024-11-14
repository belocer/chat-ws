<script setup lang="ts">

import {ref} from "vue";
import {Head} from "@inertiajs/vue3";
import main from '@/Layouts/Main.vue'

defineOptions({
    layout: main
})

const props = defineProps<{
    title?: String,
    users?: Array,
}>()

const users = ref(props.users)

const format = (date) => {
    let formatDate = new Date(date)
    const day = formatDate.getDate();
    const month = formatDate.getMonth() + 1;
    const year = formatDate.getFullYear();

    return `${day}.${month}.${year}`;
}

</script>

<template>
    <Head :title="title"/>
    <div>
        <div class="flex gap-2">
            <div class="w-1/2 border border-gray-600 rounded rounded-1xl p-2">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita harum impedit minima nisi omnis qui
                quisquam repellendus sit vitae voluptatum.
            </div>
            <div class="w-1/2 border border-gray-400 rounded rounded-1xl p-2">
                <h3 class="font-semibold text-center mb-5 text-purple-600 text-xl">{{ title }}</h3>
                <div v-if="users">
                    <ul v-for="user in users" :key="user.id" class="flex" role="list">
                        <li class="row-user">
                            # id: <span class="text-base font-thin mr-3 ml-1">{{ user.id }}</span>
                            Name: <span class="text-base font-thin ml-1">{{ user.name }}</span>
                            <span class="pulse-circle">
                                <span class="relative flex h-3 w-3">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-sky-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-sky-500"></span>
                                </span>
                            </span>
                        </li>
                    </ul>
                </div>
                <div v-else class="text-center font-bold text-xl">
                    Пользователей пока нет
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped lang="less">
@import "@_/app";

.pulse-circle {
    position: absolute;
    top: -6px;
    right: -6px;
}

.row-user {
    user-select: none;
@apply bg-white relative hover:bg-blue-100 shadow drop-shadow-md shadow-blue-500/50 text-xs font-bold border border-b-blue-300 px-2 py-1 mb-3 rounded-t cursor-pointer transition-all duration-300 active:cursor-wait;
}

</style>
