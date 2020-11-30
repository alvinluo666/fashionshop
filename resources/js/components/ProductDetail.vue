<template>
    <div class="product-detail">
        <div class="image-show">
            <div class="small-image">
                <img v-for="image in product.image" :key="image" :src="image" alt="" @click="currentShowImage=image" :class="[currentShowImage==image?'active':'']">
            </div>
            <div class="large-image">
                <img :src="currentShowImage" alt="">
            </div>
        </div>
        <div class="detail">
            <span class="title">{{product.name}}</span>
            <span class="price">$ {{product.price}}</span>
            <div class="choose-colors">
                <span class="title">Color :</span>
                <div class="colors">
                    <div :class="['color',selectedColor==color?'active':'']" v-for="color in product.color" :key="color" @click="selectedColor=color">
                        <div class="box" :style="{background:color}"></div>
                    </div>
                </div>
            </div>
            <div class="choose-sizes">
                <span class="titel">Size :</span>
                <div class="sizes">
                    <div :class="['size',selectedSize==size?'active':'']" v-for="size in product.size" :key="size" @click="selectedSize=size">{{size}}</div>
                </div>
            </div>
            <div class="quantity">
                <span class="quantity">Quantity :</span>
                <div class="control">
                    <div class="decrease" @click="decreaseQuantity">
                        <i class="fas fa-minus"></i>
                    </div>
                    <div class="amount">{{selectedQuantity}}</div>
                    <div class="increase" @click="increaseQuantity">
                        <i class="fas fa-plus"></i>
                    </div>
                </div>
            </div>
            <div class="add-to-cart" @click="addToCart">
                <span>Add To Cart</span>
            </div>
        </div>
    </div>
