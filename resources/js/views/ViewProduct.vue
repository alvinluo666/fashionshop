<template>
    <div class="view-product">
        <LeftNavigation></LeftNavigation>
        <Header :activeLink="category" :scrollOverTopSection="true"></Header>
        <ProductDetail @setProduct="setProduct" :id="id" :category="category"></ProductDetail>
        <ProductDescription :product="product"></ProductDescription>
        <SelectedForYou></SelectedForYou>
        <Footer></Footer>
        <CopyRight></CopyRight>

    </div>
</template>
<script>
import ProductDetail from '../components/ProductDetail.vue';
import Header from '../components/Header.vue';
import ProductDescription from '../components/ProductDescription';
import SelectedForYou from '../components/SelectedForYou.vue';
import Footer from '../components/Footer.vue'
import CopyRight from '../components/CopyRight.vue'
import LeftNavigation from '../components/LeftNavigation.vue'


export default {
    props:[
        'id',
        'category',
    ],
    data:function(){
        return {
            product:''
        }
    },
    components:{
        ProductDetail,
        Header,
        ProductDescription,
        Footer,
        CopyRight,
        SelectedForYou,
        LeftNavigation
    },
    methods:{
        setProduct(data){
            this.product=data;
        }
    },
    mounted(){
        
    }
}
</script>
<style lang="scss">

</style>