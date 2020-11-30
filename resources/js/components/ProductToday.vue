<template>
    <div class="product-today">
        <span class="title">Products in today</span>
        <div class="products" v-if="productToday.length>0">
            <VueSlickCarousel :arrows="true" v-bind="settings">
                <div class="product" v-for="product in productToday" :key="product.id" :style="{'backgroundImage':'url('+product.image+')'}">
                    <div class="info">
                        <span>{{product.name}}</span>
                        <h4>$ {{product.price}}</h4>
                    </div>
                </div>
            </VueSlickCarousel>
        </div>
        <div class="products mobile" v-if="productToday.length>0">
            <VueSlickCarousel :arrows="true" v-bind="mobileSettings">
                <div class="product" v-for="product in productToday" :key="product.id" :style="{'backgroundImage':'url('+product.image+')'}">
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
import { mapActions, mapState } from 'vuex'
import VueSlickCarousel from 'vue-slick-carousel'
import 'vue-slick-carousel/dist/vue-slick-carousel.css'
import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'
export default {
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
    components:{
        VueSlickCarousel
    },
    computed:{
        ...mapState([
            'productToday'
        ])
    },
    methods:{
        ...mapActions([
            'getProductToday'
        ])
    },
    mounted(){
        this.getProductToday();
    }
}
</script>
<style lang="scss">
    .product-today{
        padding:0px 100px;
        span.title{
            font-size:20px;
            display:block;
            width:100%;
            text-align:center;
            padding:100px 0px 50px 0px
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
        .product-today{
            padding:10px 10px 40px 10px;
            span.title{
                font-size:20px;
                display:block;
                width:100%;
                text-align:center;
                padding:20px 0px 20px 0px
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
                    right:0;
                    display:flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                    border-radius:25px 0px 0 0;
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
        .product-today{
            padding:30px 30px;
            span.title{
                 padding:10px 0px 20px 0px;
             }
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
         .product-today{
             padding:0px 80px 50px 80px;
             span.title{
                 padding:10px 0px 20px 0px;
             }
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