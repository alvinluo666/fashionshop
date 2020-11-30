<template>
    <div :class="[scrollOverTopSection?'over-top-section':'','header']">
        <div class="logo">
            <h3>Fashion</h3>
        </div>
        <div class="toggleMenu" @click.stop="toggleLeftMenu">
            <i class="fas fa-bars"></i>
        </div>
        <div class="nav">
            <a :href="url('home')" :class="[activeLink=='home'?'active':'']">Home</a>
            <a :href="url('men')" :class="[activeLink=='men'?'active':'']">Men</a>
            <a :href="url('women')" :class="[activeLink=='women'?'active':'']">Women</a>
            <a :href="url('kid')" :class="[activeLink=='kid'?'active':'']">Kids</a>
        </div>
        <div class="action">
            <div class="search">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search your products" v-model="searchKey">
            </div>
            <div class="cart" @click="loadCart">
                <i class="fas fa-shopping-cart"></i>
                <span v-if="cart.length>0">{{cart.length}}</span>
            </div>
            <div class="account" @mouseover="showMenu=true" @mouseout="showMenu=false">
                <i class="fas fa-user" v-if="!user"></i>
                <img v-if="user" :src="user.avator" alt="" style="width:25px;height:25px;border-radius:25px;">
                <div class="menu" v-show="showMenu">
                    <div class="menu-item" v-if="!user" @click="to('/login')">Login</div>
                    <div class="menu-item" v-if="!user" @click="to('/register')">Register</div>
                    <div class="menu-item username" v-if="user">{{user.name}}</div>
                    <div class="menu-item" v-if="user" @click="to('/order')">My Order</div>
                    <div class="menu-item" v-if="user" @click="logout">Log out</div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapMutations, mapState } from 'vuex'
