<template>
  <div>
    <CreateEditModal />
    <Table
      :head="headers"
      :data="keysList.keys"
      :loading="loading"
      @refresh-data="FETCH_ALL_KEYS"
    />
  </div>
</template>

<script>
import { mapActions, mapState } from "vuex";
import CreateEditModal from "@/components/CreateEditModal.vue";
import Table from "@/components/Table.vue";

export default {
  name: "KeysPage",
  components: { CreateEditModal, Table },
  data() {
    return {
      loading: true,
      headers: [
        { text: "Id", value: "id", align: "left" },
        { text: "Ключ", value: "key" },
        { text: "Действия", value: "action", sortable: false }
      ]
    };
  },
  computed: {
    ...mapState("KeysStore", ["keysList"]),
    ...mapState("KeysStore", ["isFirstDataLoaded"])
  },
  methods: {
    ...mapActions("KeysStore", ["FETCH_ALL_KEYS"])
  },
  // первая загрузка данный
  mounted() {
    if (!this.isFirstDataLoaded) {
      this.loading = true;
      this.FETCH_ALL_KEYS();
      this.loading = false;
    } else {
      console.log("questions already loaded");
      this.loading = false;
    }
  }
};
</script>
