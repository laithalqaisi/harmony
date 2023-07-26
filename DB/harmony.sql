INSERT INTO `games` (`id`, `name`, `release_date`, `rating`, `publisher_id`) VALUES
    (1, 'CODE VEIN', '2019-09-27', 8.5, 1),
    (2, 'ASTRONEER', '2016-12-16', 9.1, 2),
    (3, 'Subnautica', '2018-01-23', 9.6, 3),
    (4, 'Terraria', '2011-05-16', 9.7, 4);


INSERT INTO `developers` (`id`, `name`) VALUES
    (1, 'Bandai Namco Studios'),
    (2, 'System Era Softworks'),
    (3, 'Unknown Worlds Entertainment'),
    (4, 'Re-Logic');


INSERT INTO `publishers` (`id`, `name`) VALUES
    (1, 'Bandai Namco Entertainment'),
    (2, 'System Era Softworks'),
    (3, 'Unknown Worlds Entertainment'),
    (4, 'Re-Logic');


INSERT INTO `tags` (`id`, `name`) VALUES
    (1, 'Souls-like'),
    (2, 'RPG'),
    (3, 'SinglePlayer'),
    (4, 'Co-Op'),
    (5, 'Survival'),
    (6, 'Crafting'),
    (7, 'Pixel Graphics'),
    (8, 'Psychological Horror');


INSERT INTO `developed` (`game_id`, `developer_id`) VALUES
    (1, 1),
    (2, 2),
    (3, 3),
    (4, 4);


INSERT INTO `tagged` (`game_id`, `tag_id`) VALUES
    (1, 1), (1, 2), (1, 3), (1, 4),
    (2, 3), (2, 4), (2, 6),
    (3, 3), (3, 5), (3, 6), (3, 8),
    (4, 3), (4, 4), (4, 5), (4, 6), (4, 7);
