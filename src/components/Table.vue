<template>
  <div>
    <v-data-table
      class="elevation-2"
      sort-by="id"
      loading-text="Загрузка..."
      no-data-text="Нет данных"
      no-results-text="Не найдено"
      show-select
      hide-default-footer
      @page-count="pageCount = $event"
      :headers="head"
      :items="data"
      :search="searchByQuestion"
      :loading="loading"
      :page.sync="page"
      :items-per-page="itemsPerPage"
    >
      <template #top>
        <v-toolbar flat color="white">
          <!-- TODO: доделать иконки у поисков  и добавить max-width к поиску-->
          <v-tooltip bottom>
            <template v-slot:activator="{ on }">
              <v-btn
                v-on="on"
                @click="addNewItem()"
                fab
                dark
                color="primary"
                small
                class="mr-5"
              >
                <v-icon dark>$vuetify.icons.plus</v-icon>
              </v-btn>
            </template>
            <span>Add new</span>
          </v-tooltip>
          <v-tooltip bottom>
            <template v-slot:activator="{ on }">
              <v-btn
                v-on="on"
                @click="deleteSelected()"
                fab
                dark
                color="danger"
                small
                class="mr-5"
              >
                <v-icon dark>$vuetify.icons.delete</v-icon>
              </v-btn>
            </template>
            <span>Delete selected</span>
          </v-tooltip>

          <v-text-field
            v-model="searchByQuestion"
            label="Поиск по вопросу"
            append-icon="$vuetify.icons.search"
            hide-details
            style="max-width: 400px;"
          >
          </v-text-field>

          <v-spacer></v-spacer>

          <v-tooltip bottom>
            <template v-slot:activator="{ on }">
              <v-btn
                v-on="on"
                @click="$emit('refresh-data')"
                fab
                dark
                color="success"
                small
                class="mr-5"
              >
                <v-icon dark>$vuetify.icons.refresh</v-icon>
              </v-btn>
            </template>
            <span>Refresh</span>
          </v-tooltip>
        </v-toolbar>
      </template>
      <template #item.action="{ item }">
        <span class="d-flex">
          <v-tooltip top>
            <template v-slot:activator="{ on }">
              <v-btn
                v-on="on"
                @click="editItem(item)"
                icon
                dark
                color="success"
                small
                class="mr-2"
              >
                <v-icon dark>$vuetify.icons.edit</v-icon>
              </v-btn>
            </template>
            <span>Edit</span>
          </v-tooltip>
          <v-tooltip top>
            <template v-slot:activator="{ on }">
              <v-btn
                v-on="on"
                @click="deleteItem(item)"
                icon
                dark
                color="danger"
                small
                class="mr-2"
              >
                <v-icon dark>$vuetify.icons.delete</v-icon>
              </v-btn>
            </template>
            <span>Delete</span>
          </v-tooltip>
        </span>
      </template>
      <template #no-data>
        <v-btn color="primary" @click="refresh">Перезагрузить</v-btn>
      </template>
    </v-data-table>
    <div class="text-center pt-2">
      <v-pagination v-model="page" :length="pageCount" total-visible="9">
      </v-pagination>
      <!-- <v-text-field
                :value="itemsPerPage"
                label="Items per page"
                type="number"
                min="-1"
                max="15"
                @input="itemsPerPage = parseInt($event, 10)"></v-text-field> -->
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions, mapMutations, mapState } from "vuex";
export default {
  name: "Table",
  props: {
    head: {
      type: Array,
      required: true
    },
    data: {
      type: Array,
      required: true
    },
    loading: {
      type: Boolean,
      required: true
    }
  },
  data() {
    return {
      // pagination
      page: 1,
      pageCount: 0,
      itemsPerPage: 10,

      searchByQuestion: "",
      dialog: false,
      questionIndex: -1,
      questionItem: {}
    };
  },
  methods: {
    ...mapActions("QuestionsStore", ["LOAD_QUESTIONS"]),
    ...mapMutations("CreateEditModal", ["OPEN_MODAL"]),
    ...mapActions("SnackbarStore", ["OPEN_SNACKBAR"]),

    addNewItem() {
      this.OPEN_MODAL("New question");
    },
    editItem(item) {
      // console.log(item);
      this.OPEN_SNACKBAR({ color: "success", text: "Вы изменили вопрос" });
    },
    deleteItem(item) {
      console.log("del");
      // console.log(item);
      this.OPEN_SNACKBAR({ color: "error", text: "Вы удалили вопрос" });
    },
    deleteSelected() {},
    refresh() {
      this.LOAD_QUESTIONS();
      console.log("refreshed");
    }
  }
};
</script>

<style></style>
