<template>
  <div>
    <div class="d-flex mb-5">
      <v-btn small color="primary" class="mr-5" @click="addNode">Add Node</v-btn>
      <v-btn small color="primary" @click="getNewTree">Get new tree</v-btn>
    </div>
    <vue-tree-list
      @click="onClick"
      @change-name="onChangeName"
      @delete-node="onDel"
      @add-node="onAddNode"
      :model="data"
      default-tree-node-name="Question"
      default-leaf-node-name="new leaf"
      v-bind:default-expanded="false">
      <v-btn icon color="blue" slot="addTreeNodeIcon">
        <v-icon color="blue" >$vuetify.icons.addNode</v-icon>
      </v-btn>
      <v-btn icon color="blue" slot="addLeafNodeIcon">
        <v-icon color="blue" >$vuetify.icons.addLeaf</v-icon>
      </v-btn>
      <v-btn icon color="success" slot="editNodeIcon">
        <v-icon color="success" >$vuetify.icons.edit</v-icon>
      </v-btn>
      <v-btn icon color="danger" slot="delNodeIcon">
        <v-icon color="danger" >$vuetify.icons.delete</v-icon>
      </v-btn>
      <v-icon slot="leafNodeIcon">$vuetify.icons.answer</v-icon>
      <v-icon slot="treeNodeIcon">$vuetify.icons.question</v-icon>
    </vue-tree-list>
    <pre>
      {{ newTree }}
    </pre>
  </div>
</template>

<script>
import { VueTreeList, Tree, TreeNode } from "vue-tree-list";

export default {
  name: "TreeTable",
  components: {
    VueTreeList
  },
  props:{
    tree:{
      required: true,
      type: Object,
    }
  },
  data() {
    return {
      newTree: {},
      data: new Tree([
        {
          id: 0,
          isLeaf: false,
          name: "root",
          children: [
            {
              id: 1,
              isLeaf: false,
              name: "Здравствуйте, чем мы можем вам помочь?",
              pid: 0,
              // dragDisabled: true,
              children: [
                {
                  id: 2,
                  isLeaf: false,
                  name: "Вопросы по поступлению",
                  pid: 1,
                  children: [
                    {
                      id: 1583381648541,
                      isLeaf: false,
                      name: "Что вас интересует?",
                      pid: 2,
                      children: [
                        {
                          id: 1583381676417,
                          isLeaf: false,
                          name:
                            "Какие сроки приема документов для поступления?",
                          pid: 1583381648541,
                          children: [
                            {
                              id: 1583381698675,
                              isLeaf: true,
                              name: "new leaf",
                              pid: 1583381676417
                            }
                          ]
                        },
                        {
                          id: 1583381686820,
                          isLeaf: false,
                          name: "Какой распорядок работы приёмной комиссии?",
                          pid: 1583381648541,
                          children: [
                            {
                              id: 1583381701161,
                              isLeaf: true,
                              name: "new leaf",
                              pid: 1583381686820
                            }
                          ]
                        }
                      ]
                    }
                  ]
                }
              ]
            },
            {
              id: 3,
              isLeaf: false,
              name: "Node 2",
              pid: 0
            }
          ]
        }
      ])
    };
  },
  methods: {
    onDel(node) {
      console.log(node);
      node.remove();
    },

    onChangeName(params) {
      console.log(params);
    },

    onAddNode(params) {
      console.log(params);
    },

    onClick(params) {
      console.log(params);
    },

    addNode() {
      var node = new TreeNode({ name: "new node", isLeaf: false });
      if (!this.data.children) this.data.children = [];
      this.data.addChildren(node);
    },

    getNewTree() {
      var vm = this;
      function _dfs(oldNode) {
        var newNode = {};

        for (var k in oldNode) {
          if (k !== "children" && k !== "parent") {
            newNode[k] = oldNode[k];
          }
        }

        if (oldNode.children && oldNode.children.length > 0) {
          newNode.children = [];
          for (var i = 0, len = oldNode.children.length; i < len; i++) {
            newNode.children.push(_dfs(oldNode.children[i]));
          }
        }
        return newNode;
      }

      vm.newTree = _dfs(vm.data);
    }
  }
};
</script>


<style lang="scss" rel="stylesheet/scss">
div.vtl-node-main {
  height: 36px !important;
}

.icon {
  &:hover {
    cursor: pointer;
  }
}

.vtl {
  .vtl-drag-disabled {
    background-color: #d0cfcf;
    &:hover {
      background-color: #d0cfcf;
    }
  }
  .vtl-disabled {
    background-color: #d0cfcf;
  }
}
</style>
