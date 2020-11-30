<template>
     <div class="product-result-container">
        <div class="title" style="opacity:0.5;width:100%;text-align:center">
                {{total_count}} products found
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
        
    </div>
</template>
<script>
export default {
    props:['products','total_count'],
    methods:{
        seeProduct:function(id){
            window.location.href=config.BASE_URL+'/product/all/'+id;
        }
    }
}
</script>
<style lang="scss">
    .product-result-container{
        padding:80px 100px;

        .products{
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr;
            grid-column-gap:40px;
            grid-row-gap:30px;
            margin:10px 0px;
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
    }
    .pagination{
        justify-content: center;
        margin-bottom:20px;
        .page-item{
            color:orange;
            a{
                color:orange;
            }
        }
        .page-item.active .page-link{
            background:orange;
            border-color:orange;
        }
    }
    @media screen and (max-width:1024px) and( min-width:769px){
        .product-result-container{
            padding:60px 80px;
            .products{
                grid-template-columns: 1fr 1fr 1fr;
            }
        }
    }
     @media screen and (max-width:768px) and( min-width:426px){
         .product-result-container{
             padding:60px 30px;
            .products{
                grid-template-columns: 1fr 1fr 1fr;
                grid-column-gap:20px;
            }
        }
     }
     @media screen and (max-width:425px){
         .product-result-container{
             padding:40px 10px;
             .title{
                 font-size: 10px;
                 padding:0;
                 margin:0;
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
     .pagination{
         .page-item{
             .page-link{
                 font-size: 10px;
             }
         }
     }
</style>