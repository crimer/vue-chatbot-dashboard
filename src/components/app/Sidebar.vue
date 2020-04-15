<template>
  <v-navigation-drawer
    v-model="value"
    left
    stateless
    disable-resize-watcher
    touchless
    app
  >
    <v-list-item>
      <v-list-item-avatar color="grey">
        <v-img src="@/assets/svg/man.svg"></v-img>
      </v-list-item-avatar>
      <v-list-item-content>
        <v-list-item-title
          class="title"
        >Админ панель<br>Чат Бота</v-list-item-title>
      </v-list-item-content>
    </v-list-item>
    <v-list dense nav>
      <v-list-item v-for="(page, index) in pages" :key="index" :to="page.route">
        <v-list-item-icon>
          <v-icon>{{ page.icon }}</v-icon>
        </v-list-item-icon>

        <v-list-item-content>
          <v-list-item-title>
            {{ page.title }}
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list>
  </v-navigation-drawer>
</template>

<script>
export default {
  name: "Sidebar",
  props: {
    value: Boolean,
    pages:{
      required: true,
      value: Array,
    }
  },
  data() {
    return {};
  },
  
};
</script>

<style></style>
