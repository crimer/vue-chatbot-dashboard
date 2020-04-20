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
              label="Вопрос"
              rows="1"
              auto-grow
            />
            <v-textarea
              v-model="modalData.body"
              :rules="modalRule"
              name="input-answer"
              label="Ответ"
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
        <v-btn color="success" @click="saveModal(item)">
          Сохранить
          <v-icon class="ml-3">$vuetify.icons.send</v-icon>
        </v-btn>
      </template>
    </CreateEditModal>
    <DeleteModal>
      <template #body>
        <v-form v-model="modalValid" ref="modalForm">
          <div class="d-flex flex-column">
            <p>Вы уверены?</p>
            <p>Вопрос будет удален навсегда</p>
          </div>
        </v-form>
      </template>
      <template #footer>
        <v-spacer />
        <v-btn color="success" @click="cancelModal(item)">
          <v-icon>$vuetify.icons.arrorLeft</v-icon>
          Отменить
        </v-btn>
        <v-btn color="danger" @click="deleteModal(item)">
          Удалить
          <v-icon class="ml-3">$vuetify.icons.send</v-icon>
        </v-btn>
      </template>
    </DeleteModal>
    <Table
      :head="headers"
      :data="questions"
      :loading="loading"
      @add-new-item="addNewQuestion"
      @edit-item="editQuestion"
      @delete-item="deleteQuestion"
      @refresh-table="LOAD_QUESTIONS"
    />
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
      loading: true,
      modalRule: [v => !!v || "Поле обязательно"],
      headers: [
        { text: "Id", value: "id", align: "left" },
        { text: "Ключи", value: "keys" },
        { text: "Вопрос", value: "title" },
        { text: "Ответ", value: "body" },
        { text: "Действия", value: "action", sortable: false }
      ]
    };
  },
  computed: {
    ...mapState("questions", ["questions", "isFirstDataLoaded"]),
    ...mapState("modal", ["modalData"]),
    ...mapGetters("questions", ["GET_QUESTION_BY_ID"])
  },
  methods: {
    ...mapActions("questions", ["LOAD_ALL_QUESTIONS",'LOAD_ALL_ANSWERS']),
    ...mapMutations("questions", ["SET_SELECTED_QUESTION_ID"]),
    ...mapMutations("modal", ["OPEN_MODAL", "CLOSE_MODAL"]),
    ...mapActions("snackbar", ["OPEN_SNACKBAR"]),

    addNewQuestion() {
      this.OPEN_MODAL("Добавить вопрос");
    },
    editQuestion(item) {
      this.OPEN_MODAL({ title: "Изменить вопрос", selectedItem: item });
      // this.OPEN_SNACKBAR({ color: "success", text: "Вы изменили вопрос" });
    },
    deleteQuestion(item) {
      console.log(item);
      // console.log(item);
      // this.OPEN_MODAL('Удалить вопрос');
      this.OPEN_SNACKBAR({ color: "error", text: "Вы удалили вопрос" });
    },

    // MODAL
    closeModal() {
      this.CLOSE_MODAL();
    },
    saveModal(item) {
      let validModal = this.$refs.modalForm.validate();
      if (!validModal) return;

      console.log(item);

      this.CLOSE_MODAL();
    }
  },
  // первая загрузка данный
  mounted() {
    if (!this.isFirstDataLoaded) {
      this.loading = true;
      setTimeout(() => {
        this.LOAD_ALL_QUESTIONS();
        this.LOAD_ALL_ANSWERS();
        this.loading = false;
      }, 1000);
    } else {
      this.loading = false;
    }
  }
};
</script>
