<script setup lang="ts">

import {ref} from "vue";
import {Head} from "@inertiajs/vue3";
import main from '@/Layouts/Main.vue'
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

defineOptions({
    layout: main
})

const props = defineProps<{
    title?: String,
    chat?: Array,
}>()

const chat = ref(props.chat)

const store = (id) => {
    router.post('/chats', {
        users: [id],
        title: null
    })
}

</script>

<template>
    <Head :title="title"/>
    <div>
        <div class="flex gap-2">
            <div class="w-3/4 p-4 bg-white border border-gray-200 rounded">

            </div>
            <div class="w-1/4 p-4 bg-white border border-gray-200 rounded">

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
