<template>
    <div class="container my-5">
        <div class="row">
            <div class="col">
                <h3 class="text-center">{{ title }}</h3>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props : {
        title: String,
    }
}
</script>
