<template>
    <div class="product-show">
        <ProductFilter :category="category"></ProductFilter>
        <ProductShowContainer :category="category"></ProductShowContainer>
    </div>
</template>
<script>
import ProductFilter from './ProductFilter.vue';
import ProductShowContainer from './ProductShowContainer.vue';

export default {
    props:[
        'category'
    ],
    components:{
        ProductFilter,
        ProductShowContainer
    }
}
</script>
<style lang="scss">
    .product-show{
        display:flex;
        padding:70px 100px;
    }
    @media screen and (max-width:1024px) and( min-width:769px){
        .product-show{
            padding:40px 80px;
        }
    }
    @media screen and (max-width:768px) and( min-width:426px){
        .product-show{
            padding:40px 30px;
        }
    }
    @media screen and (max-width:425px){
        .product-show{
            padding:20px 10px;
        }
    }
</style>