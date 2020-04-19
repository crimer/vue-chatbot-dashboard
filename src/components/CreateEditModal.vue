<template>
  <v-dialog v-model="modalData.show" max-width="700px" persistent>
    <v-card>
      <v-card-title>
        <span class="headline">{{ modalData.title }}</span>
      </v-card-title>
      <v-card-text>
        <slot name="body"></slot>
      </v-card-text>
      <v-card-actions>
        <slot name="footer"></slot>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
import { mapState, mapMutations } from "vuex";
export default {
  name: "CreateEditModal",
  computed: {
    ...mapState("modal", ["modalData"])
  },
  methods: {
    ...mapMutations("modal", ["CLOSE_MODAL", "SAVE_MODAL"])
  }
};
</script>

<style></style>
