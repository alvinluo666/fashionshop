<template>
    <div class="product-show-container">
        <div class="title">
            <p>Men's Tops <span>(133)</span></p>
        </div>
        <div class="products" >
            <div class="product" v-for="product in products" :key="product.id" @click="seeProduct(product.id)">
                <img :src="product.image[0]" alt="">
                <div class="detail">
                    <span class="name">{{product.name}}</span>
                    <span class="price">$ {{product.price}}</span>
                </div>
            </div>        
            
        </div>
        <div :class="['loading',loadingProduct?'active':'']">
            <a-spin />
            <div style="width:10px"></div>
            <a-spin />
            <div style="width:10px"></div>
            <a-spin />
        </div>
        <div :class="['last-page',lastProductReach?'active':'']">
            <span>No more product available</span>
        </div>
    </div>
</template>
<script>
import { mapState } from 'vuex'
export default {
    props:[
        'category'
    ],
    computed:{
        ...mapState([
            'products',
            'loadingProduct',
            'lastProductReach'
        ])
    },
    methods:{
        seeProduct:function(id){
            window.location.href=config.BASE_URL+'/product/'+this.category+'/'+id;
        }
    }
}
</script>
<style lang="scss" scoped>
    .product-show-container{
        flex:3;
        height:100%;
        // padding-left:30px;
        .title{
            p{
                font-size: 20px;
                span{
                    font-size: 15px;
                    color:grey;
                }
            }
        }
        .products{
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr;
            grid-column-gap:40px;
            grid-row-gap:30px;
            margin:20px 0px;
            .product{
                cursor: pointer;
                transition: 0.3s all;
                img{
                    width:100%;
                    height:300px;
                    border-radius:12px;
                }
                .detail{
                    .name{
                        font-size:13px;
                        display:block;
                        padding:10px 2px 5px 2px;
                    }
                    .price{
                        font-size: 16px;
                        display:block;
                        font-weight: bold;
                    }
                }
                &:hover{
                    transform: scale(1.1,1.1);
                }
            }
        }
        .loading{
            width:100%;
            text-align: center;
            i{
                background-color:orange;
            }
            display:none;
        }
        .loading.active{
            display:flex;
            justify-content: center;
        }
        .last-page{
            display:none;
        }
        .last-page.active{
            display:flex;
            justify-content: center;
        }

    }
    @media screen and (max-width:1024px) and( min-width:769px){
        .product-show-container{
            .title{
                .p{
                    font-size:18px;
                }
            }
            .products{
                grid-template-columns: 1fr 1fr 1fr;
            }
        }
    }
    @media screen and (max-width:768px) and( min-width:426px){
        .product-show-container{
            .title{
                .p{
                    font-size:14px;
                }
            }
            .products{
                grid-template-columns: 1fr 1fr 1fr;
                grid-column-gap:20px;
            }
        }
    }
     @media screen and (max-width:425px){
         .product-show-container{
            .title{
                .p{
                    font-size:12px;
                    margin-bottom:0px;
                    span{
                        font-size: 12px;
                    }
                }
            }
            .products{
                grid-template-columns: 1fr 1fr;
                grid-column-gap:10px;
                grid-row-gap:15px;
                margin:10px 0px;
                .product{
                    img{
                        height:200px;
                    }
                    .detail{
                        .name{
                            font-size:10px;
                            padding:5px 2px 0px 2px;
                            
                        }
                        .price{
                            font-size:12px;
                        }
                    }
                    &:hover{
                        transform: scale(1,1);
                    }
                }
            }
        }
     }
</style>