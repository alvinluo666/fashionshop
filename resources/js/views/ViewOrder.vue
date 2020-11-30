<template>
    <div class="view-order">
         <LeftNavigation></LeftNavigation>
         <Header :scrollOverTopSection="true"></Header>
         <Popup v-if="showPopup" :order="order" @togglepopup="showPopup=false" @resetOrder="resetOrder"></Popup>
         <div class="block"></div>
         <div v-if="orders.length==0" style="width:100%;text-align:center">No order</div>
         <div v-else class="order" v-for="order in orders" :key="order.id">
             <div class="product">
                 <img :src="order.product.image[0]" alt="">
                 <div class="title">
                     <span class="name" @click="seeProduct(order.product_id)">{{order.product.name}}</span>
                     <span class="orderID" title="click to copy" @click="copyID">Order ID : <span class="copyText">{{order.id}}</span></span>
                 </div>
                 <div class="spec">
                     <span class="size">{{order.size}}</span>
                     <span class="color">{{order.color}}</span>
                     <span class="quantity">{{order.quantity}}</span>
                 </div>
             </div>
             <div class="info">
                 <div class="name">
                     Full Name
                     <span>{{order.fullname}}</span>
                 </div>
                 <div class="Address">
                     Address
                     <span>{{order.address}}</span>
                 </div>
                 <div class="phone">
                     Phone No.
                     <span>{{order.phone}}</span>
                 </div>
                 <div class="city">
                     City
                     <span>{{order.city}}</span>
                 </div>
                 <div class="shipper">
                     Shipper
                     <span>{{order.shipper}}</span>
                 </div>
                 <div class="order-date">
                     Order Date
                     <span>{{order.created_at}}</span>
                 </div>
             </div>
             <div class="confirm" @click="togglePopup(order)">
                 <span class="btn">
                     Collect
                 </span>
             </div>
         </div>
    </div>
</template>
<script>
import LeftNavigation from '../components/LeftNavigation.vue';
import Header from '../components/Header.vue';
import Popup from '../components/Popup.vue';
export default {
    props:['json_orders'],
    data:function(){
        return {
            orders:JSON.parse(this.json_orders),
            showPopup:false,
            order:null
        }
    },
    methods:{
        copyID:function(e){
            var text= e.target.childNodes[1].innerText;
            var textarea=document.createElement('textarea');
            textarea.value=text;
            console.log(textarea.value);
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand('copy');
            document.body.removeChild(textarea);
        },
        togglePopup:function(order){
            this.showPopup=!this.showPopup;
            this.order=order;
        },
        resetOrder:function(orders){
            this.orders=orders
        },
        seeProduct:function(id){
             window.location.href=config.BASE_URL+'/product/all/'+id;
        }
    },
    components:{
        LeftNavigation,
        Header,
        Popup
    }
}
</script>
<style lang="scss" scoped>
    .view-order{
        .block{
            height:100px;
        }
        .order{
            margin:0px 100px;
            box-shadow:0px 6px 6px rgba($color: #000000, $alpha: 0.05);
            padding:20px 30px;
            .product{
                display:flex;
                align-items:center;
                img{
                    width:50px;
                    height:50px;
                    border-radius: 25px;
                    margin-right:20px;
                }
                .title{
                    display:flex;
                    flex-direction: column;
                    align-items: flex-start;
                    margin-right:20px;
                    .name{
                        font-weight: bold;
                        color:black;
                        font-size:16px;
                        cursor:pointer;
                    }
                    .orderID{
                        font-size:14px;
                        cursor:pointer;
                    }
                }
                .spec{
                    display:flex;
                    align-items:center;
                    span{
                        display:block;
                        padding:3px 5px;
                        border-radius:5px;
                        min-width:40px;
                        margin-right:10px;
                        text-align:center;
                    }
                    span.size{
                        background-color:rgb(252, 212, 218);
                    }
                    span.color{
                        background:rgb(187, 240, 187);
                    }
                    span.quantity{
                        background:rgb(241, 241, 190);
                    }
                }
            }
            .info{
                display:flex;
                align-items: center;
                justify-content: flex-start;
                margin:20px 10px;
                div{
                    display:Flex;
                    flex-direction:column;
                    align-items: flex-start;
                    color:orange;
                    font-size:12px;
                    margin-right:30px;
                    span{
                        color:black;
                        font-size:16px;
                        padding-top:0px;
                    }
                }
            }
            .confirm{
                width:100%;
                display:flex;
                justify-content: flex-end;
                span{
                    display:flex;
                    width:100px;
                    height:30px;
                    align-items:center;
                    justify-content:center;
                    background:orange;
                }
            }
        }
    }
     @media screen and (max-width:1024px) and( min-width:769px){
         .view-order{
             .order{
                margin:0px 80px;
            }
         }
     }
     @media screen and (max-width:768px) and( min-width:426px){
         .view-order{
             .order{
                margin:0px 30px;
            }
         }
     }
     @media screen and (max-width:425px){
         .view-order{
             .block{
                 height:50px;
             }
             .order{
                 margin:0px 10px;
                 padding:10px;
                 .product{
                     img{
                         width:20px;
                         height:20px;
                         margin-right:5px;
                     }
                     .title{
                         margin-right:5px;
                         .name{
                             font-size:12px;
                         }
                         .orderID{
                             font-size:10px;
                         }
                     }
                     .spec{
                         span{
                             min-width:20px;
                             font-size:10px;
                         }
                     }
                 }
                 .info{
                     margin:10px;
                     flex-wrap: wrap;
                     div{
                         font-size:10px;
                         margin-right:20px;
                         span{
                             font-size: 12px;
                         }
                     }
                }
                .confirm{
                    span{
                        height:20px;
                        width:60px;
                        font-size:13px;
                    }
                }
             }
             
         }
     }
</style>