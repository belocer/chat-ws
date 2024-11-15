<script setup lang="ts">

import {ref, computed} from "vue";
import {Head, usePage} from "@inertiajs/vue3";
import main from '@/Layouts/Main.vue'
import axios from 'axios'

defineOptions({
    layout: main
})

const props = defineProps<{
    title?: String,
    chat?: Array,
    users?: Array,
    messages?: Array,
}>()

const page = usePage()
const chat = ref(props.chat)
const body = ref('')
const users = ref(props.users)
const messages = ref(props.messages)

const userIds = computed(() => {
    return users.value.map(user => {
        return user.id
    }).filter(userId => {
        return userId != page.props.auth.user.id
    })
})

const store = async () => {
    await axios.post('/messages', {
        chat_id: chat.value.id,
        body: body.value,
        user_ids: userIds.value
    })
        .then( res => {
            messages.value.push(res.data)
        })
}

</script>

<template>
    <Head :title="title"/>
    <div>
        <div class="flex gap-2 items-start">
            <div class="w-3/4 p-4 bg-white border border-gray-200 rounded">
                <h3 class="font-semibold text-center mb-5 text-purple-600 text-xl">{{ chat.title ?? 'Your chat' }}</h3>
                <div class="mb-4">
                    <div v-if="messages">
                        <ul role="list" class="messages__list">
                            <li :class="['messages__item', message.is_owner ? 'bg-green-300 ml-auto' : 'bg-sky-200']"
                                v-for="message in messages" :key="message.id">
                                <div class="font-thin mr-3 ml-1 text-xs">{{ message.user_name }}</div>
                                <div class="text-base font-thin my-3">{{ message.body }}</div>
                                <div class="font-thin w-full text-xs italic text-slate-500 mt-auto">{{ message.time }}</div>
                                <div class="font-thin w-full text-xs italic text-slate-500 mt-auto">{{ message.is_owner }}</div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div>
                    <h3 class="font-semibold text-center mb-5 text-purple-600 text-xl">Отправка сообщений</h3>
                    <div>
                        <div class="mb-5">
                            <input type="text" v-model="body" class="rounded-full border border-gray-300"
                                   placeholder="Сообщение">
                        </div>
                        <div>
                            <a @click.prevent="store" href="#"
                               class="hover:bg-indigo-600 ml-auto bg-indigo-400 rounded px-3 py-2 text-white uppercase font-thin text-sm">send</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-1/4 p-4 bg-white border border-gray-200 rounded">
                <h3 class="font-semibold text-center mb-5 text-purple-600 text-xl">Чатятся:</h3>
                <div v-if="users">
                    <ul role="list">
                        <li class="row-user" v-for="user in users" :key="user.id">
                            # id: <span class="text-base font-thin mr-3 ml-1">{{ user.id }}</span>
                            Имя: <span class="text-base font-thin ml-1">{{ user.name }}</span>
                        </li>
                    </ul>
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

.messages__list {
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
    min-width: 100%;

    .messages__item {
        padding: 10px;
        margin-bottom: 15px;
        display: flex;
        flex-direction: column;
        border: 1px solid #f1f1f1;
        border-radius: 4px;
        max-width: 80%;
        width: fit-content;
    }
}

</style>
