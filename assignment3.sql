-- Assignment 3 INFO20003
-- Name: Derek Chen
-- Student ID: 766509



-- allows deletion if foriegn key of the tables primary key, exist in another table
SET FOREIGN_KEY_CHECKS=0; 


-- drop tables allow me to reset all the data to initial state (for debugging purposes)
-- -----------------------------------------------------
-- Table `Spatula`
-- -----------------------------------------------------
DROP TABLE IF EXISTS Spatula ;

CREATE TABLE IF NOT EXISTS Spatula (
  idSpatula INT NOT NULL AUTO_INCREMENT,
  Name VARCHAR(45) NULL,
  Type ENUM('Food','Drugs','Paints','Plaster'),
  Size VARCHAR(50),
  Colour VARCHAR(50),
  Price DECIMAL(10,2),
  QuantityInStock INT,
  PRIMARY KEY (idSpatula))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `Order`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Order` ;

CREATE TABLE IF NOT EXISTS `Order` (
  idOrder INT NOT NULL AUTO_INCREMENT,
  RequestedTime DATETIME NOT NULL,
  ResponsibleStaffMember VARCHAR(100) NOT NULL,
  CustomerDetails VARCHAR(300) NOT NULL,
  PRIMARY KEY (idOrder))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `OrderLineItem`
-- -----------------------------------------------------
DROP TABLE IF EXISTS OrderLineItem ;

CREATE TABLE IF NOT EXISTS OrderLineItem (
  idSpatula INT NOT NULL,
  idOrder INT NOT NULL,
  Quantity INT NOT NULL,
  PRIMARY KEY (idSpatula,idOrder),
    FOREIGN KEY (idSpatula)
    REFERENCES Spatula (idSpatula)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (idOrder)
    REFERENCES `Order` (idOrder)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

INSERT INTO Spatula
  VALUES
  (DEFAULT,'S2','Drugs','7','black','5.50',0),
  (DEFAULT,'S3','Food','13','silver','15.50',32),
  (DEFAULT,'S4','Plaster','16','red','35.00',0),
  (DEFAULT,'S6','Paints','20','black','25.50',18), 
  (DEFAULT,'S8','Food','13','green','13.99',14), 
  (DEFAULT,'S10','Drugs','7','silver','6.50',0),
  (DEFAULT,'S11','Food','13','black','15.50',42), 
  (DEFAULT,'S12','Plaster','15','red','32.00',0),
  (DEFAULT,'S13','Paints','20','black','25.50',18), 
  (DEFAULT,'S15','Food','14','green','12.99',0);
 
INSERT INTO `Order`
  VALUES
  (DEFAULT,'2016-04-11 3:30:00','Derek Chen','Name: Jasmine
  Address: 222 Spatula Street, 3053'),
  (DEFAULT,'2016-04-11 4:30:00','Derek Chen','Name: John'),
  (DEFAULT,'2016-08-11 6:30:00','Derek Chen','Name: Dory'),
  (DEFAULT,'2016-12-11 5:30:00','Derek Chen','Name: Kevin'),
  (DEFAULT,'2016-11-11 1:30:00','Derek Chen','Name: Steven');
  
INSERT INTO OrderLineItem
  VALUES
  (2,1,9),
  (2,2,4),
  (2,3,9),
  (2,4,8),
  (2,5,5),
  (4,2,5),
  (4,3,3),
  (5,3,3),
  (4,4,3),
  (5,4,3),
  (7,4,3),
  (4,5,3),
  (5,5,3),
  (7,5,3),
  (9,5,3);

# ------------------------------------------------------------------------------------------
SET FOREIGN_KEY_CHECKS=1; 