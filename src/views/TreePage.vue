<template>
  <div class="ma-5">
    <TreeTable :tree="tree"/>
  </div>
</template>

<script>
import TreeTable from "@/components/TreeTable.vue";
import { mapActions, mapState } from "vuex";

export default {
  name: "TreeTablePage",
  components: {
    TreeTable
  },
  data() {
    return {};
  },
  computed: {
    ...mapState('tree',['tree']),
  },
  methods:{
    ...mapActions("tree", ['FETCH_TREE']),
  },
  mounted() {
    this.FETCH_TREE();
  }
};
</script>

<style scoped></style>
