<template>
  <v-dialog v-model="deleteModalShow" max-width="700px" persistent>
    <v-card>
      <v-card-title>
        <span class="headline">{{ title }}</span>
      </v-card-title>
      <v-card-text>
        <div class="d-flex flex-column">
          <p>{{ text }}</p>
        </div>
      </v-card-text>
      <v-card-actions>
        <v-spacer />
        <v-btn color="primary white" @click="$emit('cancel-delete')">
          <v-icon>$vuetify.icons.arrorLeft</v-icon>
          Отменить
        </v-btn>
        <v-btn color="error" @click="$emit('yes-delete')">
          Удалить
          <v-icon class="ml-3">$vuetify.icons.send</v-icon>
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
import { mapState, mapMutations } from "vuex";
export default {
  name: "DeleteModal",
  props: {
    text: {
      required: true,
      type: String,
    },
    title:{
      required: true,
      type: String,
    }
  },
  computed: {
    ...mapState("deleteModal", ["deleteModalShow"])
  }
};
</script>

<style></style>
