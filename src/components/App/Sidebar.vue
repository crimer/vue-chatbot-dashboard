<template>
  <v-navigation-drawer
    v-model="value"
    left
    stateless
    disable-resize-watcher
    touchless
    app
  >
    <v-list dense nav>
      <v-list-item>
        <v-list-item-avatar>
          <v-img src="@/assets/svg/man.svg"></v-img>
        </v-list-item-avatar>
        <v-list-item-content>
          <v-list-item-title class="title">
            <p>Админ панель</p>
            <p>Чат Бота</p>
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>

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
import { mapGetters } from "vuex";
export default {
  name: "Sidebar",
  props: {
    value: Boolean
  },
  computed: {
    ...mapGetters("keys", ["IS_ADMIN"])
  },
  data() {
    return {
      pages: [
        {
          title: "Таблица ключей",
          icon: "$vuetify.icons.key",
          route: "/keystable"
        },
        {
          title: "Таблица ответов",
          icon: "$vuetify.icons.table",
          route: "/",
          exact: true
        },
        {
          title: "Дерево вопросов",
          icon: "$vuetify.icons.tree",
          route: "/tree"
        },
        {
          title: "Добавить вопрос",
          icon: "$vuetify.icons.question",
          route: "/addQuestion",
          exact: true
        },
        {
          title: "Добавить ответ",
          icon: "$vuetify.icons.answer",
          route: "/addAnswers",
          exact: true
        },
      ]
    };
  }
};
</script>

<style></style>
