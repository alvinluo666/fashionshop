<template>
    <div class="why-choose">
        <h2>Why should you choose us?</h2>
        <div class="reasons">
            <div class="reason">
                <img src="storage/assets/freeshipping.svg" alt="">
                <h4>Free Shipping</h4>
                <p>All purchases over $199 are eligible for free shipping via USPS First Class Mail.</p>
            </div>
            <div class="reason">
                <img src="storage/assets/payments.svg" alt="">
                <h4>Easy Payments</h4>
                <p>All payments are processed instantly over a secure payment protocol </p>
            </div>
            <div class="reason">
                <img src="storage/assets/money.svg" alt="">
                <h4>Money-Back Guarantee</h4>
                <p>If an item arrived damaged or you've changed your mind, you can send it back for a full refund.</p>
            </div>
            <div class="reason">
                <img src="storage/assets/quality.svg" alt="">
                <h4>Finest Quality </h4>
                <p>Designed to last, each of our products has been crafted with the finest materials.</p>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    
}
</script>
<style lang="scss">
    @import '../../sass/_variables.scss';
    .why-choose{
        padding:0px 100px $desktop-top-padding 100px;
        text-align: center;
        h2{
            margin-bottom:50px;
            font-weight: 200px;
        }
        .reasons{
            display:grid;
            grid-template-columns: auto auto auto auto;
            grid-column-gap:30px;
            .reason{
                display:flex;
                align-items: flex-start;
                flex-direction: column;
                h4{
                    padding:30px 0px 20px 0px;
                }
                p{
                    font-size: 13px;
                    text-align: left;
                    letter-spacing: 0.5px;
                    color:#808080;
                }
            }
        }
    }
    @media screen and (max-width:1024px) and( min-width:769px){
        .why-choose{
            padding:20px 80px;
        }
    }
    @media screen and (max-width:768px) and( min-width:426px){
        .why-choose{
            padding:30px 30px;
            .reasons{
                grid-template-columns: auto auto;
                grid-row-gap:40px;
                grid-column-gap: 20px;
                .reason{
                    align-items: center;
                    p{
                        width:70%;
                        text-align: center;
                    }
                }   
            }
        }
    }
    @media screen and (max-width:425px){
        .why-choose{
            padding:10px 10px;
            h2{
                font-size: 15px;
                margin-bottom:20px;
            }
            .reasons{
                grid-template-columns: auto;
                grid-row-gap:30px;
                .reason{
                    align-items: center;
                    h4{
                        padding:20px 0px 10px 0px;
                        font-size:14px;
                    }
                    p{
                        width:65%;
                        text-align:center;
                        font-size: 11px;
                        letter-spacing:0px;
                    }
                }
            }
        }
    }
</style>