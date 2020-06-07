<template>
  <div>
    <DeleteModal
      @cancel-delete="cancelDelete"
      @yes-delete="yesDelete"
      title="Удалить вопрос?"
      text="Вы уверены? Вопрос вместе со всеми его ответами будет удален навсегда"
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
      deleteQuestionId: null,
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
    ...mapActions("questions", [
      "LOAD_ALL_QUESTIONS",
      "LOAD_ALL_ANSWERS",
      "DELETE_QUESTION"
    ]),
    ...mapActions("snackbar", ["OPEN_SNACKBAR"]),
    ...mapMutations("deleteModal", ["CLOSE_DELETE_MODAL", "OPEN_DELETE_MODAL"]),
    ...mapMutations("createEditModal", ["OPEN_MODAL", "CLOSE_MODAL"]),
    ...mapMutations("addEditEntity", ["SET_QUESTION", "SET_ANSWERS"]),
    refreshTable() {
      this.loading = true;
      this.LOAD_ALL_QUESTIONS();
      this.LOAD_ALL_ANSWERS();
      this.loading = false;
    },
    addNewQuestion() {
      this.SET_QUESTION({
        id: null,
        text: ""
      });
      this.$router.push({ name: "addQuestion" });
    },
    addNewAnswers() {
      const payload = {
        type: "ADD",
        data: {
          id: null,
          count: 1,
          answers: [
            {
              id: null,
              keys: [],
              text: "",
              next_question_id: null
            }
          ]
        }
      };
      this.SET_ANSWERS(payload);
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
      const payload = {
        type: "EDIT",
        data: Object.assign(item)
      };
      this.SET_ANSWERS(payload);
      this.$router.push({ name: "addAnswers" });
    },
    deleteQuestion(item) {
      console.log(item);
      this.deleteQuestionId = item.id;
      this.OPEN_DELETE_MODAL();
    },

    // delete modal
    cancelDelete() {
      this.CLOSE_DELETE_MODAL();
      this.deleteQuestionId = null;
    },
    async yesDelete() {
      let ok = await this.DELETE_QUESTION(this.deleteQuestionId);
      if (ok) {
        this.CLOSE_DELETE_MODAL();
        this.OPEN_SNACKBAR({ color: "success", text: "Вы удалили вопрос" });
        this.deleteQuestionId = null;
      } else {
        this.OPEN_SNACKBAR({ color: "error", text: "Что-то пошло не так" });
      }
      this.LOAD_ALL_QUESTIONS();
    }
  },
  mounted() {
    this.LOAD_ALL_QUESTIONS();
    this.LOAD_ALL_ANSWERS();
  }
};
</script>
