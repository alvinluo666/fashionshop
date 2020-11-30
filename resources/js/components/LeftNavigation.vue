<template>
    <div :class="[openLeftMenu?'open':'','left-nav']" @click.stop="leftMenu">
        <div class="close" @click.stop="closeLeftMenu">
            <i class="fas fa-times"></i>
        </div>
        <a @click.prevent="to('home')" :class="[activeLink=='home'?'active':'']">Home</a>
        <a @click.prevent="to('men')" :class="[activeLink=='men'?'active':'']">Men</a>
        <a @click.prevent="to('women')" :class="[activeLink=='women'?'active':'']">Women</a>
        <a @click.prevent="to('kid')" :class="[activeLink=='kid'?'active':'']">Kids</a>
    </div>
</template>
<script>
import { mapMutations, mapState } from 'vuex'
export default {
    props:[
        'activeLink'
    ],
    computed:{
        ...mapState([
            'openLeftMenu'
        ])
    },
    methods:{
        ...mapMutations([
            'toggleLeftMenu',
            'leftMenu',
            'closeLeftMenu'
        ]),
        to:function(url){
            window.location.href=config.BASE_URL+'/'+url;
        }
    }
}
</script>
<style lang="scss">
    .left-nav{
        display:none;
        position:fixed;
        width:250px;
        height:100%;
        left:-250px;
        background-color:white;
        z-index: 100;
        transition:0.5s all;
        flex-direction:column;
        align-items: center;
        justify-content:center;
        .close{
            position:absolute;
            right:10%;
            top:5%;
            i{
                color:black;
            }
            cursor:pointer;
        }
        a{
            text-decoration:none;
            padding:20px 0px;
            color:black;
            cursor:pointer;
        }
        a.active{
            color:orange;
        }
    }
    .left-nav.open{
        left:0;
        box-shadow:3px 0px 10px rgba($color: #000000, $alpha: 0.05)
    }
    @media screen and (max-width:425px) {
        .left-nav{
            display:flex;
        }
    }
</style>