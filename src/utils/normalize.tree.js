export const normalizeTree = data => {
  const tree = null;
  tree.name = data.text;
  for (const answer in data.answers) {
    tree.children = {
      name: answer.text

    }
  }
  return tree;
};

const treeExpand = data => {
  const tree = null;
  return tree;
};