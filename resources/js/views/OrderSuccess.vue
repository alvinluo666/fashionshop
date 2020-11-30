<template>
    <div>
        <Header :scrollOverTopSection="true"></Header>
        <div class="message">
            <img src="storage/assets/ordersuccess.png" alt="">
            <span>Thank You!</span>
        </div>
    </div>
</template>
<script>
import Header from '../components/Header.vue';
export default {
    components:{
        Header
    },
    
}
</script>
<style lang="scss" scoped>
    div{
        div.message{
            display:flex;
            align-items:center;
            justify-content: center;
            flex-direction:column;
            height:100vh;
            img{
                width:200px;
            }
            span{
                font-size:20px;
                margin-top:20px;
            }
        }
    }
</style>