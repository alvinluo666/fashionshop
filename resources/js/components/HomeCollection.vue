<template>
    <div class="collections">
        <div class="collection" v-for="collection in collections" :key="collection.name" :style="{backgroundImage:'url(storage/collection/'+collection.image+')'}">
            <h3>{{collection.title}}</h3>
            <div class="view-more">
                <span>View More</span>
            </div>
        </div>
    </div>
</template>
<script>
import { mapState } from 'vuex'

export default {
    computed:{
        ...mapState([
            'collections'
        ])
    }
}
</script>
<style lang="scss">
    @import '../../sass/_variables.scss';
    .collections{
        
        padding:$desktop-top-padding 100px;
        display:grid;
        grid-template-columns:3fr 2fr 2fr;
        margin:50px auto;
        grid-column-gap:30px;
        .collection{
        
            background:rgba($color: #000000, $alpha: 0.2);
            background-blend-mode:multiply;
            height:300px;
            background-size:cover;
            background-position:center;
            position:relative;
            display:flex;
            align-items:center;
            justify-content: center;
            flex-direction:column;
            overflow-y:hidden;
            cursor:pointer;
            h3{
                color:white;
                margin-bottom:20px;
            }
            .view-more{
                color:black;
                background:white;
                padding:10px 0;
                display:flex;
                align-items: center;
                justify-content: center;
                border-radius:25px;
                width:150px;
                position:absolute;
                transform:translateY(200px);
                transition: 0.3s all;
            }
            &:hover .view-more{
                transform:translateY(100%)
            }
        }
    }
    @media screen and (max-width:1024px) and( min-width:769px){
        .collections{
            margin:20px auto;
            padding:50px 80px;
        }
    }
    @media screen and (max-width:768px) and( min-width:426px){
        .collections{
            padding:10px 30px;
            grid-column-gap:15px;
            .collection{
                height:250px;
            }
        }
    }
    @media screen and (max-width:425px){
        .collections{
            margin:0px auto;
            padding:10px 10px;
            grid-column-gap:10px;
            grid-template-columns:1fr 1fr 1fr;
            .collection{
                height: 100px;
                h3{
                    font-size:12px;
                    width:70%;
                    text-align: center;
                }
                .view-more{
                    width:80px;
                    transform: translateY(110%);
                    font-size:10px;
                    padding:5px 0px;
                }
                &:hover .view-more{
                    transform:translateY(110%)
                }
            }
        }
    }
</style>