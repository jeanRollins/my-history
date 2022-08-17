<template>
    <div class="w-100">
        <Menu />
        <router-view> </router-view>
    </div>
</template>

<script>
import Menu from "../components/auth/Menu";
export default {
    name: "DashboardPageComponent",
    components: {Menu}
}
</script>

<style scoped>

</style>
