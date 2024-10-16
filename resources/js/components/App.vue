<template>

    <div class="layout">
        <!-- Боковая панель -->
        <Navigation/>

        <!-- Основной контент -->
        <div class="main-content">
            <Header />
            <div class="conta">
                <Body/>
            </div>
        </div>
    </div>
<!--    <Header/>-->

<!--    <div class="conta">-->

<!--        <Body/>-->
<!--    </div>-->
<!--    <Footer/>-->
</template>

<script>
import Header from "./Header.vue";
import Navigation from "./Navigation.vue";
import Body from "./Body.vue";

export default {
    components: {Body, Navigation, Header}
}
</script>
<style scoped>

.conta{
    margin-left: 250px;
    margin-right: 2em;
}

</style>/
