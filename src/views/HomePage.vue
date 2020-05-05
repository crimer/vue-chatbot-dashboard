<template>
  <div>
    <CreateEditModal>
      <template #footer>
        <v-btn color="primary" @click="closeModal()">
          <v-icon>$vuetify.icons.arrorLeft</v-icon>
          Отмена
        </v-btn>
        <v-btn color="success" @click="saveModal(item)">
          Сохранить
          <v-icon class="ml-3">$vuetify.icons.send</v-icon>
        </v-btn>
      </template>
    </CreateEditModal>

    <DeleteModal @cancel-delete="cancelDelete" @yes-delete="yesDelete" title="Удалить вопрос?" text="Вы уверены? Вопрос будет удален навсегда"/> 
    
    <Table
      :head="headers"
      :data="questions"
      :loading="loading"
      expandable
      @add-new-item="addNewQuestion"
      @edit-item="editQuestion"
      @delete-item="deleteQuestion"
      @refresh-table="LOAD_ALL_ANSWERS"/>
  </div>
</template>

<script>
import { mapGetters, mapActions, mapMutations, mapState } from "vuex";
import CreateEditModal from "@/components/Modal/CreateEditModal.vue";
import DeleteModal from "@/components/Modal/DeleteModal.vue";
import Table from "@/components/Table.vue";

export default {
  name: "HomePage",
  components: { CreateEditModal, DeleteModal, Table },
  data() {
    return {
      modalValid: true,
      deleteKeyId: null,
      loading: true,
      modalRule: [v => !!v || "Поле обязательно"],
      headers: [
        { text: "Id", value: "id" },
        { text: "Вопрос", value: "text" },
        { text: "Действия", value: "action", sortable: false }
      ]
    };
  },
  computed: {
    ...mapState("questions", ["answers","questions", "isFirstDataLoaded"]),
    ...mapGetters("questions", ["GET_QUESTION_WITH_KEYS"]),
  },
  methods: {
    ...mapActions("questions", ["LOAD_ALL_QUESTIONS","LOAD_ALL_ANSWERS"]),
    ...mapActions("snackbar", ["OPEN_SNACKBAR"]),
    ...mapMutations("deleteModal", ["CLOSE_DELETE_MODAL", "OPEN_DELETE_MODAL"]),
    ...mapMutations("createEditModal", ["OPEN_MODAL", "CLOSE_MODAL"]),

    addNewQuestion(item) {
      this.OPEN_MODAL({ title: "Добавить вопрос", selectedItem: item });
    },
    editQuestion(item) {
      console.log(item);
      
      this.OPEN_MODAL({ title: "Изменить вопрос", selectedItem: item });
      // this.OPEN_SNACKBAR({ color: "success", text: "Вы изменили вопрос" });
    },
    deleteQuestion(item) {
      console.log(item);
      
      this.deleteKeyId = item.id;
      this.OPEN_DELETE_MODAL();
    },

    // create and edit modal
    closeModal() {
      this.CLOSE_MODAL();
    },
    saveModal(item) {
      // let validModal = this.$refs.modalForm.validate();
      // if (!validModal) return;
      console.log(item);
      this.CLOSE_MODAL();
    },


    // delete modal
    cancelDelete() {
      this.CLOSE_DELETE_MODAL();
      this.deleteKeyId = null;
    },
    async yesDelete() {
      await this.DELETE_KEY(this.deleteKeyId);
      this.CLOSE_DELETE_MODAL();
      this.OPEN_SNACKBAR({ color: "error", text: "Вы удалили ключ" });
      this.deleteKeyId = null;
    }
  },
  // первая загрузка данный
  mounted() {
    if (!this.isFirstDataLoaded) {
      this.loading = true;
      this.LOAD_ALL_QUESTIONS();
      this.LOAD_ALL_ANSWERS();
      this.loading = false;
    } else {
      console.log("questions already loaded");
      this.loading = false;
    }
    
  }
};
</script>
