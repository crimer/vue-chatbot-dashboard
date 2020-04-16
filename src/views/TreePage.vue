<template>
  <div class="ma-5">
    <!-- <TreeTable /> -->
  </div>
</template>

<script>
// import TreeTable from "@/components/TreeTable.vue";
import { mapActions } from "vuex";

export default {
  name: "TreeTablePage",
  components: {
    // TreeTable
  },
  data() {
    return {};
  },
  methods:{
    ...mapActions("TreeStore", ['FETCH_TREE']),
  },
  mounted() {
    this.FETCH_TREE();
  }
};
</script>

<style scoped></style>
