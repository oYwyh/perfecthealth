<script setup></script>
<template>
    <div id="script-placeholder"></div>
</template>
<script>
import postscribe from 'postscribe'
export default {
    mounted() {
        postscribe('#scrpt-placeholder', '<script src="../cdn.js"><\/script>')
    }
}
</script>
