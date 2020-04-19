<template>
  <div>
    <CreateEditModal>
      <template #body>
        <v-form v-model="modalValid" ref="modalForm">
          <div class="d-flex flex-column">
            <v-textarea
              :rules="modalRule"
              name="input-question"
              label="Вопрос"
              rows="1"
              auto-grow/>
          </div>
        </v-form>
      </template>
      <template #footer>
        <v-spacer/>
        <v-btn color="primary" @click="closeModal(item)">
          <v-icon>$vuetify.icons.arrorLeft</v-icon>
          Отмена
        </v-btn>
        <v-btn color="success" @click="saveModal(item)">
          Сохранить
          <v-icon class="ml-3">$vuetify.icons.send</v-icon>
        </v-btn>
      </template>
    </CreateEditModal>
    <Table
      :head="headers"
      :data="keysList"
      :loading="loading"
      @refresh-data="FETCH_ALL_KEYS"
    />
  </div>
</template>

<script>
import { mapActions, mapState } from "vuex";
import CreateEditModal from "@/components/CreateEditModal.vue";
import Table from "@/components/Table.vue";

export default {
  name: "KeysPage",
  components: { CreateEditModal, Table },
  data() {
    return {
      loading: false,
      headers: [
        { text: "Id", value: "id", align: "left" },
        { text: "Ключ", value: "key" },
        { text: "Действия", value: "action", sortable: false }
      ]
    };
  },
  computed: {
    ...mapState("keys", ["keysList", "isFirstDataLoaded"])
  },
  methods: {
    ...mapActions("keys", ["FETCH_ALL_KEYS"])
  },
  // первая загрузка данный
  mounted() {
    if (!this.isFirstDataLoaded) {
      this.loading = true;
      this.FETCH_ALL_KEYS();
      this.loading = false;
    } else {
      console.log("questions already loaded");
      this.loading = false;
    }
  }
};
</script>
