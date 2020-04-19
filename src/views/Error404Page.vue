<template>
  <div class="notFound text-center">
    <h1 class="display-4 font-weight-light">404</h1>
    <p class="display-1 mt-5">
      OOps. Похоже страницы, которую вы ищите, нет.
    </p>
    <v-btn
      color="primary mt-5"
      width="200"
      height="50"
      rounded
      dark
      :to="{ path: '/' }"
    >
      На главную <v-icon right>$vuetify.icons.arrorRight</v-icon>
    </v-btn>
  </div>
</template>

<script>
export default {
  name: "Error404Page"
};
</script>

<style scoped lang="scss">
.notFound {
  position: relative;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
</style>
