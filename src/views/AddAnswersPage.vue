<template>
  <div class="ma-5 form-wrapper">
    <v-form>
      <v-select
        label="Вопрос"
        :items="questions"
        v-model="selectedQuestion"
        no-data-text="Вопросов совсем нет"
        return-object
        item-text="text"
        item-value="id">
        <template #item="{item}">
          <v-list-item-group>
            <v-list-item-content>
              <v-list-item-title v-html="item.text"></v-list-item-title>
            </v-list-item-content>
          </v-list-item-group>
        </template>
      </v-select>
      <div class="d-flex flex-column">
        <h3>1 вариант ответа</h3>
          <v-text-field
            disabled
            label="Id"
            hide-details="auto"
            v-model="addEditQueston.id"
            class="mb-5 form-wrapper__id"/>
        <vue-editor
          placeholder="Вариант ответа"
          class="form-wrapper__content"
          v-model="addEditQueston.text"
          :editor-toolbar="customToolbar"/>
        <v-combobox
          class="mt-5"
          label="Ключевые слова"
          multiple
          chips ></v-combobox>
        <div class="mt-5">
          <v-btn small color="success" @click="saveQuestion">Сохранить</v-btn>
        </div>
      </div>
    </v-form>
  </div>
</template>

<script>
import { VueEditor } from "vue2-editor";
import { mapState, mapActions } from "vuex";

export default {
  name: "AddAnswersPage",
  components: { VueEditor },
  data() {
    return {
      selectedQuestion: 1,
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
    ...mapState("questions", ["questions"])
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
