class Recipe {
  id = "";
  name = 0;
  classification = [""];
  keywords = [""];
  caloriesPerPlate = 0;
  ranking = 0;
  description = "";
  timeToPrep = 0;
  timeToCook = 0;
  servings = 0;
  pictures = [Picture];
  steps = [Steps];
  Ingredients = [Ingredient];
  constructor() {}
}

class Picture {
  name = "";
  fileName = "";
  constructor() {}
}

class Steps {
  number = 0;
  description = "";
  picture = Picture;
  constructor() {}
}

class Ingredient {
  id = 0;
  name = "";
  amount = 0;
  constructor() {}
}
