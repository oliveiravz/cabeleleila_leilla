CREATE SCHEMA IF NOT EXISTS `cabeleleila_leila` DEFAULT CHARACTER SET utf8 ;
USE `cabeleleila_leila` ;

-- -----------------------------------------------------
-- Table `cabeleleila_leila`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cabeleleila_leila`.`users` (
  `user_id` INT AUTO_INCREMENT,
  `name` VARCHAR(100) NULL,
  `password` VARCHAR(64) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `master` TINYINT NULL,
  `deleted` TINYINT DEFAULT 0,
  PRIMARY KEY (`user_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cabeleleila_leila`.`service`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cabeleleila_leila`.`service` (
  `service_id` INT AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `price` FLOAT NULL,
  PRIMARY KEY (`service_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cabeleleila_leila`.`booking`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cabeleleila_leila`.`booking` (
  `booking_id` INT AUTO_INCREMENT,
  `date` DATETIME NULL,
  `user_id` INT NOT NULL,
  `deleted` TINYINT DEFAULT 0,
  `service_id` INT NOT NULL,
  PRIMARY KEY (`booking_id`, `user_id`, `service_id`),
  INDEX `fk_appointment_users_idx` (`user_id` ASC) VISIBLE,
  INDEX `fk_appointment_service1_idx` (`service_id` ASC) VISIBLE,
  CONSTRAINT `fk_appointment_users`
    FOREIGN KEY (`user_id`)
    REFERENCES `cabeleleila_leila`.`users` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_appointment_service1`
    FOREIGN KEY (`service_id`)
    REFERENCES `cabeleleila_leila`.`service` (`service_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

INSERT INTO `cabeleleila_leila`.`service` (`name`, `price`) VALUES
('Corte feminino', 50.00),
('Corte masculino', 35.00),
('Escova modelada', 60.00),
('Hidratação capilar', 45.00),
('Coloração', 120.00),
('Luzes / Mechas', 180.00),
('Manicure', 25.00),
('Pedicure', 30.00),
('Design de sobrancelha', 20.00),
('Maquiagem social', 80.00);

ALTER TABLE users ADD COLUMN `deleted` TINYINT DEFAULT 0;