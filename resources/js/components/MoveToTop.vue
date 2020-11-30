<template>
    <div :class="['move-to-top',showMoveToTop?'active':'']" @click="moveToTop">
        <i class="fas fa-fighter-jet"></i>
    </div>
</template>
<script>
export default {
    data:function(){
        return {
            showMoveToTop:false
        }
    },
    methods:{
        moveToTop:function(){
            window.scrollTo(0,0);
        }
    },
    mounted(){
        var ref=this;
        document.addEventListener('scroll',function(){
            if(document.documentElement.scrollTop>window.innerHeight){  
                ref.$nextTick(function(){
                    this.showMoveToTop=true;
                })
                
            }else{
                ref.$nextTick(function(){
                    this.showMoveToTop=false;
                })
            }
        })
    }
}
</script>
<style lang="scss">
    html{
        scroll-behavior: smooth;
    }
    .move-to-top{
            transition: 0.5s all;
            transform:scale(0);
    }
    .move-to-top.active{
        position:fixed;
        z-index:200;
        border-radius:50px;
        background:orange;
        display:flex;
        align-items:center;
        justify-content: center;
        width:60px;
        height:60px;
        box-shadow: 0px 4px 6px rgba($color: #000000, $alpha: 0.1);
        top:80%;
        left:90%;     
        transform:scale(1);
        cursor:pointer;
        i{
            transform: rotateZ(-90deg);
            color:white;
        }
        &:hover{
            transform:scale(1.1)
        }
    }
    @media screen and (max-width:425px){
        .move-to-top.active{
            width:50px;
            height:50px;
            left:80%;
        }
    }
    
</style>