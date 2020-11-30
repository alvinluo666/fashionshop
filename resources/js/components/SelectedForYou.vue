<template>
    <div class="selected-for-you">
        <div class="title">
            <span>Selected just for you</span>
            <span class="btn">Show More</span>
        </div>
        <div class="products" v-if="suggestedProducts.length>0">
            <VueSlickCarousel :arrows="true" v-bind="settings">
                <div class="product" v-for="product in suggestedProducts" :key="product.id" :style="{'backgroundImage':'url('+product.image[0]+')'}">
                    <div class="info">
                        <span>{{product.name}}</span>
                        <h4>$ {{product.price}}</h4>
                    </div>
                </div>
            </VueSlickCarousel>
        </div>
        <div class="products mobile" v-if="suggestedProducts.length>0">
            <VueSlickCarousel :arrows="true" v-bind="mobileSettings">
                <div class="product" v-for="product in suggestedProducts" :key="product.id" :style="{'backgroundImage':'url('+product.image[0]+')'}">
                    <div class="info">
                        <span>{{product.name}}</span>
                        <h4>$ {{product.price}}</h4>
                    </div>
                </div>
            </VueSlickCarousel>
        </div>
    </div>
</template>
<script>
import $ from 'jquery';
import VueSlickCarousel from 'vue-slick-carousel'
import 'vue-slick-carousel/dist/vue-slick-carousel.css'
import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'
import { mapActions, mapState } from 'vuex';


export default {
    components:{
        VueSlickCarousel
    },
    data:function(){
        return {
            settings:{
                    "dots": true,
                    "focusOnSelect": true,
                    "infinite": true,
                    "speed": 500,
                    "slidesToShow": 4,
                    "slidesToScroll": 3,
                    "touchThreshold": 5,
                    "autoplay":true
            },
            mobileSettings:{
                    "dots": true,
                    "focusOnSelect": true,
                    "infinite": true,
                    "speed": 500,
                    "slidesToShow": 1,
                    "slidesToScroll": 1,
                    "touchThreshold": 5,
                    "autoplay":true
            }
        }
    },
    computed:{
        ...mapState([
            'suggestedProducts'
        ])
    },
    methods:{
        ...mapActions([
            'getSuggestedProducts'
        ])
    },
    mounted(){
        this.getSuggestedProducts()
    }
}
</script>
<style lang="scss">
    .selected-for-you{
        padding:0px 100px 100px 100px;
        box-sizing:border-box;
        .title{
            display:flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom:30px;
            span{
                font-size: 20px;
            }
            span.btn{
                font-size: 15px;
                padding:10px 15px;
                border:1px solid rgba($color: #000000, $alpha: 0.5);
                border-radius: 25px;
                font-weight: bold;
                cursor:pointer;
            }
        
        }
        .slick-track{
            overflow:hidden;
            border:none;
        }
        .slick-slide{
           padding:0 9px;
           border:none;
        }
        .products.mobile{
            display:none;
        }
        .products.mobile .product{
            height:300px;
            position: relative;
            border:none;
            .info{
                bottom:0;
                width:100%;
                background:white;
                position:absolute;
                padding:10px 5px;
                span{
                    font-size:10px;
                }
                h4{
                    font-size:15px;
                    padding-top:5px;
                }
            }
        }
        .product{
            height:400px;
            position: relative;
            border:none;
            .info{
                bottom:0;
                width:100%;
                background:white;
                position:absolute;
                padding:10px 5px;
                span{
                    font-size:15px;
                }
                h4{
                    font-size:20px;
                    padding-top:5px;
                }
            }
        }
    
    }
    @media screen and (max-width:425px){
        .selected-for-you{
            padding:10px 10px 30px 10px;
            .title{
                margin-bottom:10px;
                span{
                    font-size:12px;
                }
                span.btn{
                    font-size:10px;
                    padding:5px 10px;
                }
            }
            .products{
                display:none;
            }

            .slick-track{
                overflow:hidden;
                border:none;
            }
            .slick-slide{
                padding:0 0px;
                border:none;
            }
            .products.mobile{
                display:inline;
            }
            .products.mobile .product{
                display:inline;
                height:200px;
                .info{
                    width:50%;
                    left:50%;
                    transform:translateX(-50%);
                    display:flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                    border-radius:25px 25px 0 0;
                    height:50px;
                    span{
                        font-size:10px;
                    }
                    h4{
                        font-size:15px;
                        padding-top:5px;
                    }
                }
            }
        }
    }
    @media screen and (max-width:768px) and( min-width:426px){
        .selected-for-you{
            padding:30px 30px;
            .product{
                height:300px;
                .info{
                    span{
                        font-size:12px;

                    }
                    h4{
                        font-size:15px;
                        padding-top:5px;
                    }
                }
            }
        }
        
    }
     @media screen and (max-width:1024px) and( min-width:769px){
         .selected-for-you{
             padding:20px 80px 50px 80px;
              .product{
                .info{
                    span{
                        font-size:13px;
                    }
                    h4{
                        font-size:17px;
                    }
                }
            }
         }
     }
</style>