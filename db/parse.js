/**
 * @param {{
 *    name: string,
 *    description: string,
 *    calories: number,
 *    difficulty: number,
 *    rating: number,
 *    timeToPrep: number,
 *    timeToCook: number,
 *    tag: string[],
 *    class: string[],
 *    image: string[],
 *    ingredient: {
 *      amount: number,
 *      unit: string,
 *      name: string
 *    }[],
 *    steps: {
 *      description: string,
 *      stepPicture: string,
 *    }[]
 * }[]} obj
 */
function recipeParse(obj) {
  let out = `
INSERT INTO \`recipes\` (
  \`name\`,
  \`description\`,
  \`calories\`,
  \`difficulty\`,
  \`rating\`,
  \`timeToPrep\`,
  \`timeToCook\`,
  \`tag\`,
  \`class\`,
  \`image\`,
  \`ingredient\`,
  \`steps\`
) VALUES
`;
  obj.forEach((curr, ind) => {
    out +=
      `
(
  '${curr.name}',
  '${curr.description}',
  '${curr.calories}',
  '${curr.difficulty}',
  '${curr.rating}',
  '${curr.timeToPrep}',
  '${curr.timeToCook}',
  '${JSON.stringify(curr.tag).replace(/\\/g, "")}',
  '${JSON.stringify(curr.class).replace(/\\/g, "")}',
  '${JSON.stringify(curr.image).replace(/\\/g, "")}',
  '${JSON.stringify(curr.ingredient).replace(/\\/g, "")}',
  '${JSON.stringify(curr.steps).replace(/\\/g, "")}'
)` + (ind + 1 < obj.length ? ",\n" : ";");
  });
  document.getElementById("output").innerText = out;
}

document.getElementById("jsonFile").addEventListener(
  "change",
  (changeEvent) => {
    changeEvent.stopPropagation();
    changeEvent.preventDefault();
    (function readJsonFile(jsonFile) {
      var reader = new FileReader();
      reader.addEventListener("load", (loadEvent) => {
        // @ts-ignore
        recipeParse(JSON.parse(loadEvent.target.result));
      });
      reader.readAsText(jsonFile);
      // @ts-ignore
    })(changeEvent.target.files[0]);
  },
  false
);
