<template>
  <div class="ma-5 form-wrapper">
    <DeleteModal
      @cancel-delete="cancelDelete"
      @yes-delete="yesDelete"
      title="Удаление варианта ответа"
      text="Удалить этот вариант ответа?"
    />
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
              <v-list-item-title v-html="item.text + ' (id - ' + item.id + ')'"></v-list-item-title>
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
              <div class="d-flex align-center">
                <v-btn
                  fab
                  small
                  dark
                  @click="removeVariant(i)"
                  color="error"
                  class="mr-5"
                >
                  <v-icon dark>$vuetify.icons.delete</v-icon>
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
          <v-btn @click="addVariant" color="primary" class="ml-5" v-if="addEditAnswers.type === 'ADD'">
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
import DeleteModal from "@/components/DeleteModal.vue";

export default {
  name: "AddAnswersPage",
  components: { VueEditor,DeleteModal },
  data() {
    return {
      tab: null,
      customToolbar: [
        ["bold", "italic", "underline", "strike"],
        [{ list: "ordered" }, { list: "bullet" }],
        ["background", "color"],
        ["clean"]
      ],
      answers: [],
      deleteAnswerId: null,
      tabIndex: null,
    };
  },
  computed: {
    ...mapState("addEditEntity", ["addEditQueston", "addEditAnswers"]),
    ...mapState("questions", ["questions"])
  },
  methods: {
    ...mapActions("snackbar", ["OPEN_SNACKBAR"]),
    ...mapActions("questions", ["LOAD_ALL_QUESTIONS", "ADD_NEW_ANSWERS","EDIT_ANSWERS","DELETE_ANSWER"]),
    ...mapMutations("addEditEntity", ["CLEAR_ANSWERS"]),
    ...mapMutations("deleteModal", ["CLOSE_DELETE_MODAL", "OPEN_DELETE_MODAL"]),
    addVariant() {
      this.addEditAnswers.data.answers.push({
        id: null,
        keys: [],
        text: "",
        next_question_id: null
      });
    },
    removeVariant(tabIndex) {
      this.tabIndex = tabIndex;
      this.deleteAnswerId = this.addEditAnswers.data.answers[tabIndex].id;
      this.OPEN_DELETE_MODAL();
    },
    saveAnswers() {
      const questionId = this.addEditAnswers.type === 'ADD' ? this.addEditAnswers.data.id.id : this.addEditAnswers.data.id;
      console.log("questionId",questionId);
      this.answers = this.addEditAnswers.data.answers.map(a =>
        this.buildAnswer(a, questionId)
      );
      console.log(this.answers);
      
      if(this.addEditAnswers.type === 'ADD'){
        this.add(this.answers);
      }else{
        this.edit(this.answers);
      }
      this.CLEAR_ANSWERS();
      this.LOAD_ALL_QUESTIONS();
      this.$router.push({ name: "home" });
    },

    async add(answers) {
      console.log(answers);
      let ok = await this.ADD_NEW_ANSWERS(answers);
      if(ok)
        this.OPEN_SNACKBAR({color: "success",text: "Вы добавили новые варианты ответа"})
      else
        this.OPEN_SNACKBAR({color: "error",text: "Что-то пошло не так. Обновите страницу"});
    },

    async edit(answers) {
      console.log(answers);
      let ok = await this.EDIT_ANSWERS(answers);
      if(ok)
        this.OPEN_SNACKBAR({color: "success",text: "Вы изменили варианты ответа"})
      else
        this.OPEN_SNACKBAR({color: "error",text: "Что-то пошло не так. Обновите страницу"});
    },

    buildAnswer(answer, questionId) {
      console.log("answerw",answer);
      
      return {
        id: answer.id,
        question_id: questionId,
        text: answer.text,
        keys: answer.keys.join(" "),
        next_question_id: answer.next_question_id?.id
      };
    },

    // delete modal
    cancelDelete() {
      this.CLOSE_DELETE_MODAL();
      this.tabIndex = null;
      this.deleteAnswerId = null;
    },
    async yesDelete() {
      let ok = await this.DELETE_ANSWER(this.deleteAnswerId);
      if (ok) {
        this.deleteAnswerId = null;
        this.CLOSE_DELETE_MODAL();
        this.OPEN_SNACKBAR({ color: "success", text: "Вы удалили вопрос" });
        this.addEditAnswers.data.answers.splice(this.tabIndex, 1)
      } else {
        this.OPEN_SNACKBAR({ color: "error", text: "Что-то пошло не так" });
      }
      this.tabIndex = null;
      this.deleteAnswerId = null;
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
