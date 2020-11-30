<template>
    <div class="pop-up">
        <form class="form">
            <h5>Rate this product !</h5>
            <div class="rating">           
                <ul class="list">
                    <li @click="rate(star)" v-for="star in maxStars" :class="{'active':star<=stars}" :key="star.stars" class="star">
                        <i :class="star <= stars ? 'fas fa-star' : 'far fa-star'"></i>
                    </li>
                </ul>
                <input type="hidden" v-model="stars">
            </div>
            <textarea required name="comment" id="" cols="30" rows="5" maxlength="30" v-model="comment" aria-expanded="false">Say something about this product</textarea>
            <div class="btn">
                <button @click.prevent="addRating">Continue</button>
                <button @click.prevent="$emit('togglepopup')" class="cancel">Cancel</button>
            </div>
        </form>
    </div>
</template>
<script>
import { mapState } from 'vuex'
export default {
    props:['order'],
    data:function(){
        return {
            maxStars:5,
            stars:0,
            comment:''
        }
    },
    computed:{
        ...mapState([
            'user'
        ])
    },
    watch:{
        
    },
    methods:{
        rate(star){
            if(typeof star ==='number' && star <= this.maxStars && star >= 0){
                this.stars = this.stars === star ? star -1 : star
            }
        },
        addRating(){
            if(this.comment!=''){
                fetch(config.BASE_URL+'/comment',{
                    method:'POST',
                    headers:{
                        authtoken:document.head.querySelector('meta[name="csrf-token"]'),
                        'Content-Type':'application/json',
                        'X-CSRF-TOKEN':document.head.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    
                    },
                    body:JSON.stringify({
                            order_id:this.order.id,
                            product_id:this.order.product_id,
                            user_id:this.order.user_id,
                            message:this.comment,
                            rating:this.stars
                    })
                })
                .then(response=>response.json())
                .then(data=>{
                    //change status to complete
                    fetch(config.BASE_URL+'/order/changeStatus/'+this.order.id,{
                        method:'GET',
                        headers:{
                            authtoken:document.head.querySelector('meta[name="csrf-token"]'),
                            'Content-Type':'application/json',
                            'X-CSRF-TOKEN':document.head.querySelector('meta[name="csrf-token"]').getAttribute('content'),                  
                        },
                    })
                    .then(response=>{
                        return response.json();
                        
                    })
                    .then(data=>{
                        this.$emit('resetOrder',data)
                        this.$emit('togglepopup')
                    })
                    
                })
            }
        }
    }

}
</script>
<style lang="scss" scoped>
    .pop-up{
        position:fixed;
        z-index:10000;
        display:flex;
        align-items: center;
        justify-content: center;
        width:100vw;
        height: 100vh;
        background:rgba(black,0.5);
        transition: 0.3s all;
        .form{
            background:white;
            width:300px;
            height:400px;
            display:Flex;
            align-items: center;
            justify-content:flex-start;
            flex-direction: column;
            padding:0px 10px;

            h5{
                text-align:center;
                padding: 20px 0px 10px 0px;
                font-weight: bold;
            }
            .rating{
                display:flex;
                align-items: center;
                justify-content: center;
                
                ul{
                    display:flex;
                    align-items: center;
                    justify-content: center;
                    li{
                        display:inline;
                        list-style: none;
                        padding:5px;
                        i{
                            color:red;
                            cursor:pointer;
                            font-size:20px;
                        }
                    }
                }
            }
            textarea{
                padding:5px;
                border:1px solid rgba(black,0.2);
                resize:none;
                width:100%;
            }
            .btn{
                width:100%;
                button{
                    width:100%;
                    height:40px;
                    outline:none;
                    background:red;
                    border:none;
                    color:white;
                    margin-top:30px;
                }
                button.cancel{
                    background:rgb(228, 228, 228);
                    margin-top:20px;
                    color:black;
                }
            }
        }
    }
</style>