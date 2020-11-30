<template>
    <div>
        <div class="checkout">
            <div class="shipping-info">
                <div class="title">Shipping information</div>
                <div class="form">
                    <input type="text" name="email" v-model="email" placeholder="Email">
                    <input type="text" name="address" v-model="address" placeholder="Address">
                    <input type="text" name="firstname" v-model="firstname" placeholder="First name">
                    <input type="text" name="lastname" v-model="lastname" placeholder="Last name">
                    <input type="text" name="phone" v-model="phone" placeholder="Phone number">
                    <select name="city" id="" v-model="city" placeholder="Select">
                        <option value="" selected disabled style="opacity:0.4">Select city</option>
                        <option :value="ship" v-for="ship in destination" :key="ship">{{ship}}</option>
                    </select>
                </div>
            </div>
            <div class="payment">
                <div class="title">Payment method</div>
                <div class="payment-method">
                    <div :class="['paypal',payment=='paypal'?'active':'']" @click="payment='paypal'">
                        <img src="storage/assets/paypal.png" alt="">
                    </div>
                    <div :class="['visa',payment=='visa'?'active':'']" @click="payment='visa'">
                        <img src="storage/assets/visa.png" alt="">
                    </div>
                    <div :class="['master',payment=='master'?'active':'']" @click="payment='master'">
                        <img src="storage/assets/mastercard.png" alt="">
                    </div>
                </div>
                <div class="title">Delivery method</div>
                <div class="not-choose" v-if="!city" style="text-align:center">Deliver method change to city !</div>
                <div class="delivery-method" v-if="city">
                    <div :class="['deli',deli_method==deli?'active':'']" v-for="deli in delivery" :key="deli" @click="deli_method=deli">{{deli}}</div>
                </div>
            </div>
            <div class="cost">
                <div class="product">
                    Product cost : <span>$ {{getTotal}}</span>
                </div>
                <div class="shipping">Shipping fee : <span>$ {{getShippingFee}}</span></div>
                <div class="total">
                    Total cost : <span>$ {{getActualCost}}</span>    
                </div>
            </div>
        </div>
        <div class="to-pay" >
            <div class="back" @click="$emit('cartitem')">
                <i class="fas fa-arrow-left" style="margin-right:10px"></i>back
            </div>
            <div class="btn" @click="placeOrder">Confirm Order</div>
        </div>                  
    </div>
