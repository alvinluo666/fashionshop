<template>
    <div class="reviews" >
        <div class="filter">
            <span :class="[selectedReviewFilter=='all'?'active':'']" @click="filterReview('all')">All</span>
            <span :class="[selectedReviewFilter=='good'?'active':'']" @click="filterReview('good')">Good</span>
            <span :class="[selectedReviewFilter=='bad'?'active':'']" @click="filterReview('bad')">Bad</span>
        </div>
        <div class="review" v-for="review in reviews" :key="review.id">
            <div class="info">
                <div class="avator">
                    <div class="img">
                        <img :src="review.user.avator" alt="">
                    </div>
                    <div class="name-date">
                        <span class="name">{{review.user.name}}</span>
                        <div style="height:4px;"></div>
                        <span class="date">{{convertDate(review.created_at)}}</span>
                    </div>
                </div>
                
                <div class="rating">
                    <i class="fas fa-star" v-for="n in review.rating" :key="n"></i>
                    <i class="far fa-star" v-for="n in 5-review.rating" :key="n+'bad'"></i>
                </div>
            </div>
            <div class="message">
                <p>{{review.message}}</p>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:[
        'product',
        
    ],
    data:function(){
      return {
            'reviews':[],//after filter
            'selectedReviewFilter':'all'
        }
    },
    methods:{
        convertDate:function(date){
            var date=new Date(date)
            var day=date.getDate();
            var month=date.getMonth();
            var year=date.getFullYear();
            return day+'.'+month+'.'+year;
        },
        filterReview:function(filter){
            this.selectedReviewFilter=filter;
            if(this.selectedReviewFilter=='all'){
                this.reviews=this.product.reviews;
            }
            if(this.selectedReviewFilter=='good'){
                this.reviews=this.product.reviews.filter((review)=>{
                    return review.rating>2;
                })
            }
            if(this.selectedReviewFilter=='bad'){
                this.reviews=this.product.reviews.filter((review)=>{
                    return review.rating<3;
                })
            }
        }
    },
    computed:{
        
    },
    mounted(){
        this.filterReview('all');
    }
}

</script>
<style lang="scss" scoped>
    .reviews{
        height:auto;
        width:60%;
        margin-top:10px;
        margin-bottom:30px;
        .filter{
            padding:20px 0px;
            span{
                padding:2px 25px;
                cursor:pointer;
            }
            span.active{
                color:orange;
                background:rgb(245, 245, 245);
            }
        }
        .review{
            .info{
                display:flex;
                justify-content: space-between;
                align-items: center;
                .avator{
                    display:flex;
                    align-items: center;
                    .img{
                        width:50px;
                        height:50px;
                        margin-right:12px;
                        img{
                            width:100%;
                            height:100%;
                            border-radius:25px;
                        }
                    }
                    .name-date{
                        display: flex;
                        flex-direction: column;
                        align-items: flex-start;
                        .name{
                            font-weight: bold;
                        }
                        .date{
                            font-size: 12px;
                            opacity:0.5;
                        }
                    }
                }
                .rating{
                    i{
                        color:red;
                        padding:0px 2px;
                    }
                }
            }
            .message{
                padding:15px 15px 25px 15px;
                opacity:0.9;
            }
        }
    }
     @media screen and (max-width:768px) and( min-width:426px){
         .reviews{
             width:80%
         }
     }
     @media screen and (max-width:425px){
         .reviews{
             width:100%;
             padding:0px 10px;
             .review{
                 .info{
                     .avator{
                        .img{
                            width:40px;
                            height:40px;
                        }
                        .name-date{
                            .name{
                                font-size:12px;
                            }
                            .date{
                                font-size: 10px;
                            }
                        }
                     }
                     .rating{
                         i{
                             font-size:10px;
                             padding:0px 1px;
                         }
                     }
                 }
                 .message{
                     padding:10px 10px 20px 10px;
                 }
             }
         }
     }
</style>