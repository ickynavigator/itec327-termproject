Recipe{
        recipeID            : number : 1 : pk
        name                : string : 1 : required
        classification      : string : M
        keywords            : string : M
        caloriesPerPlate    : number : 1
        ranking             : number : 1 : required
        description         : string : 1
        timeToPrep          : number : 1
        timeToCook          : number : 1
        servings            : number : 1
        picture{
            pictureID       : number : 1 : required
            file            : blob   : 1 : required
        }                            : M
        steps{
            stepNo          : number : 1 : required
            stepDesc        : string : 1 : required
            stepPicture     : blob   : 1
        }                            : M : required
        notes{
            editorNote      : text   : 1
            cooksnotes      : text   : 1
            nutritionFacts  : text   : 1
        }
    }
    Ingredients {
        IngredientsID   : number : 1 : pk
        name            : string : 1 : required
        amount          : string : 1 : required
    }          