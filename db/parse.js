/**
 * @param {{
 * name: string,
 * description: string,
 * calories: number,
 * difficulty: number,
 * rating: number,
 * timeToPrep: number,
 * timeToCook: number,
 * tag: [string],
 * class: [string],
 * image: [string],
 * ingredient: [{
 *   amount: number,
 *   unit: string,
 *   name: string
 * }],
 * steps:[{
 *   description: string,
 *   stepPicture: [string]
 * }]
 * }} obj
 */
function recipeParse(obj) {
  const name = obj.name;
  const description = obj.description;
  const tags = obj.tag.map((x) => '"' + x + '"');
  const img = obj.image;
  const ingredients = obj.ingredient.map(
    (curr) =>
      `{"amount": "${curr.amount !== undefined ? curr.amount : ""}","unit": "${
        curr?.unit !== undefined ? curr.unit : ""
      }","name": "${curr.name !== undefined ? curr.name : ""}"}`
  );
  const steps = obj.steps.map(
    (curr) => '"' + curr.description.replace("'", "'") + '"'
  );

  return `
    (
      '${obj.name}',
      '${obj.description}',
      '${obj.calories}',
      '${obj.difficulty}',
      '${obj.rating}',
      '${obj.timeToPrep}',
      '${obj.timeToCook}',
      '[${obj.tag.toString()}]',
      '[${obj.class.toString()}]',
      '[${obj.image.toString()}]',
      '${obj.ingredient}',
      '${obj.steps}'
    )
  `;
  // return { name, description, tags, img, ingredients, steps };
}

/**
//  * @param {{
//  *  name: "",
//  *  description: "",
//  *  tags: [""],
//  *  img: "",
//  *  ingredients: [""],
//  *  steps: [""],
//  *  }} obj
    *@param {*} obj
 */
function insertGenerator(obj) {
  const recipe_insert = `
    (
        '${obj.name}',
        '{obj.rating}',
        '${obj.description}',
        '{obj.timeToCook}',
        '{obj.timeToPrep}',
        '{obj.serving}',
        '${obj.img}',
        '[${obj.steps}]'
        '[${obj.tags}]'
        '[${obj.ingredients}]',
        '{obj.class}',
    )`;
  return recipe_insert;
}

let recipes = [];

let out = `
  INSERT INTO recipes (
    name,
    description,
    calories,
    difficulty,
    rating,
    timeToPrep,
    timeToCook,
    tag,
    class,
    image,
    ingredient,
    steps
  ) VALUES`;
for (let i = 0; i < recipes.length; i++) {
  out +=
    insertGenerator(recipeParse(recipes[i])) +
    (i + 1 < recipes.length ? "," : ";");
}
console.log(out);

// let type = {
//   name: string,
//   description: string,
//   calories: number,
//   difficulty: number,
//   rating: number,
//   timeToPrep: number,
//   timeToCook: number,
//   tag: [string],
//   class: [string],
//   image: [string],
//   ingredient: [{
//     amount: number,
//     unit: string,
//     name: string
//   }],
//   steps:[{
//     description: string,
//     stepPicture: [string]
//   }]
// }

function test(val) {
  // let foo = JSON.stringify(val.ingredient);
  let foo = JSON.stringify(val.ingredient);
  return foo.replace(/\\/g, "");
  // return JSON.stringify(JSON.parse(JSON.stringify(val))).replace(/\\/g, "");
}

test({
  ingredient: [
    {
      amount: 50,
      unit: "mg",
      name: "officia culpa",
    },
    {
      amount: 140,
      unit: "g",
      name: "id deserunt",
    },
    {
      amount: 70,
      unit: "mg",
      name: "quis amet nul",
    },
    {
      amount: 165,
      unit: "g",
      name: "laboris commo",
    },
  ],
});
