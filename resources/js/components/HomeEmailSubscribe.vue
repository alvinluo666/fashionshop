<template>
    <div class="email-subscribe" style="background-image:url('storage/assets/emailSubscribe.svg')">
        <p>Subscribe to our newsletter and receive exclusive offers every week</p>
        <div class="form">
            <input type="text" placeholder="Enter your email">
            <span class="submit">
                SUBSCRIBE
            </span>
        </div>
    </div>
</template>
<script>
export default {
    
}
</script>
<style lang="scss">
    .email-subscribe{
        margin:50px 100px;
        height: 200px; 
        box-sizing: border-box;
        display:flex;
        justify-content: space-around;
        align-items: center;
        background:rgba($color: #000000, $alpha: 0.5);
        background-blend-mode: multiply;
        p{
            color:white;
            font-size: 20px;
            flex:1;
            text-align:center;
            width:70%;
            padding:0px 100px; 
        }
        div.form{
            flex:1;
            display:flex;
            input{
                padding:10px 20px;
                border-radius: 25px;
                background:white;
                outline:none;
                border:none;
                width:50%;
            }
            span{
                cursor:pointer;
                padding:10px 15px;
                background:orange;
                color:black;
                border-radius:25px;
                margin-left:15px;
            }
        }
    }
    @media screen and (max-width:1024px) and( min-width:769px){
        .email-subscribe{
            margin:20px 80px;
            input{
                width:80%;
            }
            span{
                font-size: 13px;
            }
        }
    }
    @media screen and (max-width:768px) and( min-width:426px){
        .email-subscribe{
            flex-direction: column;
            margin:30px 30px;
            justify-content: center;
            p{
                font-size:15px;
                padding:20px 0px 0px 0px;
                width:60%
            }
            .form{
                align-items: flex-start;
                width:100%;
                justify-content: center;
                input{
                    width:70%;
                }
                span{
                    font-size: 12px;
                }
            }
        }
    }
    @media screen and (max-width:425px){
        .email-subscribe{
            margin:20px 10px;
            flex-direction: column;
            justify-content: center;
            height: 150px;
            p{
                font-size:12px;
                width:80%;
                padding:40px 0px 0px 0px;
            }
            .form{
                align-items: flex-start;
                width:100%;
                justify-content: center;
                input{
                    width:70%;
                    padding:2px;
                    font-size:10px;
                }
                span{
                    margin-left:10px;
                    font-size: 10px;
                }
            }
        }
    }
</style>