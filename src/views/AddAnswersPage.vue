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
        item-value="id"
      >
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
          center-active
        >
          <v-tab
            v-for="i in addEditAnswers.data.answers.length"
            :key="i"
            :href="`#tab-${i - 1}`"
            class="answer"
          >
            <h3>{{ i }} вариант ответа</h3>
          </v-tab>
          <v-tabs-items v-model="tab">
            <v-tab-item
              v-for="(answer, i) in addEditAnswers.data.answers"
              :key="answer.id"
              :value="`tab-${i}`"
            >
              <div class="d-flex align-center mt-5">
                <v-btn
                  fab
                  small
                  dark
                  @click="removeVariant(i)"
                  color="primary"
                  class="mr-5"
                >
                  <v-icon dark>$vuetify.icons.minus</v-icon>
                </v-btn>
                <v-text-field
                  disabled
                  label="Id"
                  hide-details="auto"
                  v-model="answer.id"
                  class="mb-5 answer__id"
                />
              </div>
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
              <!-- TODO: сделать чтоб они были разными -->
              <!-- TODO: делать запросы к апи -->
              <v-select
                label="Вопрос на который ссылается ответ"
                :items="questions"
                v-model="answer.next_question_id"
                no-data-text="Вопросов совсем нет"
                return-object
                clearable
                item-text="text"
                item-value="id"
              >
                <template #item="{item}">
                  <v-list-item-group>
                    <v-list-item-content>
                      <v-list-item-title v-html="item.text"></v-list-item-title>
                    </v-list-item-content>
                  </v-list-item-group>
                </template>
              </v-select>
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
import { mapState, mapActions, mapMutations } from "vuex";

export default {
  name: "AddAnswersPage",
  components: { VueEditor },
  data() {
    return {
      tab: null,
      customToolbar: [
        ["bold", "italic", "underline", "strike"],
        [{ list: "ordered" }, { list: "bullet" }],
        ["background", "color"],
        ["clean"]
      ],
      answers: []
    };
  },
  computed: {
    ...mapState("addEditEntity", ["addEditQueston", "addEditAnswers"]),
    ...mapState("questions", ["questions"])
  },
  methods: {
    ...mapActions("snackbar", ["OPEN_SNACKBAR"]),
    ...mapActions("questions", ["LOAD_ALL_QUESTIONS", "ADD_NEW_ANSWERS"]),
    ...mapMutations("addEditEntity", ["CLEAR_ANSWERS"]),
    addVariant() {
      this.addEditAnswers.data.answers.push({
        id: null,
        keys: [],
        text: "",
        next_question_id: null
      });
    },
    removeVariant(tabIndex) {
      this.addEditAnswers.data.answers.splice(tabIndex, 1);
      console.log(this.addEditAnswers.data.answers);
    },
    async saveAnswers() {
      this.addEditAnswers.data.id = this.addEditAnswers.data.id.id;

      const questionId = this.addEditAnswers.data.id;

      this.answers = this.addEditAnswers.data.answers.map(a =>
        this.buildAnswer(a, questionId)
      );

      let ok = await this.ADD_NEW_ANSWERS(this.answers);
      if(ok)
        this.OPEN_SNACKBAR({color: "success",text: "Вы добавили новые варианты ответа"})
      else
        this.OPEN_SNACKBAR({color: "error",text: "Что-то пошло не так"});
        
      this.CLEAR_ANSWERS();
      this.LOAD_ALL_QUESTIONS();
      this.$router.push({ name: "home" });
    },
    buildAnswer(answer, questionId) {
      return {
        question_id: questionId,
        text: answer.text,
        keys: answer.keys.join(" "),
        next_question_id: answer.next_question_id.id
      };
    }
  }
};
</script>

<style lang="scss">
.answer {
  &__id {
    max-width: 100px;
  }
}
</style>
