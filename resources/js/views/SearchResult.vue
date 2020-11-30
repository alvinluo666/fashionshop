<template>
    <div>
        <Header :scrollOverTopSection="true"></Header>
        <LeftNavigation></LeftNavigation>
        <SearchProduct :products="json_products" :total_count="total_count"></SearchProduct>
        

        
    </div>
</template>
<script>
import SearchProduct from '../components/SearchProduct.vue';
import Footer from '../components/Footer.vue'
import CopyRight from '../components/CopyRight.vue'
import Header from '../components/Header.vue'
import LeftNavigation from '../components/LeftNavigation.vue'

export default {
    props:['products'],
    data:function(){
        return {
            json_products:JSON.parse(this.products).data,
            total_count:JSON.parse(this.products).total
        }
    },
    mounted(){
        console.log(JSON.parse(this.products));
    },
    components:{
        SearchProduct,
        Footer,
        CopyRight,
        Footer,
        Header,
        LeftNavigation,
    }
}
</script>
<style lang="scss" scoped>

</style>