<template>
  <div class="ma-5 form-wrapper">
    <v-form>
      <v-select
        label="Вопрос"
        :items="questions"
        :disabled="addEditAnswers.type === 'ADD' ? false : true"
        v-model="addEditAnswers.data.id"
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
        <v-tabs
          background-color="white"
          color="primary"
          v-model="tab"
          left
          center-active>
          <v-tab
            v-for="i in addEditAnswers.data.answers.length"
            :key="i"
            :href="`#tab-${i - 1}`"
            class="answer">
            <h3>{{ i }} вариант ответа</h3>
          </v-tab>
          <v-tabs-items v-model="tab">
            <v-tab-item
              v-for="(answer, i) in addEditAnswers.data.answers"
              :key="answer.id"
              :value="`tab-${i}`">
            <v-btn fab small dark @click="removeVariant(i)" color="primary" class="mt-5">
              <v-icon dark>$vuetify.icons.minus</v-icon>
            </v-btn>
              <v-text-field
                disabled
                label="Id"
                hide-details="auto"
                v-model="answer.id"
                class="mb-5 answer__id"
              />
              <vue-editor
                placeholder="Вариант ответа"
                class="answer__text"
                v-model="answer.text"
                :editor-toolbar="customToolbar"
              />
              <v-combobox
                class="mt-5 answer__keys"
                label="Ключевые слова"
                v-model="answer.keys"
                multiple
                chips
              ></v-combobox>
            </v-tab-item>
          </v-tabs-items>
        </v-tabs>
        <div class="mt-5">
          <v-btn color="success" @click="saveAnswers">Сохранить</v-btn>
          <v-btn @click="addVariant" color="primary" class="ml-5">
            <v-icon dark>$vuetify.icons.plus</v-icon>
            ответ
          </v-btn>
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
      tab: null,
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
    ...mapState("addEditEntity", ["addEditQueston", "addEditAnswers"]),
    ...mapState("questions", ["questions"])
  },
  methods: {
    ...mapActions("snackbar", ["OPEN_SNACKBAR"]),
    addVariant() {
      this.addEditAnswers.data.answers.push({
        id: null,
        keys: [],
        text: ""
      });
    },
    removeVariant(tabIndex) {
      this.addEditAnswers.data.answers.splice(tabIndex,1);
      console.log(this.addEditAnswers.data.answers);
    },
    saveAnswers() {
      if (!this.addEditAnswers.text) {
        this.OPEN_SNACKBAR({ color: "error", text: "Текст должен быть" });
        return;
      }
      console.log("ok");
    }
  }
};
</script>

<style lang="scss">
</style>
