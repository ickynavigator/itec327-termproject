function recipeParse(
  obj = {
    name: "",
    id: "",
    description: "",
    tag: [""],
    image: "",
    ingredient: [
      {
        amount: 0,
        unit: "",
        name: "",
        preparation: "",
      },
    ],
    ingredientGroup: [],
    step: [{ description: "" }],
    notes: "",
    forked: "",
  }
) {
  const name = obj.name;
  const description = obj.description;
  const tags = [...obj.tag];
  const img = obj.image;
  const ingredients = [];
  const steps = [];
  for (let i = 0; i < obj.ingredient.length; i++) {
    let curr = obj.ingredient[i];
    ingredients.push(
      `{"amount": "${curr.amount !== undefined ? curr.amount : ""}", "unit": "${
        curr?.unit !== undefined ? curr.unit : ""
      }", "name": "${curr.name !== undefined ? curr.name : ""}"}`
    );
  }
  for (let i = 0; i < obj.step.length; i++) {
    let curr = obj.step[i];
    steps.push('"' + curr.description + '"');
  }
  let val = { name, description, tags, img, ingredients, steps };
  console.log(val);
  return val;
}

function insertGenerator(
  id = 0,
  obj = {
    name: "",
    description: "",
    tags: [""],
    img: "",
    ingredients: [""],
    steps: [""],
  }
) {
  const recipe_insert = `
    INSERT INTO recipe (
        id,
        name,
        rating,
        description,
        timeToCook,
        timeToPrep,
        serving,
        file_url,
        steps
    ) VALUES (
        ${id},
        ${obj.name},
        {obj.rating},
        ${obj.description},
        {obj.timeToCook},
        {obj.timeToPrep},
        {obj.serving},
        '{${obj.ingredients}}',
        ${obj.img},
        '[${obj.steps}]'
    )
    `;
  console.log(recipe_insert);
}

let testobj = {
  name: "Giouvarlakia",
  id: "giouvarlakia",
  description: "A low carb version of a traditional hearty Greek dish",
  tag: ["Greek"],
  image:
    "http://forkgasm.com/images/106039513_690984628417462_2727964218559966794_n.jpg",
  ingredient: [
    {
      amount: "500",
      unit: "g",
      name: "ground meat (beef, pork, or both), at least 20% fat",
    },
    {
      amount: "1",
      name: "small onion",
      preparation: "finely chopped or minced",
    },
    {
      amount: "350",
      unit: "g",
      name: "cauliflower rice",
    },
    {
      amount: "2",
      name: "lemons",
      preparation: "juiced",
    },
    {
      amount: "3",
      name: "eggs",
    },
    {
      name: "olive oil",
    },
    {
      amount: "50",
      unit: "g",
      name: "butter",
    },
    {
      name: "parsley",
    },
    {
      name: "dill",
    },
    {
      amount: "1",
      unit: "clove",
      name: "garlic",
    },
    {
      amount: "2",
      unit: "tsp",
      name: "concentrated chicken or vegetable stock",
    },
  ],
  ingredientGroup: [],
  step: [
    {
      description: "Saute the cauliflower rice",
    },
    {
      description: "In a large pot, add 1.5 li",
    },
    {
      description: "**Meatball mix:** In a lars",
    },
    {
      description: "Make small balls with the s",
    },
    {
      description: "Lower the meatballs one bys",
    },
    {
      description: "After 20-25 minutes (so 10ee",
    },
    {
      description: "**Avgolemono (egg-lemon sauc",
    },
    {
      description: "Once the meatballs have been",
    },
    {
      description: "**That's it!** Serve in bowl",
    },
  ],
  notes:
    "- For concentrated stock, we love the brand Better than Bouillon. We used chicken.",
  forked:
    "- Anastasia's Giouvarlakia\n- https://mybigfatketolife.com/2019/04/05/giouvarlakia/",
};

// @ts-ignore
insertGenerator(1, recipeParse(testobj));
