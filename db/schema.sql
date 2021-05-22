-- IMPORTANT QUERIES
select vals
from Test
where JSON_EXTRACT(vals, "$.amount") = 500;
-- 
-- SELECT JSON_EXTRACT(vals, CONCAT('$[', ind.ind, '].name')), ind.ind
-- 
SELECT JSON_EXTRACT(vals, CONCAT('$[', ind, '].name'))
FROM Test
    CROSS JOIN (
        SELECT 0 AS ind
        UNION ALL
        SELECT 1 AS ind
        UNION ALL
        SELECT 2 AS ind
    ) ind
WHERE JSON_LENGTH(vals) > ind
    AND JSON_CONTAINS(vals->'$[*].amount', json_array(500));