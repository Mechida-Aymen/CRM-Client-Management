USE symfony;

INSERT INTO `user` (`identifiant`, `roles`, `password`, `nom`, `prenom`, `email`)
VALUES
('user1', '["ROLE_USER"]', '$2y$13$.jEwgfBI/439UMfJZ9BJvuVpg1KFWxFjmJeWRQsyrnzrjXxC/p19a', 'Smith', 'Alice', 'user1@example.com'),
('user2', '["ROLE_USER"]', '$2y$13$.jEwgfBI/439UMfJZ9BJvuVpg1KFWxFjmJeWRQsyrnzrjXxC/p19a', 'Doe', 'Bob', 'user2@example.com'),
('user3', '["ROLE_USER"]', '$2y$13$.jEwgfBI/439UMfJZ9BJvuVpg1KFWxFjmJeWRQsyrnzrjXxC/p19a', 'Jones', 'Eve', 'user3@example.com');
