CREATE TABLE `test`.`posts` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `userId` INT NOT NULL,
    `title` VARCHAR(256) NOT NULL,
    `body` TEXT NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB CHARSET = utf8mb4 COLLATE utf8mb4_general_ci;

CREATE TABLE `test`.`comments` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `postId` INT NOT NULL,
    `name` VARCHAR(256) NOT NULL,
    `email` VARCHAR(256) NOT NULL,
    `body` TEXT NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB CHARSET = utf8mb4 COLLATE utf8mb4_general_ci;