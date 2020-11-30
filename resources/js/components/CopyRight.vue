<template>
    <div class="copy-right">
        <p>Coded By Alvin &copy; 1999 - {{currentYear}}.All Rights Reserved.</p>
    </div>
</template>
<script>
export default {
    data:function(){
        return {
            currentYear:(new Date()).getFullYear()
        }
    }
}
</script>
<style lang="scss">
    .copy-right{
        width:100%;
        text-align:center;
        font-size:12px;
        color:#808080;
        opacity:0.5;
        border-top:1px solid rgba($color: #000000, $alpha: 0.2);
        padding-top:10px;
    }
    @media screen and (max-width:425px){
        .copy-right{
            p{
                font-size: 10px;
            }
        }
    }
</style>