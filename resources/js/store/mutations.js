import { forEach } from "lodash";

const mutations={
    toggleLeftMenu:function(state){
        state.openLeftMenu=!state.openLeftMenu
    },
    closeLeftMenu:function(state){
        state.openLeftMenu=false;
    },
    leftMenu:function(state){
        state.openLeftMenu=true;
    },

    setSuggestedProducts(state,products){
        state.suggestedProducts=products;
    },
    setProductToday(state,products){
        state.productToday=products;
    },

    setCurrentTypeFilter(state,types){
        state.currentTypeFilter=types;
        // console.log(types)
    },

    setCurrentColorFilter(state,colors){
        var colorSet=new Set();
        colors.forEach((color)=>{
            color.forEach(c=>colorSet.add(c));
        })
        var result=[...colorSet];
        state.currentColorFilter=result;
    },
    setProducts(state,products){
            if(products.data.length>0){
                products.data.forEach((product)=>{
                    if(!state.products.includes(product)){
                        state.products.push(product);
                    }
                })
           }else{
               state.lastProductReach=true;
           }
        
       
        
    },
    updateLoadingProductStatus(state){
        state.loadingProduct=true;
    },
    setCart(state,cart){
        state.cart=cart;
    },
    setUser(state,user){
        if(user){
            state.user=user;
        }else{
            state.user=null;
        }
    }

}

export default mutations