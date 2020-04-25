<template>
  <div>
    <CreateEditModal>
      <template #body>
        <v-form v-model="modalValid" ref="modalForm">
          <div class="d-flex flex-column">
            <v-textarea
              v-model="modalData.title"
              :rules="modalRule"
              name="input-question"
              label="Ключ"
              rows="1"
              auto-grow
            />
          </div>
        </v-form>
      </template>
      <template #footer>
        <v-spacer />
        <v-btn color="primary" @click="closeModal(item)">
          <v-icon>$vuetify.icons.arrorLeft</v-icon>
          Отмена
        </v-btn>
        <v-btn color="success" :disabled="!modalValid" @click="saveModal(modalData.title)">
          Сохранить
          <v-icon class="ml-3">$vuetify.icons.send</v-icon>
        </v-btn>
      </template>
    </CreateEditModal>
    <DeleteModal
      @cancel-delete="cancelDelete"
      @yes-delete="yesDelete"
      text="Вы уверены? Ключ будет удален навсегда"
    />
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
import DeleteModal from "@/components/Modal/DeleteModal.vue";
import Table from "@/components/Table.vue";

export default {
  name: "KeysPage",
  components: { CreateEditModal, DeleteModal, Table },
  data() {
    return {
      modalValid: false,
      loading: false,
      modalRule: [
        v => !!v || "Поле обязательно",
        v => (v && v.length >= 6) || "Ключ должен быть больше чем 6 символов"
      ],
      headers: [
        { text: "Id", value: "id", align: "left" },
        { text: "Ключ", value: "key" },
        { text: "Действия", value: "action", sortable: false }
      ]
    };
  },
  computed: {
    ...mapState("keys", ["keysList", "isFirstDataLoaded"]),
    ...mapState("createEditModal", ["modalData"])
  },
  methods: {
    ...mapActions("keys", ["FETCH_ALL_KEYS"]),
    ...mapActions("questions", ["LOAD_QUESTIONS"]),
    ...mapMutations("questions", ["SET_SELECTED_QUESTION_ID"]),
    ...mapMutations("createEditModal", ["OPEN_MODAL", "CLOSE_MODAL"]),
    ...mapMutations("deleteModal", ["CLOSE_DELETE_MODAL", "OPEN_DELETE_MODAL"]),
    ...mapActions("snackbar", ["OPEN_SNACKBAR"]),
    // table
    addNewKey() {
      this.OPEN_MODAL({ title: "Добавить ключ", selectedItem: {} });
    },
    editKey(item) {
      this.OPEN_MODAL({ title: "Изменить ключ", selectedItem: item });
    },
    deleteKey(item) {
      this.OPEN_DELETE_MODAL("Удалить ключ?");
      // this.OPEN_SNACKBAR({ color: "error", text: "Вы удалили вопрос" });
    },
    // create and edit modals
    closeModal(item) {
      console.log(item);

      this.CLOSE_MODAL();
    },
    saveModal(item) {
      let validModal = this.$refs.modalForm.validate();
      if (!validModal) return;
      console.log(item);
      this.CLOSE_MODAL();
    },
    // delete modal
    cancelDelete() {
      console.log("cancel deleting");
      this.CLOSE_DELETE_MODAL();
    },
    yesDelete() {
      console.log("yes delete");
      this.CLOSE_DELETE_MODAL();
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
