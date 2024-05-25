<template>
    <div>
        {{ 'Hello world' }}
    </div>
</template>

<script setup>
import {onMounted} from 'vue';

onMounted(()=>{
    console.log('mounted');
})
</script>

<style lang="scss" scoped>

</style>