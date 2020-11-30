<template>
    <div class="product-filter">
        <!-- <div class="product-type">
            <div class="title" @click="openProductType=!openProductType">
                <span>PRODUCT TYPE</span>
                <i :class="['fas fa-chevron-down',openProductType?'open':'']"></i>
            </div>
            <div :class="['options',openProductType?'open':'']">
                <label v-for="type in currentTypeFilter" :key="type.id">
                     <input type="checkbox" name="type" :value="type.id" v-model="selectedType">
                    <div class="box">
                        <i class="fas fa-check"></i>
                    </div>
                   
                    <h4>{{type.title}}<span>({{type.products.length}})</span></h4>
                </label>
            </div>
        </div>
        <div class="divider" style="height:20px"></div>
        <div class="price">
            <div class="title" @click="openPrice=!openPrice">
                <span>PRICE</span>
                <i :class="['fas fa-chevron-down',openPrice?'open':'']"></i>                
            </div>
            <div :class="['price-slider',openPrice?'open':'']">
                <input type="range" id="input-left" min="0" max="10000" :value="currentMinPrice" @input="setMinRange"> 
                <input type="range" id="input-right" min="0" max="10000" :value="currentMaxPrice" @input="setMaxRange">
                <div class="slider">
                    <div class="track"></div>
                    <div class="range"></div>    
                    <div class="thumb left">
                        <span class="min-value">$&nbsp;{{currentMinPrice}}</span>
                    </div>
                    <div class="thumb right">
                        <span class="max-value">$&nbsp;{{currentMaxPrice}}</span>
                    </div>
                </div>              
            </div>
        </div>
         <div class="divider" style="height:20px"></div>
        <div class="product-size">
            <div class="title" @click="openSize=!openSize">
                <span>SIZE</span>
                <i :class="['fas fa-chevron-down',openSize?'open':'']"></i>
            </div>
            <div :class="['sizes',openSize?'open':'']">
                <div :class="['size',selectedSize.includes('XS')?'active':'']" @click="updateSize('XS')">XS</div>
                <div :class="['size',selectedSize.includes('S')?'active':'']" @click="updateSize('S')">S</div>
                <div :class="['size',selectedSize.includes('M')?'active':'']" @click="updateSize('M')">M</div>
                <div :class="['size',selectedSize.includes('L')?'active':'']" @click="updateSize('L')">L</div>
                <div :class="['size',selectedSize.includes('XL')?'active':'']" @click="updateSize('XL')">XL</div>
                <div :class="['size',selectedSize.includes('XXL')?'active':'']" @click="updateSize('XXL')">XXL</div>
            </div>
        </div>
         <div class="divider" style="height:20px"></div>
        <div class="product-color">
            <div class="title" @click="openColor=!openColor">
                <span>COLOR</span>
                <i :class="['fas fa-chevron-down',openColor?'open':'']"></i>
            </div>
            <div :class="['colors',openColor?'open':'']">
                <div v-for="color in currentColorFilter" :key="color" :class="['color',selectedColor.includes(color)?'active':'']" @click="updateColor(color)">
                    <div :style="{background:color}"></div>
                </div>
                
            </div>
        </div> -->
    </div>
