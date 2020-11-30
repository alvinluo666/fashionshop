<template>
    <div class="home" @click="closeLeftMenu">
        <LeftNavigation activeLink="home"></LeftNavigation>
        
        <HomeTopSection></HomeTopSection> 
        <Collection></Collection>
        <SelectedForYou></SelectedForYou>
        <WhyChooseUs></WhyChooseUs>
        <ProductToday></ProductToday>
        <EmailSubscribe></EmailSubscribe>
        <Footer></Footer>
        <CopyRight></CopyRight>
    </div>
</template>
<script>
import { mapActions, mapMutations, mapState } from 'vuex'
import HomeTopSection from '../components/HomeTopSection.vue'
import LeftNavigation from '../components/LeftNavigation.vue'
import Collection from '../components/HomeCollection.vue'
import WhyChooseUs from '../components/WhyChooseUs.vue'
import EmailSubscribe from '../components/HomeEmailSubscribe.vue'
import Footer from '../components/Footer.vue'
import CopyRight from '../components/CopyRight.vue'
import SelectedForYou from '../components/SelectedForYou.vue'
import ProductToday from '../components/ProductToday.vue'
import Header from '../components/Header.vue'

export default{
    components:{
        HomeTopSection,
        LeftNavigation,
        Collection,
        WhyChooseUs,
        EmailSubscribe,
        Footer,
        CopyRight,
        SelectedForYou,
        ProductToday,
        Header
    },
    methods:{
        ...mapMutations([
            'closeLeftMenu',
        ]),
        ...mapActions([
            'getUser',
        ])
    },
    beforeMount(){
        this.getUser();
    }
}
</script>
<style lang="scss">
    .home{
        // z-index:-2
    }
    
</style>