INSERT INTO ft_table(`login`, `group`, `creation_date`)
SELECT `last_name`,  'other' AS `group`, `birthdate`
FROM `user_card`
WHERE `last_name` LIKE '%a%' AND length(`last_name`) < 9 
ORDER BY `last_name` ASC
LIMIT 10;