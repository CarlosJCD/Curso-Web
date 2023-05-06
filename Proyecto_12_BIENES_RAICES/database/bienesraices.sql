-- MySQL Script generated by MySQL Workbench
-- Fri May  5 23:45:15 2023
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema bienesraices
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema bienesraices
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `bienesraices` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
USE `bienesraices` ;

-- -----------------------------------------------------
-- Table `bienesraices`.`vendedores`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bienesraices`.`vendedores` ;

CREATE TABLE IF NOT EXISTS `bienesraices`.`vendedores` (
  `id` INT(11) NOT NULL,
  `Nombre` VARCHAR(45) NULL,
  `Apellido` VARCHAR(45) NULL,
  `numTelefono` VARCHAR(10) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bienesraices`.`propiedades`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bienesraices`.`propiedades` ;

CREATE TABLE IF NOT EXISTS `bienesraices`.`propiedades` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `Titulo` VARCHAR(45) NULL,
  `precio` DECIMAL(10,2) NULL,
  `imagen` VARCHAR(200) NULL,
  `descripcion` LONGTEXT NULL,
  `habitaciones` INT(1) NULL,
  `wc` INT(1) NULL,
  `estacionamientos` INT(1) NULL,
  `creado` DATE NULL,
  `vendedores_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_propiedades_vendedores_idx` (`vendedores_id` ASC) VISIBLE,
  CONSTRAINT `fk_propiedades_vendedores`
    FOREIGN KEY (`vendedores_id`)
    REFERENCES `bienesraices`.`vendedores` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `bienesraices`.`vendedores`
-- -----------------------------------------------------
START TRANSACTION;
USE `bienesraices`;
INSERT INTO `bienesraices`.`vendedores` (`id`, `Nombre`, `Apellido`, `numTelefono`) VALUES (1, 'Carlos', 'Calderon', '9999038088');

COMMIT;
