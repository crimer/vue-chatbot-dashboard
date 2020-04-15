<template>
  <div>
    <CreateEditModal />
    <Table
      :head="headers"
      :data="questions"
      :loading="loading"
      @refresh-data="LOAD_QUESTIONS"/>
  </div>
</template>

<script>
import { mapGetters, mapActions, mapMutations, mapState } from "vuex";
import CreateEditModal from "@/components/CreateEditModal.vue";
import Table from "@/components/Table.vue";

export default {
  name: "HomePage",
  components: { CreateEditModal, Table },
  data() {
    return {
      loading: true,
      headers: [
        { text: "Id", value: "id", align: "left" },
        { text: "Ключи", value: "keys" },
        { text: "Вопрос", value: "title" },
        { text: "Ответ", value: "body" },
        { text: "Действия", value: "action", sortable: false }
      ]
    };
  },
  computed: {
    ...mapState("QuestionsStore", ["questions"]),
    ...mapState("QuestionsStore", ["isFirstDataLoaded"])
  },
  methods: {
    ...mapActions("QuestionsStore", ["LOAD_QUESTIONS"])
  },
  // первая загрузка данный
  mounted() {
    console.log(process.env.VUE_APP_ADMIN_KEY);
    
    if (!this.isFirstDataLoaded) {
      this.loading = true;
      setTimeout(() => {
        this.LOAD_QUESTIONS();
        this.loading = false;
      }, 1000);
    } else {
      console.log("questions already loaded");
      this.loading = false;
    }
  }
};
</script>
