<template>
    <div class="register">
        <LeftNavigation></LeftNavigation>
        <Header :scrollOverTopSection="true"></Header>       
    </div>
</template>
<script>
import LeftNavigation from '../components/LeftNavigation.vue';
import Header from '../components/Header.vue';
export default {
    components:{
        LeftNavigation,
        Header
    }
}
</script>
<style lang="scss" scoped>

</style>