<template>
  <div>
    <v-data-table
      class="elevation-2"
      loading-text="Загрузка..."
      no-data-text="Нет данных"
      no-results-text="Не найдено"
      single-expand
      :show-expand="expandable"
      :headers="head"
      :items="data"
      :search="searchByQuestion"
      :loading="loading"
      :page.sync="page"
      :items-per-page="10"
    >
      <template #top>
        <v-toolbar flat color="white">
          <v-tooltip bottom>
            <template #activator="{ on }">
              <v-btn
                v-on="on"
                @click="$emit('add-new-item')"
                fab
                dark
                color="primary"
                small
                class="mr-5"
              >
                <v-icon dark>$vuetify.icons.plus</v-icon>
              </v-btn>
            </template>
            <span>Добавить</span>
          </v-tooltip>
          <v-text-field
            v-model="searchByQuestion"
            label="Поиск"
            append-icon="$vuetify.icons.search"
            hide-details
            style="max-width: 400px;"
          >
          </v-text-field>

          <v-spacer></v-spacer>

          <v-tooltip bottom>
            <template #activator="{ on }">
              <v-btn
                v-on="on"
                @click="$emit('refresh-table')"
                fab
                dark
                color="success"
                small
                class="mr-5"
              >
                <v-icon dark>$vuetify.icons.refresh</v-icon>
              </v-btn>
            </template>
            <span>Обновить</span>
          </v-tooltip>
        </v-toolbar>
      </template>
      <template #expanded-item="{ headers, item }" v-if="expandable">
        <td :colspan="headers.length">
          <div v-if="item.count === 0">
            <v-subheader>Варианты ответа:</v-subheader>
              <v-list-item dense>
                <v-list-item-content>
                  <v-list-item-title
                    >У этого вопроса нет вариантов ответа</v-list-item-title
                  >
                </v-list-item-content>
              </v-list-item>
          </div>
          <div v-else>
            <v-subheader>Варианты ответа:</v-subheader>
              <v-list-item v-for="answer in item.answers" :key="answer.id" dense>
                <v-list-item-content>
                  <v-list-item-title>{{ answer.text }}</v-list-item-title>
                </v-list-item-content>
              </v-list-item>
          </div>
        </td>
      </template>
      <template #item.action="{ item }">
        <span class="d-flex">
          <v-tooltip top v-if="editable">
            <template #activator="{ on }">
              <v-btn
                v-on="on"
                @click="$emit('edit-item', item)"
                icon
                dark
                color="success"
                small
                class="mr-2"
              >
                <v-icon dark>$vuetify.icons.edit</v-icon>
              </v-btn>
            </template>
            <span>Изменить</span>
          </v-tooltip>

          <v-tooltip top>
            <template #activator="{ on }">
              <v-btn
                v-on="on"
                @click="$emit('delete-item', item)"
                icon
                dark
                color="danger"
                small
                class="mr-2"
              >
                <v-icon dark>$vuetify.icons.delete</v-icon>
              </v-btn>
            </template>
            <span>Удалить</span>
          </v-tooltip>
        </span>
      </template>

      <template #no-data>
        <v-btn color="primary" @click="$emit('refresh-table')"
          >Перезагрузить</v-btn
        >
      </template>
    </v-data-table>
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
    },
    editable: {
      type: Boolean,
      default: true
    },
    expandable: {
      type: Boolean,
      default: false
    }
  },
  data() {
    return {
      // pagination
      page: 1,
      pageCount: 0,
      itemsPerPage: 10,
      // search
      searchByQuestion: ""
    };
  }
};
</script>

<style></style>
