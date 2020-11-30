<template>
    <div class="footer">
        <div class="column-one">
            <h1>Fashion</h1>
            <p>House My Brand designs clothing for the young, the old everyone in between – but most importantly, for the fashionable</p>
            <div class="social">
                <img :src="url+'/storage/assets/facebook.svg'" alt="">
                <img :src="url+'/storage/assets/twitter.svg'" alt="">
                <img :src="url+'/storage/assets/linkedin.svg'" alt="">
                <img :src="url+'/storage/assets/instagram.svg'" alt="">
                <img :src="url+'/storage/assets/youtube.svg'" alt="">
            </div>
        </div>
        <div class="column-two">
            <h5>Shopping online</h5>
            <a href="">Order Status</a>
            <a href="">Shipping and Delivery</a>
            <a href="">Returns</a>
            <a href="">Payment Options</a>
            <a href="">Contact Us</a>
        </div>
        <div class="column-three">
            <h5>Infomation</h5>
            <a href="">Gift Cards</a>
            <a href="">Find a store</a>
            <a href="">Newsletter</a>
            <a href="">Become a member</a>
            <a href="">Site feedback    </a>
        </div>
        <div class="column-four">
            <h5>Contact</h5>
            <a href="">alvinluo.thant@gmail.com</a>
            <a href="">Hotline +959767429188</a>
        </div>
    </div>    
</template>
<script>
// import config from '../config.js';
export default {
    data:function(){
        return {
            url:''
        }
    },
    mounted(){
        this.url=config.BASE_URL;
    }
}
</script>
<style lang="scss">
    @import '../../sass/_variables.scss';
    .footer{
        padding:0px 100px 50px 100px;
        display:grid;
        grid-template-columns:1fr 1fr 1fr 1fr;
        .column-one{
            display:flex;
            flex-direction: column;
            align-items: flex-start;
            h1{
                margin-block-start:0px;
            }
            p{
                padding:20px 0px 30px 0px;
                color:#808080;
            }
            .social{
                display:flex;
                justify-content: space-between;
                width:100%;
                img{
                    cursor:pointer;
                }
            }
        }
        .column-two,.column-three,.column-four{
            display: flex;
            flex-direction:column;
            align-items: flex-end;
            h5{
                padding:0px 0px 20px 0px;
            }
            a{
                padding-bottom:10px;
                text-decoration: none;
                color:#808080;
                &:hover{
                    color:black;
                }
            }
        }
    }
    @media screen and (max-width:1024px) and( min-width:769px){
        .footer{
            padding: 20px 80px;
        }
    }
    @media screen and (max-width:768px) and( min-width:426px){
        .footer{
            padding:30px 30px;
            grid-template-columns:1fr;
            grid-row-gap:30px;
            text-align: center;
            .column-one,.column-two,.column-three,.column-four{
                align-items: center;
                
            }
            .column-one{
                width:60%;
                margin:10px auto;
            }
        }
    }
    @media screen and (max-width:425px){
        .footer{
            padding:10px 10px;
            grid-template-columns:1fr;
            grid-row-gap:30px;
            text-align: center;
            h1{
                font-size: 15px;
            }
            .column-one,.column-two,.column-three,.column-four{
                align-items: center;
                a{
                    font-size:12px;
                }               
            }
            .column-one{
                width:80%;
                margin:10px auto;
                p{
                    font-size: 12px;
                }
            }
        }
    }
</style>