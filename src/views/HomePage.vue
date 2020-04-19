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
            <v-textarea
              :rules="modalRule"
              name="input-answer"
              label="Ответ"
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
      :data="questions"
      :loading="loading"
      @add-new-item="addNewQuestion"
      @edit-item="editQuestion"
      @delete-item="deleteQuestion"
      @refresh-table="LOAD_QUESTIONS"/>
  </div>
</template>

<script>
import { mapGetters, mapActions, mapMutations, mapState } from "vuex";
import CreateEditModal from "@/components/CreateEditModal.vue";
import Table from "@/components/Table.vue";

export default {
  name: "HomePage",
  components: { CreateEditModal, Table },
  data() {
    return {
      modalValid: true,
      loading: true,
      modalRule: [
        v => !!v || 'Поле обязательно',
      ],
      
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
    ...mapState("questions", ["questions", "isFirstDataLoaded"])
  },
  methods: {
    ...mapActions("questions", ["LOAD_QUESTIONS"]),
    ...mapMutations("modal", ["OPEN_MODAL","CLOSE_MODAL"]),
    ...mapActions("snackbar", ["OPEN_SNACKBAR"]),

    addNewQuestion() {
      this.OPEN_MODAL("Добавить вопрос");
    },
    editQuestion(item) {
      console.log(item);
      this.OPEN_MODAL('Изменить вопрос',item);
      // this.OPEN_SNACKBAR({ color: "success", text: "Вы изменили вопрос" });
    },
    deleteQuestion(item) {
      console.log("del");
      // console.log(item);
      // this.OPEN_MODAL('Удалить вопрос');
      this.OPEN_SNACKBAR({ color: "error", text: "Вы удалили вопрос" });
    },
    refresh() {
      this.LOAD_QUESTIONS();
      console.log("refreshed");
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
    // console.log(process.env.VUE_APP_ADMIN_KEY);

    if (!this.isFirstDataLoaded) {
      this.loading = true;
      setTimeout(() => {
        this.LOAD_QUESTIONS();
        this.loading = false;
      }, 1000);
    } else {
      console.log("questions already loaded");
      this.loading = false;
    }
  }
};
</script>
