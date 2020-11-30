<template>
    <div class="women">
        <LeftNavigation activeLink="kid"></LeftNavigation>
        <Header activeLink="kid" :scrollOverTopSection="true"></Header>
        <MoveToTop></MoveToTop>
        <ProductShow category="kid"></ProductShow> 
        <Footer></Footer>
        <CopyRight></CopyRight>
    </div>
</template>
<script>
import LeftNavigation from '../components/LeftNavigation.vue';
import Header from '../components/Header.vue';
import ProductShow from '../components/ProductShow.vue';
import MoveToTop from '../components/MoveToTop.vue';
import Footer from '../components/Footer.vue'
import CopyRight from '../components/CopyRight.vue'


export default {
    components:{
        LeftNavigation,
        Header,
        ProductShow,
        MoveToTop,
        Footer,
        CopyRight,
    }
}
</script>
<style lang="scss" scoped>

</style>