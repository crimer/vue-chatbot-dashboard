<template>
  <v-dialog v-model="modalData.show" max-width="700px" persistent>
    <v-card>
      <v-card-title>
        <span class="headline">{{ modalData.title }}</span>
      </v-card-title>

      <v-card-text>
        <v-text-field label="Вопрос" :value="modalData.question"></v-text-field>
        <v-textarea
          name="input-answer"
          label="Ответ"
          rows="1"
          auto-grow
          :value="modalData.answer"
        ></v-textarea>
      </v-card-text>

      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="primary" @click="CLOSE_MODAL">
          <v-icon>$vuetify.icons.arrorLeft</v-icon>
          Отмена
        </v-btn>
        <v-btn color="success" @click="SAVE_MODAL">
          Сохранить
          <v-icon class="ml-3">$vuetify.icons.send</v-icon>
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
import { mapState, mapMutations } from "vuex";
export default {
  name: "CreateEditModal",
  computed: {
    ...mapState("CreateEditModal", ["modalData"])
  },
  methods: {
    ...mapMutations("CreateEditModal", ["CLOSE_MODAL", "SAVE_MODAL"])
  }
};
</script>

<style></style>
