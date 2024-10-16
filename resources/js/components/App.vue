<template>

    <div class="layout">
        <!-- Боковая панель -->
        <Navigation/>

        <!-- Основной контент -->
        <div class="main-content">
<!--            <Header />-->
            <div class="content">
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
<style lang="scss" scoped>
.layout {
    display: flex;
    min-height: 100vh;

    .main-content {
        margin-left: 250px;
        flex: 1;
        display: flex;
        flex-direction: column;
        background-color: #f4f4f4;
        padding: 1em;

        .content {
            padding: 20px;
        }
    }
}
</style>

