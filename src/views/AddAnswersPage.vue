<template>
  <div class="ma-5 form-wrapper">
    <v-form>
      <div class="d-flex flex-column">
        <v-select label="Вопрос">
          <!-- <template #no-data>
            <v-list-item>
              <v-list-item-content>
                <v-list-item-title>Вопросов совсем нет</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </template> -->
        </v-select>
        <div class="d-flex flex-row align-center">
          <v-text-field
            disabled
            label="Id"
            hide-details="auto"
            v-model="addEditQueston.id"
            class="mb-5 form-wrapper__id"
          />
          <div class="ml-10">
            <v-btn small color="success" @click="saveQuestion">Сохранить</v-btn>
          </div>
        </div>
        <vue-editor
          placeholder="Ваш вопрос"
          class="form-wrapper__content"
          v-model="addEditQueston.text"
          :editor-toolbar="customToolbar"
        />
      </div>
    </v-form>
  </div>
</template>

<script>
import { VueEditor, Quill } from "vue2-editor";
import { mapState, mapActions, mapGetters } from "vuex";

export default {
  name: "AddAnswersPage",
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
    ...mapState("addEditEntity", ["addEditQueston"]),
    ...mapState("questions", ["questions"]),
    ...mapGetters('questions',['GET_QUESTION_WITH_KEYS']),
  },
  methods: {
    ...mapActions("snackbar", ["OPEN_SNACKBAR"]),
    saveQuestion() {
      if (!this.addEditQueston.text) {
        this.OPEN_SNACKBAR({ color: "error", text: "Текст должен быть" });
        return;
      }
      console.log("ok");
    }
  }
};
</script>

<style></style>
