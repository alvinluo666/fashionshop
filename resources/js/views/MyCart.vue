<template>
    <div class="my-cart">
        <LeftNavigation activeLink="me    n"></LeftNavigation>
        <Header :scrollOverTopSection="true"></Header>
        <Cart></Cart>
    </div>
</template>
<script>
import LeftNavigation from '../components/LeftNavigation.vue';
import Header from '../components/Header.vue';
import Cart from '../components/Cart.vue';

export default {
    components:{
        LeftNavigation,
        Header,
        Cart
    }
}
</script>
<style lang="scss" scoped>

</style>