</template>
<script>
import { mapActions, mapMutations, mapState } from 'vuex';
export default {
    data:function(){
        return {
            openProductType:false,
            openPrice:false,
            openSize:false,
            openColor:false,
            currentMinPrice:'0',
            currentMaxPrice:'10000', 
            selectedSize:[],
            selectedColor:[],
            selectedType:[],
            currentPage:1
        }
    },
    props:[
        'category'
    ],
    computed:{
         ...mapState([
                'currentTypeFilter',
                'currentColorFilter',
                'products',
                'loadingProduct',
                'lastProductReach'
            ]),
    },
    methods:{
        changeMinPrice(e){
            var locationX=e.clientX;
            
            var min=document.querySelector('.min');
            var minLeftX=min.getBoundingClientRect().x;
            min.style.left+=(locationX-minLeftX)+'px';
        },
        setMinRange(){
            var thumbLeft = document.querySelector('.left');
            var thumbRight = document.querySelector('.right');
            
            var inputLeft=document.querySelector('#input-left');
            var inputRight = document.querySelector('#input-right');

            var range = document.querySelector('.range');

            var currentValue = inputLeft.value;
            var min = parseInt(inputLeft.min);
            var max = parseInt(inputLeft.max);

            inputLeft.value = Math.min(parseInt(currentValue),parseInt(inputRight.value)-parseInt(max/10));

            this.currentMinPrice=inputLeft.value;

            var percent = ((inputLeft.value-min)/(max-min))*100;

            thumbLeft.style.left = percent +'%';
            range.style.left = percent +"%"
        },
        setMaxRange(){
            var thumbLeft=document.querySelector('.left');
            var thumbRight=document.querySelector('.right');

            var inputLeft=document.querySelector('#input-left');
            var inputRight = document.querySelector('#input-right');

            var range=document.querySelector('.range');

            var min = parseInt(inputRight.min);

         
            var max = parseInt(inputRight.max);
  

            inputRight.value = Math.max(parseInt(inputRight.value),parseInt(inputLeft.value)+parseInt(max/10));

            this.currentMaxPrice=parseInt(inputRight.value);

            var percent = ((inputRight.value-min)/(max-min))*100;
 
            thumbRight.style.right = (100- percent) +'%';

            range.style.right = (100 - percent)+'%';

            // console.log("right:"+inputRight.value)
            // console.log("left"+inputLeft.value)
        },
        updateSize(size){
            if(!this.selectedSize.includes(size)){
                this.selectedSize.push(size);
            }else{
                var index=this.selectedSize.indexOf(size);
                this.selectedSize.splice(index,1);
            }
        },
        updateColor(color){
            if(!this.selectedColor.includes(color)){
                this.selectedColor.push(color);
            }else{
                var index=this.selectedColor.indexOf(color);
                this.selectedColor.splice(index,1);
            }
        },
        
            ...mapMutations([
                'updateLoadingProductStatus'
            ]),
   
        ...mapActions([
            'getCurrenTypeFilter',
            'getCurrentColorFilter',
            'getProducts'
        ]),
         loadProduct(e) {
            // console.log('total '+(document.documentElement.scrollTop+window.innerHeight));
            // console.log('you-scroll '+ document.documentElement.scrollTop)
            // console.log('window-height '+window.innerHeight);
            // console.log('scroll-height '+document.documentElement.scrollHeight);
            var footer=document.querySelector('.footer').getBoundingClientRect().height+document.querySelector('.copy-right').getBoundingClientRect().height;
            if(document.documentElement.scrollTop+window.innerHeight>=document.documentElement.scrollHeight-footer){              
                if(!this.loadingProduct && !this.lastProductReach){// check is fetching data and wether last product reaches?
                    this.currentPage++;
                    this.updateLoadingProductStatus();//set loading to true while fetching data
                    this.getProducts({'category':this.category,'currentPage':this.currentPage});//payload to action
                }
            }

        }
    },
    mounted(){
        // this.setMinRange();                
        // this.setMaxRange();
        // this.getCurrenTypeFilter(this.category);
        // this.getCurrentColorFilter(this.category);
        this.getProducts({'category':this.category,'currentPage':this.currentPage});    
        document.addEventListener('scroll',this.loadProduct);

    }
}
</script>
<style lang="scss">
    .product-filter{
        flex:0;
        height:100vh;
        box-sizing: border-box;
        .product-type{
            width:100%;
            border:1px solid rgba($color:#E6E6E6, $alpha: 1);
            padding:20px;
            .title{
                display:flex;
                justify-content: space-between;
                align-items: center;
                cursor:pointer;
                span{
                    font-size:15px;
                }
                i{
                    transition: 0.3s all;
                }
                i.open{
                    transform: rotateX(180deg);
                }
            }
            .options{
                box-sizing: border-box;
                padding:0px;
                transition:0.3s all;
                max-height:0px;
                overflow-y:hidden;
                label{
                    display:flex;
                    align-items: center;
                    height:auto;
                    padding:0px 0px 15px 0px;
                    cursor: pointer;
                    .box{
                            width:20px;
                            height:20px;
                            display:flex;
                            justify-content: center;
                            align-items: center;
                            margin-right:10px;
                            border-radius:2px;
                            border:1px solid rgba($color:#E6E6E6, $alpha: 1);
                            i{
                                color:white;
                            }
                    }
                    input{
                        appearance:none;
                        
                        &:checked ~ .box i{
                            color:white; 
                            
                        }
                        &:checked ~ .box{
                            background-color:orange
                        } 
                    }
                    h4{
                        span{
                            color:rgba($color: #000000, $alpha: 0.5);
                            font-weight: lighter;
                            margin-left: 5px;
                        }
                    }
                }
            }
            .options.open{
                height:auto;
                max-height: 300px;
                overflow-y:hidden;
                padding:20px 0px 0px 0px;
            }
           
        }
        .price{ 
            width:100%;
            border:1px solid rgba($color: #000000, $alpha: 0.1);
            padding:20px 0px;
            .title{
                display:flex;
                justify-content: space-between;
                align-items: center;
                cursor:pointer;
                margin:0px 20px;
                span{
                    font-size:15px;
                }
                i{
                    transition: 0.3s all;
                }
                i.open{
                    transform: rotateX(180deg);
                }
            }
            .price-slider{
                padding:0px;
                position:relative;
                width:100%;
                max-height:0px;
                overflow-y:hidden;
                display:flex;
                justify-content: center;

                .slider{
                    position:relative;
                    z-index: 10;
                    height:3px;
                    margin: 0px 34px;//very important to make range work nice
                    width:80%;            
                    .track{
                        position: absolute;
                        z-index: 10;
                        left: 0;
                        right: 0;
                        bottom: 0;
                        top:0;
                        border-radius: 5px;
                        background: rgb(218, 218, 218);
                    }
                    .range{
                        position:absolute;
                        z-index: 11;
                        left:25%;
                        right:25%;
                        top:0;
                        bottom:0;
                        background: orange;
                    }
                    .thumb{
                        position:absolute;
                        z-index: 13;
                        width:14px;
                        height:14px;
                        background:white;
                        border:1px solid black;
                        border-radius:50%;
                        .min-value,.max-value{
                            display:inline;
                            position:absolute;
                            width:auto;
                            padding:2px 5px;
                            background:rgb(240, 240, 240);
                            display:flex;
                            align-items: center;
                            justify-content: center;
                            font-size: 10px;
                            border-radius:2px;
                        }
                        // transition:0.3s all;
                        
                    }
                    .left{
                        left:100%;
                        transform:translate(-7px,-5px);
                        .min-value{
                            top:-200%;
                            left:0;
                        }
                    }
                    .right{
                        right:20%;
                        transform:translate(7px,-5px);
                        .max-value{
                            top:200%;
                            right:0;
                        }
                    }
                    
                }
                input[type=range]{
                    position:absolute;
                    // top:30px;
                    pointer-events: none;
                    // -webkit-appearance: none;
                    width: 80%;
                    z-index: 12;
                    height: 3px;
                    opacity: 0;
                    cursor:pointer;
                }
                // input:first-child{
                //     top:60px;
                // }
                input[type=range]::-webkit-slider-thumb{
                    width:2px;
                    height:2px;
                    pointer-events: all;
                    border-radius: 0;
                    border:0 none;
                    background: black;
                    appearance: none;
                }
                
            }
            .price-slider.open{
                height:auto;
                padding:50px 0px 50px 0px;
                max-height: 300px;
            }
        }
        .product-size{
            width:100%;
            border:1px solid rgba($color:#E6E6E6, $alpha: 1.0);
            padding:20px;
            .title{
                display: flex;
                justify-content:space-between;
                align-items: center;
                cursor:pointer;
                span{
                    font-size:15px;
                }
                i{
                    transition: 0.3s all;
                }
                i.open{
                    transform: rotateX(180deg);
                }
            }
            .sizes{
                display:grid;
                grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr;
                grid-column-gap:4px;
                grid-row-gap:4px;
                transition: 0.3s all;
                max-height:0px;
                overflow:hidden;
                padding:0px;
                .size{
                    display:flex;
                    align-items: center;
                    justify-content: center;
                    border:0.5px solid #D4D4D4;
                    cursor:pointer;
                    padding:6px 0px;
                    font-weight:bold;
                }
                .size.active{
                    border:1px solid orange;
                }
            }
            .sizes.open{
                height:auto;
                max-height: 300px;
                padding:20px 0px 0px;
            }
        }
        .product-color{
            width:100%;
            border:1px solid rgba($color:#E6E6E6, $alpha: 1.0);
            padding:20px;
            .title{
                display:flex;
                justify-content: space-between;
                align-items: center;
                cursor:pointer;
                span{
                    font-size:15px;
                }
                i{
                    transition: 0.3s all;
                } 
                i.open{
                    transform: rotateX(180deg);
                }
            }
            .colors{
                display:grid;
                grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr;
                grid-column-gap:4px;
                grid-row-gap:4px;
                transition: 0.3s all;
                max-height:0px;
                overflow:hidden;
                padding:0px;
                .color{
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    border:0.5px solid #D4D4D4;
                    width:100%;
                    cursor:pointer;
                    padding:6px 0px;
                    div{
                        width:50%;
                        height:30px;
                        display:block;
                    }
                }
                .color.active{
                    // background:rgb(243, 243, 243);
                    border:1px solid orange;
                }
            }
            .colors.open{
                height:auto;
                max-height:300px;
                padding:20px 0px 0px;
            }
        }
    }
    
</style>