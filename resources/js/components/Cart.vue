<template>
    <div class="cart">
           <div class="title">
               <span>Shopping Cart</span>
               <div class="step">
                   <div :class="['icon',showComponent=='CartItem'?'active':'']">
                       <i class="fas fa-shopping-cart"></i>
                   </div>
                   <div :class="['line',showComponent=='CheckOut'?'active':'']"></div>
                    <div :class="['icon',showComponent=='CheckOut'?'active':'']">
                        <i class="fas fa-shipping-fast"></i>
                    </div>
               </div>
           </div>
           <component :is="showComponent" @checkout="checkout" @cartitem='cartitem'></component>
    </div>
</template>
<script>
import CartItem from './CartItem.vue';
import CheckOut from './CheckOut.vue';
export default {
    data:function(){
        return {          
            showComponent:'CartItem'
        }
    },
    components:{
        CartItem,
        CheckOut
    },
    methods:{
        checkout(){
            this.showComponent='CheckOut'
        },
        cartitem(){
            this.showComponent="CartItem"
        }
    }
}
</script>
<style lang="scss" scoped>
    .cart{
        padding:100px;
        .title{
            display:flex;
            justify-content: space-between;
            align-items: center;
            span{
                font-size:18px;
                font-weight: bold;
            }
            .step{
                display:flex;
                align-items: center;
                .line{
                    height:1px;
                    width:80px;
                    background:rgb(241, 241, 241);
                    opacity: 0.3 ;
                }
                .line.active{
                    background:orange;
                }
                .icon{
                    width:35px;
                    height:35px;
                    display:flex;
                    align-items: center;
                    justify-content: center;
                    border-radius:25px;
                    i{
                        color:rgb(223, 223, 223);
                    }
                }
                .icon.active{
                    background:orange;
                    i{
                        color:white;
                    }
                }
            }
        }
    }
    @media screen and (max-width:1024px) and( min-width:769px){
        .cart{
            padding:80px
        }
    }
    @media screen and (max-width:768px) and( min-width:426px){
        .cart{
            padding:90px 30px;
            .title{
                span{
                    font-size: 15px;
                }
            }
        }
    }
    @media screen and (max-width:425px){
        .cart{
            padding:50px 10px;
            .title{
                span{
                    font-size: 12px;
                }
                .step{
                    .icon{
                        width:25px;
                        height:25px;
                    }
                }
            }
        }
    }
</style>