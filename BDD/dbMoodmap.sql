SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `moodmapDB` ;
CREATE SCHEMA IF NOT EXISTS `moodmapDB` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `moodmapDB` ;

-- -----------------------------------------------------
-- Table `moodmapDB`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `moodmapDB`.`user` ;

CREATE TABLE IF NOT EXISTS `moodmapDB`.`user` (
  `id` INT(11) NULL AUTO_INCREMENT,
  `username` VARCHAR(16) NULL,
  `email` VARCHAR(255) NULL,
  `password` VARCHAR(32) NULL,
  `activated` TINYINT(1) NULL,
  `challenge` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC));


-- -----------------------------------------------------
-- Table `moodmapDB`.`impression`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `moodmapDB`.`impression` ;

CREATE TABLE IF NOT EXISTS `moodmapDB`.`impression` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `iconpath` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `iconpath_UNIQUE` (`iconpath` ASC),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC));


-- -----------------------------------------------------
-- Table `moodmapDB`.`zone`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `moodmapDB`.`zone` ;

CREATE TABLE IF NOT EXISTS `moodmapDB`.`zone` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(20) NOT NULL,
  `p1_x` INT(11) NULL,
  `p1_y` INT(11) NOT NULL,
  `p2_x` INT(11) NOT NULL,
  `p2_y` INT(11) NOT NULL,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `moodmapDB`.`datazone`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `moodmapDB`.`datazone` ;

CREATE TABLE IF NOT EXISTS `moodmapDB`.`datazone` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `score` FLOAT NOT NULL,
  `id_zone` INT(11) NOT NULL,
  `id_impression` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_datazone_1_idx` (`id_zone` ASC),
  INDEX `id_im_idx` (`id_impression` ASC),
  CONSTRAINT `id_z`
    FOREIGN KEY (`id_zone`)
    REFERENCES `moodmapDB`.`zone` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_im`
    FOREIGN KEY (`id_impression`)
    REFERENCES `moodmapDB`.`impression` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `moodmapDB`.`vote`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `moodmapDB`.`vote` ;

CREATE TABLE IF NOT EXISTS `moodmapDB`.`vote` (
  `id` INT NULL AUTO_INCREMENT,
  `id_user` INT(11) NOT NULL,
  `id_impression` INT(11) NOT NULL,
  `id_datazone` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `id_idx` (`id_user` ASC),
  INDEX `id_idx1` (`id_impression` ASC),
  INDEX `id_d_idx` (`id_datazone` ASC),
  CONSTRAINT `id_u`
    FOREIGN KEY (`id_user`)
    REFERENCES `moodmapDB`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_i`
    FOREIGN KEY (`id_impression`)
    REFERENCES `moodmapDB`.`impression` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_d`
    FOREIGN KEY (`id_datazone`)
    REFERENCES `moodmapDB`.`datazone` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;