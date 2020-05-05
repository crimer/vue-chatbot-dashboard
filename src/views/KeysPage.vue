<template>
  <div>
    <DeleteModal
      @cancel-delete="cancelDelete"
      @yes-delete="yesDelete"
      title="Удалить ключ?"
      text="Вы уверены? Ключ будет удален навсегда"
    />
    <Table
      :editable="false"
      :head="headers"
      :data="keysList"
      :loading="loading"
      @add-new-item="addNewKey"
      @delete-item="deleteKey"
      @refresh-table="FETCH_ALL_KEYS"
    />
  </div>
</template>

<script>
import { mapGetters, mapActions, mapMutations, mapState } from "vuex";
import DeleteModal from "@/components/Modal/DeleteModal.vue";
import Table from "@/components/Table.vue";

export default {
  name: "KeysPage",
  components: { DeleteModal, Table },
  data() {
    return {
      loading: false,
      deleteKeyId: null,
      modalRule: [
        v => !!v || "Поле обязательно",
        v => (v && v.length >= 6) || "Ключ должен быть больше чем 6 символов"
      ],
      headers: [
        { text: "Id", value: "id" },
        { text: "Ключ", value: "key" },
        { text: "Действия", value: "action", sortable: false }
      ]
    };
  },
  computed: {
    ...mapState("keys", ["keysList", "isFirstDataLoaded"])
  },
  methods: {
    ...mapActions("keys", ["FETCH_ALL_KEYS", "DELETE_KEY", "REGISTER_NEW_KEY"]),
    ...mapMutations("deleteModal", ["CLOSE_DELETE_MODAL", "OPEN_DELETE_MODAL"]),
    ...mapActions("snackbar", ["OPEN_SNACKBAR"]),
    // table
    addNewKey() {
      this.REGISTER_NEW_KEY();
      this.OPEN_SNACKBAR({ color: "success", text: "Вы добавили новый ключ" });
    },
    deleteKey(item) {
      this.deleteKeyId = item.id;
      this.OPEN_DELETE_MODAL();
    },
    // delete modal
    cancelDelete() {
      this.CLOSE_DELETE_MODAL();
      this.deleteKeyId = null;
    },
    async yesDelete() {
      await this.DELETE_KEY(this.deleteKeyId);
      this.CLOSE_DELETE_MODAL();
      this.OPEN_SNACKBAR({ color: "error", text: "Вы удалили ключ" });
      this.deleteKeyId = null;
    }
  },
  // первая загрузка данный
  mounted() {
    if (!this.isFirstDataLoaded) {
      this.loading = true;
      this.FETCH_ALL_KEYS();
      this.loading = false;
    } else {
      console.log("keys already loaded");
      this.loading = false;
    }
  }
};
</script>
