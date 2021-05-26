SELECT DISTINCT ingredient,
    id
FROM recipes
    CROSS JOIN(
        SELECT 0 AS ind
        UNION ALL
        SELECT 1 AS ind
        UNION ALL
        SELECT 2 AS ind
        UNION ALL
        SELECT 3 AS ind
        UNION ALL
        SELECT 4 AS ind
        UNION ALL
        SELECT 5 AS ind
        UNION ALL
        SELECT 6 AS ind
        UNION ALL
        SELECT 7 AS ind
        UNION ALL
        SELECT 8 AS ind
        UNION ALL
        SELECT 9 AS ind
        UNION ALL
        SELECT 10 AS ind
        UNION ALL
        SELECT 11 AS ind
        UNION ALL
        SELECT 12 AS ind
        UNION ALL
        SELECT 13 AS ind
        UNION ALL
        SELECT 14 AS ind
        UNION ALL
        SELECT 15 AS ind
        UNION ALL
        SELECT 16 AS ind
        UNION ALL
        SELECT 17 AS ind
        UNION ALL
        SELECT 18 AS ind
        UNION ALL
        SELECT 19 AS ind
        UNION ALL
        SELECT 20 AS ind
    ) ind
WHERE JSON_EXTRACT(ingredient, CONCAT('$[', ind, '].unit')) = "mg";
--