<template>
  <div>
    <DeleteModal
      @cancel-delete="cancelDelete"
      @yes-delete="yesDelete"
      title="Удалить вопрос?"
      text="Вы уверены? Вопрос будет удален навсегда"
    />
    <Table
      :head="headers"
      :data="questions"
      :loading="loading"
      expandable
      @add-new-question="addNewQuestion"
      @add-new-answers="addNewAnswers"
      @edit-question="editQuestion"
      @edit-answers="editAnswers"
      @delete-item="deleteQuestion"
      @refresh-table="refreshTable"
    />
  </div>
</template>

<script>
import { mapGetters, mapActions, mapMutations, mapState } from "vuex";
import DeleteModal from "@/components/DeleteModal.vue";
import Table from "@/components/Table.vue";

export default {
  name: "HomePage",
  components: { DeleteModal, Table },
  data() {
    return {
      modalValid: false,
      deleteKeyId: null,
      loading: false,
      modalRule: [v => !!v || "Поле обязательно"],
      headers: [
        { text: "Id", value: "id" },
        { text: "Вопрос", value: "text" },
        { text: "Действия", value: "action", sortable: false }
      ]
    };
  },
  computed: {
    ...mapState("questions", ["questions", "isFirstDataLoaded"])
  },
  methods: {
    ...mapActions("questions", ["LOAD_ALL_QUESTIONS", "LOAD_ALL_ANSWERS"]),
    ...mapActions("snackbar", ["OPEN_SNACKBAR"]),
    ...mapMutations("deleteModal", ["CLOSE_DELETE_MODAL", "OPEN_DELETE_MODAL"]),
    ...mapMutations("createEditModal", ["OPEN_MODAL", "CLOSE_MODAL"]),
    ...mapMutations("addEditEntity", ["SET_QUESTION", "SET_ANSWERS"]),

    addNewQuestion() {
      this.SET_QUESTION({
        id: null,
        text: ""
      });
      this.$router.push({ name: "addQuestion" });
    },
    addNewAnswers() {
      // this.SET_QUESTION({
      //   id: null,
      //   text: ""
      // });
      this.$router.push({ name: "addAnswers" });
    },

    editQuestion(item) {
      console.log(item);
      
      this.SET_QUESTION({
        id: item.id,
        text: item.text
      });
      this.$router.push({ name: "addQuestion" });
    },
    editAnswers(item) {
      console.log(item);

      this.SET_ANSWERS(question);
      this.$router.push({ name: "addAnswers" });
    },
    deleteQuestion(item) {
      console.log(item);
      this.deleteKeyId = item.id;
      this.OPEN_DELETE_MODAL();
    },
    refreshTable() {
      this.loading = true;
      this.LOAD_ALL_QUESTIONS();
      this.LOAD_ALL_ANSWERS();
      this.loading = false;
    },
    // create and edit modal
    // closeModal() {
    //   this.CLOSE_MODAL();
    // },
    // saveModal(item) {
    //   console.log(item);
    //   this.CLOSE_MODAL();
    // },

    // delete modal
    cancelDelete() {
      this.CLOSE_DELETE_MODAL();
      this.deleteKeyId = null;
    },
    async yesDelete() {
      // await this.DELETE_KEY(this.deleteKeyId);
      // this.CLOSE_DELETE_MODAL();
      // this.OPEN_SNACKBAR({ color: "error", text: "Вы удалили ключ" });
      // this.deleteKeyId = null;
    }
  },
  mounted() {
    this.LOAD_ALL_QUESTIONS();
    this.LOAD_ALL_ANSWERS();
  }
};
</script>
