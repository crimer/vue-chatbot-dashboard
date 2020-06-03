<template>
  <div class="ma-5 form-wrapper">
    <v-form>
      <div class="d-flex flex-column">
        <div class="d-flex flex-row align-center">
          <v-text-field
            disabled
            label="Id"
            hide-details="auto"
            v-model="addEditQueston.id"
            class="mb-5 form-wrapper__id"
          />
          <div class="ml-10">
            <v-btn color="success" @click="saveQuestion">Сохранить</v-btn>
          </div>
        </div>
        <vue-editor
          placeholder="Ваш вопрос"
          class="form-wrapper__content"
          v-model="addEditQueston.text"
          :editor-toolbar="customToolbar"
        />
        <!-- TODO: убрать -->
        <div>
          {{ addEditQueston.text }}
        </div>
      </div>
    </v-form>
  </div>
</template>

<script>
import { VueEditor, Quill } from "vue2-editor";
import { mapState, mapActions, mapMutations } from "vuex";

export default {
  name: "AddQuestionPage",
  components: { VueEditor },
  data() {
    return {
      customToolbar: [
        ["bold", "italic", "underline", "strike"],
        [{ list: "ordered" }, { list: "bullet" }],
        ["background", "color"],
        ["clean"]
      ]
    };
  },
  computed: {
    ...mapState("addEditEntity", ["addEditQueston"])
  },
  methods: {
    ...mapActions("snackbar", ["OPEN_SNACKBAR"]),
    ...mapActions("questions", ["ADD_NEW_QUESTION", "EDIT_QUESTION", "LOAD_ALL_QUESTIONS", "LOAD_ALL_ANSWERS"]),
    ...mapMutations('addEditEntity',['CLEAR_QUESTION']),

    async saveQuestion() {
      const { id, text } = this.addEditQueston;
      if (text === "") {
        this.OPEN_SNACKBAR({ color: "error", text: "Текст должен быть" });
        return;
      }
      if (id !== null) {
        let ok = await this.EDIT_QUESTION(this.addEditQueston);
        if (ok) {
          this.OPEN_SNACKBAR({ color: "success", text: "Вы изменили вопрос" });
        }
      } else {
        let ok = await this.ADD_NEW_QUESTION(text);
        if (ok) {
          this.OPEN_SNACKBAR({
            color: "success",
            text: "Вы добавили новый вопрос"
          });
        }
      }
      this.CLEAR_QUESTION();
      this.LOAD_ALL_QUESTIONS();
      this.$router.push({name: 'home'});
    }
  }
};
</script>

<style lang="scss">
.form-wrapper {
  &__id {
    max-width: 200px;
  }
}
</style>
