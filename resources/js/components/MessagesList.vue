<template>
    <ul class="messages-list">
        <li
            v-for="(item, index) in items"
            :key="index"
            :class="{ 'messages-list__item--success':isSuccess }"
        >{{item}}</li>
    </ul>
</template>

<script>
export default {
    name: 'MessagesList',
    props: {
        items: Array,
        isSuccess: false,
    }
}
</script>