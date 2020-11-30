const actions={
    getSuggestedProducts:function(context,products){
        fetch(config.BASE_URL+'/api/suggestedProducts',{
            headers:{
                authtoken:document.head.querySelector('meta[name="csrf-token"]')
            }
        })
        .then(response=>response.json())
        .then(data=>{
            context.commit('setSuggestedProducts',data)
        })
       
    },

    getProductToday:function(context,products){
        fetch('api/productToday',{
            headers:{
                authtoken:document.head.querySelector('meta[name="csrf-token"]')
            }
        })
        .then(response=>response.json())
        .then(data=>{
            context.commit('setProductToday',data);
        });
    },

    getCurrenTypeFilter:function(context,category){
        fetch('api/productType/'+category,{
            headers:{
                authtoken:document.head.querySelector('meta[name="csrf-token]"')
            }
        })
        .then(response=>response.json())
        .then(data=>{
            context.commit('setCurrentTypeFilter',data);
        })
    },

    getCurrentColorFilter:function(context,category){
        fetch('api/productColor/'+category,{
            headers:{
                authtoken:document.head.querySelector('meta[name="csrf-token"')
            }
        })
        .then(response=>response.json())
        .then(data=>{
            
                context.commit('setCurrentColorFilter',data);
        })
    },

    getProducts:function({commit,state},payload){
        // if(payload.currentPage!=1){
        //     state.lastProductReach=false;          
        // }
        if(!state.lastProductReach){//check if last Product reach
            fetch('api/products/'+payload.category+'?page='+payload.currentPage,{
                headers:{
                    authtoken:document.head.querySelector('meta[name="csrf-token"]'),
                    'Content-Type': 'application/json',
                },
            })
            .then(response=>response.json())
            .then(data=>{
                state.loadingProduct=false;
    
                commit('setProducts',data);
            })
        }
    },

    getShoppingCart:function(context){
        fetch(config.BASE_URL+'/api/cart',{
            headers:{
                authtoken:document.head.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
                
            },
        })
        .then(response=>response.json())
        .then(data=>{
            context.commit('setCart',data);
        })
    },

    getUser:function(context){
        fetch(config.BASE_URL+'/api/user',{
            headers:{
                authtoken:document.head.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
        })
        .then(response=>response.json())
        .then(data=>{
            context.commit('setUser',data);
        }).catch(e=>console.log(e.message))
       
    },
 
}

export default actions