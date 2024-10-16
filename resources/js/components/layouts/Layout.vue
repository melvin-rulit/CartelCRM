<!--<template>-->
<!--  <div class="layout">-->
<!--    &lt;!&ndash; Боковая панель &ndash;&gt;-->
<!--    <Navigation />-->

<!--    &lt;!&ndash; Основной контент &ndash;&gt;-->
<!--    <div class="main-content">-->
<!--      <Header />-->
<!--        <main class="content">-->
<!--        <router-view />-->
<!--      </main>-->
<!--    </div>-->
<!--  </div>-->
<!--</template>-->

<!--<script>-->
<!--import Header from "../Header.vue";-->
<!--import Navigation from "../Navigation.vue";-->

<!--export default {-->
<!--  components: {Navigation, Header },-->
<!--};-->
<!--</script>-->

<!--<style lang="scss" scoped>-->
<!--.layout {-->
<!--  display: flex;-->
<!--  min-height: 100vh;-->

<!--  .main-content {-->
<!--    margin-left: 290px;-->
<!--    flex: 1;-->
<!--    display: flex;-->
<!--    flex-direction: column;-->
<!--    background-color: #f4f4f4;-->
<!--    padding: 1em;-->

<!--    .content {-->
<!--      padding: 20px 0;-->
<!--    }-->
<!--  }-->
<!--}-->
<!--</style>-->

<template>
    <div class="layout">
        <!-- Боковая панель -->
        <Navigation />

        <!-- Основной контент -->
        <div class="main-content">
            <div class="content">
                <router-view />
            </div>
        </div>
    </div>
</template>

<script >
import Navigation from "../Navigation.vue"

export default {
    components: {Navigation},
}
</script>

<style lang="scss" scoped>
.layout {
    display: flex;
    min-height: 100vh;

    .main-content {
        margin-left: 290px;
        flex: 1;
        display: flex;
        flex-direction: column;
        background-color: #f9fbfd;
        padding: 0 1em;

        .content {
            padding: 0;
        }
    }
}
</style>

