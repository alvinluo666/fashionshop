<template>
    <div class="cart-item">
        <table>
            <thead>
                <th>Product</th>
                <th>Color</th>
                <th>Size</th>
                <th>Quantity</th>
                <th>Price</th>
                <th></th>
            </thead>
            <tbody>
                <tr v-for="item in cart" :key="item.id">
                    <td class="img" style="cursor:pointer" @click="seeProduct(item.product_id)">
                        <img :src="item.product.image[0]" alt="">
                        <span>{{item.product.name}}</span>
                    </td>

                    <td class="color">{{item.color}}</td>
                    <td class="size">{{item.size}}</td>
                    <td class="quantity">
                        <div>
                            <i class="fas fa-minus" @click="decreaseQuantity(item.quantity,item.id)"></i>
                            <span>{{item.quantity}}</span>
                            <i class="fas fa-plus" @click="increaseQuantity(item.quantity,item.id)"></i>
                        </div>
                    </td>
                    <td class="price">$ {{item.product.price}}</td>
                    <td class="cancel" @click="removeCart(item.id)">
                        <i class="fas fa-times"></i>
                    </td>
                </tr>
                <tr v-if="cart.length==0" style="text-align:center;opacity:0.4;"><td colspan="6"><i style="font-size:100px;margin-top:100px" class="far fa-meh-blank"></i></td></tr>
            </tbody>
        </table>
        <div class="to-checkout" @click="$emit('checkout')" v-if="cart.length>0">
            <div class="total">
                Total cost <span>$ {{getTotal}}</span>
            </div>
            <div class="btn">CHECKOUT</div>
        </div>
    </div>
</template>
<script>
import { mapMutations, mapState } from 'vuex'
export default {
    computed:{
        ...mapState([
            'cart'
        ]),
        getTotal:function(){
            var total=this.cart.reduce((acc,item)=>{
                console.log(item);
                return acc+item.product.price*item.quantity;
            },0)
            return total.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, " , ");//convert to comma
        }
    },
    methods:{
        ...mapMutations([
            'setCart'
        ]),
        removeCart:function(id){
            var newCart=this.cart.filter((item)=>{
                return item.id!=id
            })
            this.setCart(newCart);
            fetch(config.BASE_URL+'/api/cart/'+id,{
                method:'delete',
                headers:{
                    authtoken:document.head.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-CSRF-TOKEN':document.head.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type':'application/json'
                }
            })
        },
        seeProduct:function(id){
             window.location.href=config.BASE_URL+'/product/all/'+id;
        },
        decreaseQuantity:function(quantity,id){    
            var newQuantity=quantity-1;
            if(quantity>1){
                var newCart=this.cart.map((item)=>{       
                    if(item.id==id){
                        return {
                            id:item.id,
                            user_id:item.userid,
                            product_id:item.product_id,
                            quantity:newQuantity,
                            color:item.color,
                            size:item.size,
                            created_at:item.created_at,
                            updated_at:item.updated_at,
                            product:item.product
                        }
                    }else{
                        return item;
                    }
                })
                this.updateQuantity(newQuantity,id);//update to server
                this.setCart(newCart);
            }
        },
        increaseQuantity:function(quantity,id){
                var quantity=quantity+1;        
                var newCart=this.cart.map((item)=>{       
                    if(item.id==id){
                        return {
                            id:item.id,
                            user_id:item.userid,
                            product_id:item.product_id,
                            quantity:quantity,
                            color:item.color,
                            size:item.size,
                            created_at:item.created_at,
                            updated_at:item.updated_at,
                            product:item.product
                        }
                    }else{
                        return item;
                    }
                    
                })
                this.updateQuantity(quantity,id);//update to server
                this.setCart(newCart);
        },
        updateQuantity:function(quantity,id){
            fetch(config.BASE_URL+'/api/cart/'+id+'/quantity/'+quantity,{
                method:'PUT',
                headers:{
                    authtoken:document.head.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-CSRF-TOKEN':document.head.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type':'application/json'
                }
            })
        }
    },
 
}
</script>
<style lang="scss" scoped>
    .cart-item{
        table{
            width: 100%;
            border-collapse:separate;
            border-spacing: 30px;
            thead{
                color:rgb(223, 223, 223);
            }
            tbody{
                tr{
                    td.img{
                        img{
                            width:40px;
                            height:40px;
                            border-radius: 25px;
                            margin-right:10px;
                        }
                        span{
                            font-weight: bold;
                            color:black
                        }
                    }
                    td.color,td.size,td.price{
                        font-weight: bold;
                        color:black
                    }
                    td.quantity{
                        div{
                            border:1px solid rgba($color: #000000, $alpha: 0.1);
                            width:70px;
                            height:30px;
                            display:flex;
                            align-items: center;
                            justify-content: space-around;
                            border-radius: 25px;
                            i{
                                cursor: pointer;
                            }
                        }
                    }
                    td.total{
                        font-weight: bold;
                        color:red;
                    }
                    td.cancel{
                        opacity: 0.6;
                        cursor:pointer;
                    }
                }
            }
        }
        .to-checkout{
            display: flex;
            justify-content: flex-end;
            align-items: center;
            width:100%;
            margin:30px;
            .total{
                span{
                    font-weight:bold;
                    color:black;
                    margin-left:10px;
                    font-size:20px;
                }
                margin-right:100px;
            }
            .btn{
                width:140px;
                height:50px;
                display:flex;
                justify-content: center;
                align-items:center;
                background:orange;
                border-radius:25px;
                color:black;
                font-weight: bold;
                letter-spacing: 1px;
                cursor:pointer;
                &:hover{
                    background: rgb(219, 144, 4);
                }
            }
        }
    }
    @media screen and (max-width:1024px) and( min-width:769px){
        .cart-item{
            table{
                border-spacing: 15px;
            }
            .to-checkout{
                margin:30px 0px;
            }
        }
    }
     @media screen and (max-width:768px) and( min-width:426px){
         .cart-item{
            table{
                border-spacing: 15px;
            }
            .to-checkout{
                margin:20px 0px;
                .btn{
                    width:100px;
                    height:40px;
                    font-size:14px;
                }
            }
        }
     }
    @media screen and (max-width:425px){
         .cart-item{
             margin-top:15px;
            table{
                border-spacing:0px 10px;
                
                thead{
                    font-size:10px;
                }
                tbody{
                    tr{
                        td.img{
                            img{
                                width:20px;
                                height:20px;
                                margin-right:5px
                            }
                            span{
                                font-size:10px;
                            }
                        }
                        td{
                            font-size:10px;
                        }
                        td.quantity{
                            div{
                                width:40px;
                                height:20px;
                            }
                        }
                    }
                }
            }
            .to-checkout{
                margin:10px 0px;
                .total{
                    font-size:10px;
                    span{
                        font-size:13px;
                    }
                    margin-right:15px;
                }
                .btn{
                    width:70px;
                    height:30px;
                    font-size:9px;
                }
            }
        }
     }
</style>