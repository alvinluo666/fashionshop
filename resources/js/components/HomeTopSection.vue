<template>
    <section class="top" :style="{backgroundImage: 'url(storage/banners/'+currentBanner.image+')','backgroundSize':'cover' }">
            <Header activeLink="home" :scrollOverTopSection="scrollOverTopSection"></Header>
            <div class="title">
                <h1>{{currentBanner.title}}</h1>
                <div class="shop-now">
                    <span class="icon" :style="bannerColor">
                        <i class="fas fa-arrow-right">
                    </i></span>
                    <span class="btn">Shop Now</span>
                </div>
            </div>
            <div class="features">
                <div class="feature" v-for="feature in currentBanner.features" :key="feature.title">
                    <span class="icon" :style="bannerColor">
                        <i class="fas fa-shipping-fast" ></i>
                    </span>
                    <div class="description">
                        <h4>{{feature.title}}</h4>
                        <p>{{feature.description}}</p>
                    </div>
                </div>
            </div>
            <div class="banner-btn">
                <div class="prev" @click="prev">
                    <i class="fas fa-arrow-left"></i>
                </div>
                <div class="next" @click="next">
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>
            
        </section>
</template>
<script>
import Header from './Header.vue'
import { mapMutations, mapState } from 'vuex'

export default {
    data:function(){
        return {
            currentBanner:{},
            isLastBanner:false,
            isFirstBanner:false,
            scrollOverTopSection:false,
        }
    },
    components:{
        Header,
    },
    computed:{
        ...mapState([
            'banners'
        ]),
        bannerColor:function(){
            return {
                color:'rgb('+this.currentBanner.color+')',
                backgroundColor:'rgba('+this.currentBanner.color+',0.3)'
            }
        }
        
    },
    methods:{
        ...mapMutations([
            'closeLeftMenu'
        ]),
        changeBanner:function(){
            let currentIndex=this.banners.indexOf(this.currentBanner);
            if(currentIndex==-1){
                currentIndex=0;
            }else{
                currentIndex++;
                if(currentIndex>=this.banners.length){
                    currentIndex=0;
                    
                }
            }      
            this.currentBanner=this.banners[currentIndex];
            setTimeout(this.changeBanner,5000);
        },
        prev:function(){
            let currentIndex=this.banners.indexOf(this.currentBanner);
            currentIndex--;
            if(currentIndex<0){
                currentIndex=this.banners.length-1;
            }
            this.currentBanner=this.banners[currentIndex];
        },
        next:function(){
            let currentIndex=this.banners.indexOf(this.currentBanner);
            currentIndex++;
            if(currentIndex>=this.banners.length){
                currentIndex=0
            }
            this.currentBanner=this.banners[currentIndex];
        },
        changeHeader:function(){
            const topSectionHeight=document.querySelector('.top').getBoundingClientRect().height;
            if(document.documentElement.scrollTop>topSectionHeight){
                this.scrollOverTopSection=true;
            }else{ 
                this.scrollOverTopSection=false;
            }   
        }
    },
    mounted(){      
        window.addEventListener('scroll',this.changeHeader)
        this.changeBanner();
    }
}
</script>
<style lang="scss">
    .top{
        width:100vw;
        height:100vh;
        background-size: cover;
        background-repeat:no-repeat;
        background-position: center;
        position:relative;
        z-index:1;
        background-blend-mode:multiply;
        transition: 0.3s all;
        .title{
            display:flex;
            flex-direction: column;
            align-items: center;
            position:absolute;
            top:50%;
            transform:translate(-50%,-60%);
            left:50%;
            h1{
                font-size:60px;
                color:white;
                width:500px;
                font-family: 'Courier New', Courier, monospace;
                margin-bottom:30px;
                text-align:center
            }
            .shop-now{
                cursor: pointer;
                span.btn{
                    color:white;
                    text-transform: uppercase;
                    padding:0px 20px;
                    position:relative;
                    &::after{
                        content:'';
                        position:absolute;
                        width:0px;
                        height:3px;
                        bottom:0;
                        left:0;
                        transform: translateY(100%);
                        transition: 1s all;
                        background-color:orange;
                    }
                    &:hover::after{
                        width:50px;
                        left:40%;
                    }
                }                      
                span.icon{
                    padding:10px 14px;
                    border-radius:50%;
                }
            }
        }
        .features{
            position:absolute;
            background:white;
            bottom:-1px;
            left:50%;
            transform:translateX(-50%);
            border-top-right-radius: 100px;
            border-top-left-radius: 100px;
            display:flex;
            align-items: flex-start;
            justify-content: space-around;
            padding:30px 50px;
            width:80%;
            .feature{
                padding:0px 50px;
                display:flex;
                align-items: flex-start;
                .icon{
                    display:block;
                    padding:10px;
                    margin:0px 20px;
                    border-radius:10px;
                    background-color:rgba($color: orange, $alpha: 0.3);
                    i{
                        color:inherit;
                    }
                }
                .description{
                    h4{
                        padding-bottom:5px;
                    }
                    p{
                        font-size:12px;
                        max-width:150px;
                    }
                }
            }
        }
        .banner-btn{
            display:flex;
            position:absolute;
            right:10%;
            top:50%;
            .prev,.next{
                padding:10px 15px;
                background:white;
                color:black;
                cursor:pointer;
                margin:10px;
            }
            .prev.disable,.next.disable{
                opacity:0.5;
            }
        }
    }
    @media screen and (max-width:1024px) and( min-width:769px){
        .top{
            
            .features{
                padding:20px 30px;
                width:90%;
                .feature{
                    padding:0 20px;
                }
            }
        }
    }
     @media screen and (max-width:768px) and( min-width:426px){
         .top{
             .features{
                 display:none;
             }
             .banner-btn{
                 top:70%;
             }
         }
     }
     @media screen and (max-width:425px) {
         .top{
             height:30vh;
             .title{
                 width:100%;
                 top:60%;
                 h1{
                     font-size:20px;
                     width:50%;
                     margin-bottom:10px;
                 }
                 .shop-now{    
                    padding-top:10px;             
                    span.btn{
                        color:white;
                        padding:0px 10px;
                    }                      
                    span.icon{
                        padding:6px 10px;
                        border-radius:50%;
                    }
                }
             }
             .features{
                 display:none;
             }
             .banner-btn{
                 display:none;
             }
         }
     }
</style>