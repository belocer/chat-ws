<script setup lang="ts">
import {Link} from '@inertiajs/vue3'

</script>

<template>
    <div class="w-3/4 p-4 mx-auto">
        <div>
            <div>
                <Link :href="route('dashboard')">
                    Dashboard
                </Link>
                |
                <Link :href="route('chats.index')">
                    Chats
                </Link>
            </div>
        </div>
        <slot />
    </div>
</template>

<style scoped>

</style>
