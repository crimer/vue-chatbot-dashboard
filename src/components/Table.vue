<template>
  <div>
    <v-data-table
      class="elevation-2"
      sort-by="id"
      loading-text="Загрузка..."
      no-data-text="Нет данных"
      no-results-text="Не найдено"
      hide-default-footer
      @page-count="pageCount = $event"
      :headers="head"
      :items="data"
      :search="searchByQuestion"
      :loading="loading"
      :page.sync="page"
      :items-per-page="itemsPerPage">
      <template #top>
        <v-toolbar flat color="white">
          <v-tooltip bottom>
            <template v-slot:activator="{ on }">
              <v-btn
                v-on="on"
                @click="$emit('add-new-item',item)"
                fab
                dark
                color="primary"
                small
                class="mr-5">
                <v-icon dark>$vuetify.icons.plus</v-icon>
              </v-btn>
            </template>
            <span>Добавить</span>
          </v-tooltip>
          <v-text-field
            v-model="searchByQuestion"
            label="Поиск по вопросу"
            append-icon="$vuetify.icons.search"
            hide-details
            style="max-width: 400px;">
          </v-text-field>

          <v-spacer></v-spacer>

          <v-tooltip bottom>
            <template v-slot:activator="{ on }">
              <v-btn
                v-on="on"
                @click="$emit('refresh-table')"
                fab
                dark
                color="success"
                small
                class="mr-5">
                <v-icon dark>$vuetify.icons.refresh</v-icon>
              </v-btn>
            </template>
            <span>Обновить</span>
          </v-tooltip>
        </v-toolbar>
      </template>
      <template #item.action="{ item }">
        <span class="d-flex">
          <v-tooltip top>
            <template v-slot:activator="{ on }">
              <v-btn
                v-on="on"
                @click="$emit('edit-item',item)"
                icon
                dark
                color="success"
                small
                class="mr-2">
                <v-icon dark>$vuetify.icons.edit</v-icon>
              </v-btn>
            </template>
            <span>Изменить</span>
          </v-tooltip>
          <v-tooltip top>
            <template v-slot:activator="{ on }">
              <v-btn
                v-on="on"
                @click="$emit('delete-item',item)"
                icon
                dark
                color="danger"
                small
                class="mr-2">
                <v-icon dark>$vuetify.icons.delete</v-icon>
              </v-btn>
            </template>
            <span>Удалить</span>
          </v-tooltip>
        </span>
      </template>
      <template #no-data>
        <v-btn color="primary" @click="$emit('refresh-table')">Перезагрузить</v-btn>
      </template>
    </v-data-table>
    <div class="text-center pt-2">
      <v-pagination v-model="page" :length="pageCount" total-visible="9">
      </v-pagination>
    </div>
  </div>
</template>

<script>
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
      // search
      searchByQuestion: "",
    };
  },
};
</script>

<style></style>
