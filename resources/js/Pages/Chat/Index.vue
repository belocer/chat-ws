<script setup lang="ts">

import {ref} from "vue";
import {Head, Link} from "@inertiajs/vue3";
import main from '@/Layouts/Main.vue'
import {reactive} from 'vue'
import {router} from '@inertiajs/vue3'

defineOptions({
    layout: main
})

const props = defineProps<{
    title?: String,
    chatTitle?: String,
    users?: Array,
    chats?: Array,
    isGroup: Boolean,
    userIds: Array,
}>()


const users = ref(props.users)
let isGroup = ref(false)
let userIds = ref([])
let chatTitle = ref('')

const store = (id) => {
    router.post('/chats', {
        users: [id],
        title: null
    })
}

const storeGroup = () => {
    if (userIds.value.length < 2) return

    isGroup.value = false
    router.post('/chats', {
        users: userIds.value,
        title: chatTitle.value
    })
}

const toggleUsers = (id) => {
    let index = userIds.value.indexOf(id)
    if (index === -1) {
        userIds.value.push(id)
    } else {
        userIds.value.splice(index, 1)
    }
}

const refreshUserIds = () => {
    userIds.value = []
    isGroup.value = false
}

</script>

<template>
    <Head :title="title"/>
    <div>
        <div class="flex gap-2 items-start">
            <div class="w-1/3 p-4 bg-white border border-gray-200 rounded">
                <h3 class="font-semibold text-center mb-5 text-purple-600 text-xl">Чаты</h3>
                <div v-if="chats">
                    <ul role="list">
                        <li v-for="chat in chats" :key="chat.id" class="row-chat">
                            <Link :href="route('chats.show', chat.id)" class="flex link-chat">
                                <div class="mr-2">{{ chat.id }}</div>
                                <div>{{ chat.title ?? 'Your chat' }}</div>
                                <span class="pulse-circle">
                                    <span class="relative flex h-3 w-3">
                                        <span
                                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-sky-500 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-3 w-3 bg-sky-600"></span>
                                    </span>
                                </span>
                            </Link>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="w-2/3 p-4 bg-white border border-gray-200 rounded">
                <div class="mb-5 flex items-center justify-between gap-2">
                    <h3 class="font-semibold text-center text-purple-600 text-sm">Пользователи</h3>
                    <a href="#" class="inline-block bg-indigo-600 text-white text-xs px-3 py-2 rounded-lg"
                       @click.prevent="isGroup = true"
                       v-if="!isGroup">
                        Создать группу
                    </a>
                    <div v-if="isGroup" class="flex items-center flex-wrap">
                        <input type="text" placeholder="group title" v-model="chatTitle"
                               class="h-8 border border-gray-300 rounded-full mx-2 text-xs">
                        <a href="#"
                           :class="['inline-block  text-white text-xs px-3 py-2 rounded-lg mr-2',
                           userIds.length > 1 ? 'bg-green-500' : 'bg-green-200']"
                           @click.prevent="storeGroup">
                            Написать
                        </a>
                        <a href="#" class="inline-block bg-indigo-600 text-white text-xs px-3 py-2 rounded-lg"
                           @click.prevent="refreshUserIds">
                            &times;
                        </a>
                    </div>
                </div>
                <div v-if="users">
                    <ul role="list">
                        <li class="row-user" v-for="user in users" :key="user.id">
                            <div class="wrap-inp-checkbox" v-if="isGroup">
                                <input type="checkbox" id="select-user" @click="toggleUsers(user.id)">
                            </div>

                            <div class="data-user">
                                #<span class="text-base font-thin mr-3 ml-1">{{ user.id }}</span>
                                Name: <span class="text-base font-thin ml-1">{{ user.name }}</span>
                                <button type="button" @click="store(user.id)"
                                        class="hover:bg-sky-600 ml-auto bg-sky-300 rounded p-2 text-white uppercase font-thin">
                                    Написать
                                </button>
                            </div>

                            <span class="pulse-circle">
                                <span class="relative flex h-3 w-3">
                                    <span
                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-sky-500 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-sky-600"></span>
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
@apply flex items-center w-full bg-white relative hover:bg-blue-100 shadow drop-shadow-md shadow-blue-500/50 text-xs font-bold border border-b-sky-100 px-2 py-1 mb-3 rounded-t cursor-pointer transition-all duration-300 active:cursor-wait;

    .data-user {
    @apply flex items-center w-full;
    }
}

.row-chat {
@apply flex items-center w-full bg-white relative hover:bg-blue-100 shadow drop-shadow-md shadow-blue-500/50 text-xs font-bold border border-b-sky-100 px-2 py-1 mb-3 rounded-t cursor-pointer transition-all duration-300 active:cursor-wait;
}

.link-chat {
    display: flex;
    min-width: 100%;
    min-height: 100%;
}

.wrap-inp-checkbox {
    padding: 5px;
    margin-right: 5px;

    input {
        height: 12px;
        width: 12px;
        border-radius: 4px;
        border-color: #9ca3af;
    }
}

</style>
