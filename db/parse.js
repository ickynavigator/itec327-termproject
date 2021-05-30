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
  let recipeCount = obj.length;
  let out = `
DROP TABLE IF EXISTS \`newsletter\`;
CREATE TABLE \`newsletter\` (
    \`id\` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    \`email\` VARCHAR(256)
);
DROP TABLE IF EXISTS \`contact\`;
CREATE TABLE \`contact\` (
    \`id\` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    \`name\` VARCHAR(256),
    \`email\` VARCHAR(256),
    \`message\` TEXT
);
DROP TABLE IF EXISTS \`recipes\`;
CREATE TABLE \`recipes\` (
  \`id\` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  \`name\` VARCHAR(256) NOT NULL,
  \`description\` TEXT,
  \`calories\` INT,
  \`difficulty\` INT,
  \`rating\` INT,
  \`timeToPrep\` INT,
  \`timeToCook\` INT,
  \`tag\` JSON,
  \`class\` JSON,
  \`image\` JSON,
  \`ingredient\` JSON,
  \`steps\` JSON
);
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
)` + (ind + 1 < recipeCount ? ",\n" : ";");
  });
  // document.getElementById("output").innerText = out;
  return { out, recipeCount };
}

document.getElementById("jsonFile").addEventListener(
  "change",
  (changeEvent) => {
    changeEvent.stopPropagation();
    changeEvent.preventDefault();
    (function readJsonFile(jsonFile) {
      var reader = new FileReader();
      reader.addEventListener("load", (loadEvent) => {
        const { out: sqlFormatted, recipeCount } = recipeParse(
          // @ts-ignore
          JSON.parse(loadEvent.target.result)
        );
        const file = new Blob([sqlFormatted], { type: "text/plain" });
        const fileURL = URL.createObjectURL(file);
        const linkElement = document.createElement("a");
        linkElement.setAttribute("href", fileURL);
        linkElement.setAttribute("download", "init.sql");
        linkElement.innerHTML = `<button>Download me (${recipeCount} Objects)</button>`;
        document.querySelector(".downloadDiv").appendChild(linkElement);
      });
      reader.readAsText(jsonFile);
      // @ts-ignore
    })(changeEvent.target.files[0]);
  },
  false
);