export default {
    data:function(){
        return {
            currentActive:'home',
            showMenu:false,
            searchKey:''
        }
    },
    computed:{
        ...mapState([
            'cart',
            'user'
        ]),
        
    },
    props:[
        'activeLink',
        'scrollOverTopSection'
    ],
    methods:{
        url:function(url){
            return config.BASE_URL+'/'+url
        },
        ...mapMutations([
            'toggleLeftMenu',
            'setUser',
            'setCart'
        ]),
        loadCart:function(){
            window.location.href=config.BASE_URL+'/cart'
        },
        logout:function(){
            fetch(config.BASE_URL+'/api/logout',{
                headers:{
                    authtoken:document.head.querySelector('meta[name="csrf-token]"')
                },
            }).then((r)=>{
                this.setUser(null);
                this.setCart([]);
            })
        },
        to:function(url){
            window.location.href=config.BASE_URL+url;
        },
        performSearch:function(e){
            if(e.keyCode==13&&this.searchKey!=''){
               window.location.href=config.BASE_URL+"/search?key="+this.searchKey;
            }
        }
        
    },
    mounted(){
        window.addEventListener('keyup',this.performSearch)
    }
}
</script>
<style lang="scss" scoped>
    @import "../../sass/app.scss";

    .header{
        display:flex;
        width:100%;
        justify-content: space-between;
        align-items:center;
        padding:$desktop-top-padding $desktop-left-padding;
        height:auto;
        z-index:10;
        position:fixed;
        transition:0.5s all;
        .logo{
            display: flex;
            align-items: center;
            justify-content: center;
            h3{
                color:white;
                margin:0;
            }
        }
        .toggleMenu{
            display:none;
            cursor:pointer;
        }
        .action{
            display:flex;
            align-items: center;
            
            div{
                cursor:pointer;
            }
            .cart,.account{
                position:relative;
                i{
                    color:white
                }
                span{
                    position: absolute;
                    z-index:100;
                    color:white;
                    width:15px;
                    height:15px;
                    display:flex;
                    align-items:center;
                    justify-content:center;
                    border-radius: 25px;
                    background:red;
                    top:-40%;
                    left:50%;
                    font-size: 10px;
                }
                .menu{
                    position:absolute;
                    right:-10px;
                    top:100%;
                    background:white;
                    box-shadow: 0px 5px 6px rgba($color: #000000, $alpha: 0.1);
                    margin:0px;
                    width:150px;
                    .menu-item{
                        display:flex;
                        align-items:center;
                        justify-content:center;
                        width:100%;
                        padding:10px 5px;
                        background:white;
                        margin:0px;
                        cursor:pointer;
                        &:hover{
                            background:rgb(238, 238, 238);
                        } 
                    }
                    .menu-item.username{
                        background: white;
                        color:orange;
                        cursor:default;
                        &:hover{
                            background:white;
                        }
                    }
                }
            }
            div:not(:last-child){
                margin:0px 30px;
            }
            div:last-child{
                margin-left:30px;
            }
            
            .search{
                background: white;
                // border-radius:50%;
                padding:10px 20px;
                box-shadow:1px 4px 6px rgba($color: black, $alpha: 0.1);
                display:flex;
                align-items: center;
                i{
                    padding-right:10px;
                }
                input{
                    border:none;
                    outline:none;
                    width:300px;
                }
            }
        }
        .nav{
            display:flex;
            a{
                display:block;
                text-decoration:none;
                color: white;
                padding:0px 30px;
                
            }
            a.active{
                color:orange
            }
        }
    }
    // when window scroll to position larger than top section
    .header.over-top-section{
        box-shadow: 0px 3px 6px rgba($color: #000000, $alpha: 0.1);
        background:white;
        .logo{
            h3{
                color:black
            }
        }
        .toggleMenu{
            i{
                color:black;
            }
        }
        .action{
            .cart,.account{
                i{
                    color:black
                }
            }
            .search{
                background: rgb(243, 243, 243);
                box-shadow:none;
                input{
                    background:transparent;
                }
            }
        }
        .nav{
            a{
                color: black;
                padding:0px 30px;
                
            }
            a.active{
                color:orange
            }
        }
    }
    @media screen and (max-width:1024px) and( min-width:769px){
        .header,.over-top-section{
            padding:$laptop-top-padding $laptop-left-padding;
            .logo{
                h3{
                    font-size:15px;
                }
            }
            .nav{
                a{
                    padding:0px 20px;
                    font-size:12px;
                }
            }
            .action{
                .search{
                    padding:5px 14px;
                    input{
                        width:200px;
                    }
                }
                div:not(:last-child){
                    margin:0px 20px;
                }
                div:last-child{
                    margin-left:20px;
                }
            }
        }
        
    }
    @media screen and (max-width:768px) and( min-width:426px){
        .header,.over-top-section{
            padding:$laptop-top-padding $laptop-left-padding;
            .logo{
                h3{
                    font-size:15px;
                }
            }
            .nav{
               a{
                    padding:0px 15px;
                    font-size:12px;
                }
            }
            .action{
                .search{
                    padding:6px 10px;
                    input{
                        width:150px;
                        font-size:12px;
                    }
                }
                div:not(:last-child){
                    margin:0px 15px;
                }
                div:last-child{
                    margin-left:15px;
                }
            }
        }
        
    }
    @media screen and (max-width:425px) {
        .header{
            padding:$mobile-top-padding $mobile-left-padding;
            .logo{
                display:none
            }
            .toggleMenu{
                display:flex;
                i{
                    color:white;
                    padding-right:3px;
                }
            }
            .nav{
                display:none;
            }
            .action{
                width:100%;
                .cart,.account{
                    span{
                        font-size: 8px;
                        width:10px;
                        height:10px;
                        top:-10%;
                    }
                }
                .search{
                    padding:5px 10px;
                    width:100%;
                    i{
                        opacity:0.2;
                    }
                    input{
                        width:100%;
                        font-size:10px;
                    }
                    
                }
                div:not(:last-child){
                    margin:0px 7px;
                }
                div:last-child{
                    margin-left:7px;
                }
            }
        }
    }
</style>