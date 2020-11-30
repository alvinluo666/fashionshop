<template>
    <div class="product-description">
        <div class="tab">
            <div :class="['description ',activeTab=='Description'?'active':'']" @click="activeTab='Description'">
                <span>Description</span>
            </div>
            <div :class="['review ',activeTab=='Review'?'active':'']" @click="activeTab='Review'">
                <span>Review ({{product?product.reviews.length:'0'}})</span>
            </div>
        </div>
        <component :is="activeTab" :product="product"></component>
    </div>
</template>
<script>
import Description from './Description.vue';
import Review from './Review.vue';
export default {
    data:function(){
        return {
            activeTab:'Description'
        }
    },
    props:[
        'product'
    ],
    components:{
        Description,
        Review
    }
}
</script>
<style lang="scss" scoped>
    .product-description{
        display:flex;
        flex-direction:column;
        align-items: center;
        width:100%;
        .tab{
            display:flex;
            align-items: center;
            margin-bottom:30px;
            .description,.review{
                margin:0px 25px;
                padding:10px 25px;
                display:flex;
                align-items: center;
                justify-content:center;
                opacity:0.5;
                cursor: pointer;
                transition: 0.3s border;
            }
            .description.active,.review.active{
                border:1px solid orange;
                color:black;
                font-weight:bold;
                opacity:1;
                border-radius:25px;
            }
        }
    }
     @media screen and (max-width:425px){
         .product-description{
             .tab{
                 margin-bottom:10px;
                 .description,.review{
                     padding:8px 15px;
                     span{
                         font-size: 11px;
                     }
                 }
             }
         }
     }
</style>