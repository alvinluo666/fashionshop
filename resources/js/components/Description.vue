<template>
    <div class="description">
        <i class="fas fa-book"></i>
        <h3>Your description go here</h3>
    </div>
</template>
<script>
export default {
    props:[
        'product'
    ]
}

</script>
<style lang="scss" scoped>
    .description{
        height:300px;
        display:flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        opacity:0.4;
        i{
            font-size:50px;
            margin-bottom:20px;
        }
    }
</style>