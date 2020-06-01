<template>
  <div class="ma-5 form-wrapper">
    <v-form v-model="modalValid" ref="modalForm">
      <div class="d-flex flex-column">
        <div class="d-flex flex-row align-center">
          <v-text-field
            label="Id"
            hide-details="auto"
            class="mb-5 form-wrapper__id"/>
          <div class="ml-10">
            <v-btn small color="success">Сохранить</v-btn>
          </div>
        </div>
        <vue-editor class="form-wrapper__content" v-model="content" :editor-toolbar="customToolbar" />
        <div>{{ content }}</div>
      </div>
    </v-form>
  </div>
</template>

<script>
import { VueEditor, Quill } from "vue2-editor";
export default {
  name: "AddQuestionPage",
  components: { VueEditor },
  data() {
    return {
      modalValid: false,
      customToolbar: [
        ["bold", "italic", "underline", "strike"],
        [{ list: "ordered" }, { list: "bullet" }],
        ["background", "color"],
        ["clean"]
      ],
      content: ""
    };
  }
};
</script>

<style lang="scss">
.form-wrapper{
  &__id{
    max-width: 200px;
  }
}
</style>