</template>
<script>
import { mapMutations,mapActions, mapState } from 'vuex';
export default {
    props:[
        'id',
        'category'
    ],
    data:function(){
        return {
            currentShowImage:'',
            product:'',
            selectedQuantity:1,
            selectedSize:'',
            selectedColor:''
        }
    },
    computed:{
        ...mapState(['user'])
    },
    methods:{
        ...mapActions([
            'getShoppingCart'//reset cart to state
        ]),
        fetchProductData:function(id,category){
            fetch(config.BASE_URL+'/api/'+category+'/'+id,{
                headers:{
                    authtoken:document.head.querySelector('meta[name="csrf-token]"')
                }
            })
            .then(response=>response.json())
            .then(data=>{
                this.product=data;
                this.$emit('setProduct',data);
                this.currentShowImage=data.image[0];
                this.selectedSize=data.size[0];
                this.selectedColor=data.color[0];
            });
        },
        decreaseQuantity:function(){
            if(this.selectedQuantity>1){
                this.selectedQuantity-=1;
            }
        },
        increaseQuantity:function(){
            this.selectedQuantity+=1;
        },
        
        addToCart:function(){          
           if(this.user){
                fetch(config.BASE_URL+'/api/cart',{
                    headers:{
                        authtoken:document.head.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'X-CSRF-TOKEN':document.head.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type':'application/json'
                    },
                    body:JSON.stringify({
                        user_id:this.user.id,
                        product_id:this.product.id,
                        quantity:this.selectedQuantity,
                        color:this.selectedColor,
                        size:this.selectedSize,
                    }),
                    method:'POST'
                })
                .then(response=>{
                    this.getShoppingCart();
                })
           }else{
               window.location.href=config.BASE_URL+'/login';
           }
        }

    },
    async mounted(){       
        // this.currentShowImage=this.product.image[0];
        await this.fetchProductData(this.id,this.category);  
        
    }
}
</script>
<style lang="scss" scoped>
    .product-detail{
        display:flex;
        padding:100px;
        .image-show{
            flex:1;
            display: flex;
            height:300px;
            .small-image{
                flex:1;
                display:grid;
                // flex-direction:column;
                // justify-content:space-between;
                grid-template-columns: 1fr;
                grid-row-gap:20px;
                cursor:pointer;
                img{
                    width:100%;
                    height:100%;
              
                    border:2px solid transparent;
                    object-fit:cover;
                }
                img.active{
                    border:2px solid orange;
                }
            
            }
          
            .large-image{
                flex: 3;

                padding:0px 20px;
                img{
                    width:100%;
                    height:100%;
                    object-fit:cover;
                }
            }
        }
        .detail{
            flex:1;
            padding:10px 30px 0px 30px; 
            display: flex;
            flex-direction:column;
            height:300px;
    
            .title{
                font-size:25px;
                padding:0;
            }
            .price{
                font-size:25px;
                color:red;
                font-weight: bold;
            }
            .choose-colors{
                display:flex;
                margin-top:10px;
                align-items: center;
                .title{
                    font-size:15px;
                }
                .colors{
                    display:flex;
                    margin:0px 20px;
                    .color{
                        width:30px;
                        height:30px;
                        display:flex;
                        align-items: center;
                        justify-content: center;
                        border:1px solid rgb(218, 218, 218);
                        margin:0px 5px;
                        cursor:pointer;
                        .box{
                            width:60%;
                            height: 60%;
                        }
                    }
                    .color.active{
                        border:1px solid orange;
                    }
                }
            }
            .choose-sizes{
                display:flex;
                align-items: center;
                .title{
                    font-size: 15px;
                }
                .sizes{
                    display:flex;
                    margin:10px 20px;
                    .size{
                        width:30px;
                        height:30px;
                        display:flex;
                        align-items: center;
                        justify-content: center;
                        border:1px solid rgb(218, 218, 218);
                        margin:0px 5px;
                        color:black;
                        cursor:pointer;
                    }
                    .size.active{
                        border:1px solid orange;
                        
                    }
                }
            }
            .quantity{
                display:flex;
                align-items: center;
                .control{
                    display:flex;
                    align-items: center;
                    border:1px solid rgb(218, 218, 218);
                    width:100px;
                    justify-content: space-around;
                    height:40px;
                    margin:10px 20px;
                    .amount{
                        color:black;
                    }
                    .decrease,.increase{
                        cursor:pointer
                    }
                }
            }
            .add-to-cart{
                width:150px;
                height:50px;
                display:flex;
                justify-content: center;
                align-items: center;
                background:orange;
                margin-left:50%;
                margin-top:20px;
                cursor:pointer;
                span{
                    color:black;
                    font-weight:bold;
                }
                &:hover{
                    background:rgb(255, 175, 25);
                }
            }
        }
    }
    @media screen and (max-width:1024px) and( min-width:769px){
        .product-detail{
            padding:100px 80px 50px 80px; 
        }
    }
    @media screen and (max-width:768px) and( min-width:426px){
        .product-detail{
            padding:70px 30px;
            .image-show{
                .small-image{
                    grid-row-gap:10px;
                }
                .large-image{
                    padding:0px 10px;
                }
            }
        }
    }
    @media screen and (max-width:425px){
        .product-detail{
            padding:50px 10px 20px 10px;
            flex-direction: column;
            width:100%;
            .image-show{
                height:200px;
                .small-image{
                    grid-row-gap:5px;
                }
                .large-image{
                    padding:0px 0px 0px 5px;
                }
            }
            .detail{
                padding:10px;
                height:auto;
                .title{
                    font-size:15px;
                }
                .price{
                    font-size: 15px;
                }
                .choose-colors{
                    .title{
                        font-size:10px;
                    }
                    .colors{
                        margin:0px 10px;
                        .color{
                            width:20px;
                            height:20px;
                        }
                    }
                }
                .choose-sizes{
                    font-size: 10px;
                    .title{
                        font-size: 10px;
                    }
                    .sizes{
                        margin:10px;
                        .size{
                            width:20px;
                            height:20px;
                            font-size:10px;
                        }
                    }
                }
                .quantity{
                    font-size:10px;
                    .control{
                        height:20px;
                        margin:10px;
                        width:65px;
                        
                    }
                }
                .add-to-cart{
                    width:100%;
                    height:40px;
                    margin-left:0px;
                    span{
                        font-size:12px;
                        
                    }
                }
            }
        }
    }
</style>