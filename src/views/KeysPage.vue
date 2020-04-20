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
      @add-new-item="addNewKey"
      @edit-item="editKey"
      @delete-item="deleteKey"
      @refresh-table="FETCH_ALL_KEYS"
    />
  </div>
</template>

<script>
import { mapGetters, mapActions, mapMutations, mapState } from "vuex";
import CreateEditModal from "@/components/Modal/CreateEditModal.vue";
import Table from "@/components/Table.vue";

export default {
  name: "KeysPage",
  components: { CreateEditModal, Table },
  data() {
    return {
      modalValid: true,
      loading: false,
      modalRule: [
        v => !!v || 'Поле обязательно',
      ],
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
    ...mapActions("keys", ["FETCH_ALL_KEYS"]),
    ...mapActions("questions", ["LOAD_QUESTIONS"]),
    ...mapMutations("questions", ["SET_SELECTED_QUESTION_ID"]),
    ...mapMutations("modal", ["OPEN_MODAL","CLOSE_MODAL"]),
    ...mapActions("snackbar", ["OPEN_SNACKBAR"]),

    addNewKey() {
      this.OPEN_MODAL("Добавить вопрос");
    },
    editKey(item) {
      this.SET_SELECTED_QUESTION_ID(item.id);
      this.OPEN_MODAL('Изменить вопрос');
    },
    deleteKey(item) {
      console.log(item);
      this.OPEN_SNACKBAR({ color: "error", text: "Вы удалили вопрос" });
    },
    // MODAL
    closeModal(item){
      console.log(item);
      
      this.CLOSE_MODAL();
    },
    saveModal(item){
      let validModal = this.$refs.modalForm.validate();
      if(!validModal) return;

      console.log(item);
      
      this.CLOSE_MODAL();
    }
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
