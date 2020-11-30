const state={
    openLeftMenu:false,
    banners:[
        {
            title:'Sale Of The Summer',
            link:'#',
            color:'255,165,0',
            image:'banner1.svg',
            features:[
                {
                    title:'Free Shipping',
                    icon:'',
                    description:'On purchases over $199'
                },
                {
                    title:'99% Satisfied Customers',
                    icon:'',
                    description:'Our clients opinions speak for themselves'
                },
                {
                    title:'Originality Guaranteed',
                    icon:'',
                    description:'30 days warranty for each product from our store'
                }
            ]
        },
        {
            title:'Make Your House Into A Home',
            link:'#',
            color:'144,238,144',
            image:'banner2.svg',
            features:[
                {
                    title:'Free Shipping',
                    icon:'',
                    description:'On purchases over $199'
                },
                {
                    title:'99% Satisfied Customers',
                    icon:'',
                    description:'Our clients opinions speak for themselves'
                },
                {
                    title:'Originality Guaranteed',
                    icon:'',
                    description:'30 days warranty for each product from our store'
                }
            ]
        }
    ],
    collections:[
        {
            name:'Men',
            image:'men.jpg',
            title:'New arrivals are now in!'
        },
        {
            name:'Women',
            image:'women.jpg',
            title:'Basic t-shirts!'
        },
        {
            name:'Kid',
            image:'kid.jpg',
            title:'Best Fashio for Kid!'
        }
    ],
    suggestedProducts:[],
    productToday:[],
    currentTypeFilter:[],
    currentColorFilter:[],
    products:[],
    loadingProduct:false,
    lastProductReach:false,
    cart:[],
    user:null
}

export default state