</template>
<script>
import { mapActions,mapState,mapMutations } from 'vuex'
export default {
    data:function(){
        return {
            shipping:[],
            destination:[],
            delivery:[],
            email:'',
            address:'',
            firstname:'',
            lastname:'',
            phone:'',
            city:'',
            payment:'',
            deli_method:'',
        }
    },
    computed:{
        ...mapState([
            'cart'
        ]),
        getTotal:function(){
            var total=this.cart.reduce((acc,item)=>{
        
                return acc+item.product.price*item.quantity;
            },0)
            return total//convert to comma
        },
        getShippingFee:function(){
            if(this.deli_method=='') return 0;

            var total_weight=this.cart.reduce((acc,item)=>{
                return acc+item.product.weight*item.quantity
            },0)
            var currentShipping=this.shipping.filter((item)=>{
                return item.shipper==this.deli_method&&item.destination==this.city
            })
            console.log(currentShipping)
            return total_weight*currentShipping[0].cost;
        },
        //final cost
        getActualCost:function(){
          return  this.getTotal+this.getShippingFee
        },
        
    },
    methods:{
        ...mapActions([
            
        ]),
        ...mapMutations([
            'setCart'
        ]),
        removeCart:function(id){          
            this.setCart([]);
            fetch(config.BASE_URL+'/api/cart/'+id,{
                method:'delete',
                headers:{
                    authtoken:document.head.querySelector('meta[name="csrf-token"]'),
                    'X-CSRF-TOKEN':document.head.querySelector('meta[name="csrf-token"]').getAttribute('content'),                }
            })
        },
        getShipping(){
            fetch(config.BASE_URL+'/api/shipping',{
                headers:{
                    authtoken:document.head.querySelector('meta[name="csrf-token]"'),
                },
            })
            .then(response=>response.json())
            .then(data=>{
                this.shipping=data;
                var destinationSet=new Set();
                this.shipping.forEach((ship)=>{
                    destinationSet.add(ship.destination);
                })
                this.destination=[...destinationSet];
            })
        },
        placeOrder:function(){
            if(this.email&&this.address&&this.firstname&&this.lastname&&this.phone&&this.city&&this.payment&&this.deli_method){
                this.cart.forEach(item=>{
                    fetch(config.BASE_URL+'/api/order',{
                        method:'POST',
                        headers:{
                            authtoken:document.head.querySelector('meta[name="csrf-token"]'),
                            'Content-Type':'application/json',
                            'X-CSRF-TOKEN':document.head.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                        body:JSON.stringify({
                            product_id:item.product_id,
                            user_id:item.user_id,
                            email:this.email,
                            address:this.address,
                            fullname:this.firstname+' '+this.lastname,
                            phone:this.phone,
                            city:this.city,
                            size:item.size,
                            color:item.color,
                            quantity:item.quantity,
                            shipper:this.deli_method,
                            ship_info:['Prepair to place order to shipper'],
                            status:'active'
                        })
                    }).then(response=>response.json())
                    .then(data=>{
                        this.removeCart(item.id);
                        if(data.message=='success'){
                            window.location.href=config.BASE_URL+"/ordersuccess";
                        }
                    })
                });
            }else{
                alert("Please fill infomation to continue");
            }
        }
    },
    watch:{
        city:function(val){
            var array=[];
            this.shipping.filter((ship)=>{
               return ship.destination==val
            }).forEach(item=>{
                array.push(item.shipper);
            });
            this.delivery=array;
            this.deli_method='';
        }
    },
    mounted(){
        this.getShipping();
    }
}
</script>
<style lang="scss" scoped>
    div{
        .checkout{
            display:flex;
            margin-top:20px;

            .shipping-info{
                flex:2;
                .title{
                    font-weight:bold;
                    color:black;
                    padding:20px 0px;
                }
                .form{
                    display:grid;
                    grid-template-columns: 1fr 1fr;
                    grid-column-gap:20px;
                    grid-row-gap:20px;
                    input{
                        border:0.3px solid rgba($color: #000000, $alpha: 0.1);
                        outline:none;
                        padding:15px 20px;
                        border-radius:25px;
                        &:focus{
                            border:0.3px solid rgba($color: orange, $alpha: 1)
                        }
                    }
                    select{
                        border:0.3px solid rgba($color: #000000, $alpha: 0.1);
                        outline:none;
                        padding:15px 20px;
                        border-radius:25px;
                        appearance: none;
                    }
                }

            }
            .payment{
                flex:2;
                display:flex;
                flex-direction:column;
                padding:0px 30px;
                .title{
                    font-weight:bold;
                    color:black;
                    padding:20px 0px;
                }
                .payment-method{
                    display:grid;
                    grid-template-columns:1fr 1fr 1fr;
                    grid-column-gap:10px;
                    grid-row-gap:10px;
                    
                    div{
                        display:flex;
                        align-items:center;
                        justify-content: center;
                        border:0.3px solid rgba($color: #000000, $alpha: 0.1);
                        height:60px;
                        border-radius:50px;
                        overflow:hidden;
                        cursor:pointer;
                        img{
                            width:100%;
                            height:100%;
                            object-fit: contain;
                            
                        }
                    }
                    div.active{
                        border:0.3px solid rgba($color: orange, $alpha: 1)
                    }
                }
                .delivery-method{
                    display:grid;
                    grid-template-columns:1fr 1fr 1fr;
                    grid-column-gap:10px;
                    grid-row-gap:10px;
                    .deli{
                        display:flex;
                        align-items:center;
                        justify-content: center;
                        border:0.3px solid rgba($color: #000000, $alpha: 0.1);
                        height:60px;
                        border-radius:50px;
                        overflow:hidden;
                        color:black;
                        cursor:pointer;
                    }
                    .deli.active{
                            border:0.3px solid rgba($color: orange, $alpha: 1)
                    }
                }
            }
            .cost{
                flex:1;
                background:rgb(240, 240, 240);
                height:130px;
                display:flex;
                align-items:flex-start;
                justify-content:space-around;
                flex-direction:column;
                padding:20px;
                margin-top:20px;
                span{
                    color:black;
                    font-weight:bold;
                    margin-left:5px;
                }
                .total{
                    margin-top:20px;
                }
            }
        }
        .to-pay{
            display:flex;
            align-items: center;
            justify-content: space-between;
            margin-top:20px;
            .back{
                cursor:pointer;
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
    @media screen and (max-width:768px) and( min-width:426px){
        div{
            .checkout{
                margin-top:10px;
                .shipping-info{
                    .form{
                        grid-column-gap:10px;
                        grid-row-gap:10px;
                        input{
                            padding:5px 10px;
                            font-size: 12px;
                        }
                        select{
                            padding:5px 10px;
                        }
                    }
                }
                .payment{
                    padding:0px 5px 0px 5px;
                    .payment-method{
                        grid-template-columns:1fr 1fr;
                         grid-column-gap:5px;
                        grid-row-gap:5px;
                        div{
                            height:40px;
                        }
                    }
                    .delivery-method{
                        grid-template-columns:1fr 1fr;
                        .deli{
                            height:40px;
                        }
                    }
                }
                .cost{
                    font-size:10px;
                    padding:5px;
                    span{
                        
                    }
                    .total{
                        margin-top:10px;
                    }
                }
            }

            .to-pay{
                .btn{
                    width:100px;
                    height:40px;
                    font-size:14px;
                }
            }
        }
    }
    @media screen and (max-width:425px){
       div{
           .checkout{
               flex-direction: column;
               margin-top:10px;
               .shipping-info{    
                   .title{
                       padding:0px 0px 10px 0px;
                   }
                   .form{
                       grid-column-gap:5px;
                       grid-row-gap: 10px;
                        grid-template-columns:1fr;
                       input{
                           padding:10px 15px;
                           font-size:10px;
                       }
                       select{
                           padding:10px 15px;
                           font-size:10px;
                       }
                   }
               }
               .payment{
                   padding:0px;
               }
           }
       }
    }

</style>