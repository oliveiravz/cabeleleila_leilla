CREATE SCHEMA IF NOT EXISTS `cabeleleila_leila` DEFAULT CHARACTER SET utf8 ;
USE `cabeleleila_leila` ;

CREATE TABLE IF NOT EXISTS `cabeleleila_leila`.`users` (
  `user_id` INT NOT NULL,
  `name` VARCHAR(100) NULL,
  `password` VARCHAR(64) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `master` TINYINT NULL,
  PRIMARY KEY (`user_id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `cabeleleila_leila`.`service` (
  `service_id` INT NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  `price` FLOAT NULL,
  PRIMARY KEY (`service_id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `cabeleleila_leila`.`appointment` (
  `appointment_id` INT NOT NULL,
  `name_costumer` VARCHAR(100) NOT NULL,
  `date` DATETIME NULL,
  `user_id` INT NOT NULL,
  `service_id` INT NOT NULL,
  PRIMARY KEY (`appointment_id`, `name_costumer`, `user_id`, `service_id`),
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