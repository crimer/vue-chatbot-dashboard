<template>
  <v-dialog v-model="modalShow" max-width="700px" persistent>
    <v-card>
      <v-card-title>
        <span class="headline">{{ modalTitle }}</span>
      </v-card-title>
      <v-card-text>
        <v-form v-model="modalValid" ref="modalForm">
          <v-subheader class="title pa-0">Вопрос</v-subheader>
          <div class="d-flex flex-row">
            <v-text-field
              label="Id"
              hide-details="auto"
              class="mr-10 small-width"
            />
            <v-textarea
              name="input-question"
              label="Вопрос"
              rows="1"
              autofocus
              auto-grow
            />
          </div>
          <v-subheader class="title pa-0">Варианты ответа</v-subheader>
          <div class="answer-choices">
            <div class="answer-choice" v-for="(choice, i) in choicesCount" :key="i">
              <div class="d-flex flex-row">
                <p class="subtitle-1">Вариант {{i+1}}</p>
                <v-btn icon dark color="danger" small class="ml-2" @click="deleteChoice(i)">
                  <v-icon dark>$vuetify.icons.delete</v-icon>
                </v-btn>
              </div>
              <div class="d-flex flex-row">
                <v-text-field
                  label="Id"
                  hide-details="auto"
                  class="mr-10 small-width"
                />
                <v-textarea
                  name="input-answer"
                  label="Вариант ответа"
                  rows="1"
                  auto-grow
                />
              </div>
              <div class="d-flex flex-row">
                <v-combobox
                  v-model="keywords"
                  label="Ключевые слова"
                  multiple
                  chips
                ></v-combobox>
              </div>
            </div>
          </div>
        </v-form>
      </v-card-text>
      <v-card-actions>
        <v-btn color="primary" @click="addNewChoice">
          <v-icon>$vuetify.icons.plus</v-icon>
          Новый вариант
        </v-btn>
        <v-spacer />
        <slot name="footer"></slot>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
import { mapState, mapMutations } from "vuex";
export default {
  name: "CreateEditModal",
  data() {
    return {
      modalValid: true,
      keywords: [],
      choicesCount: 1
    };
  },
  computed: {
    ...mapState("createEditModal", ["modalShow", "modalTitle"])
  },
  methods: {
    addNewChoice() {
      this.choicesCount++;
    },
    deleteChoice(choiceIndex){
      this.choicesCount--;
    }
  }
};
</script>

<style>
.small-width {
  max-width: 50px !important;
}
</style>
