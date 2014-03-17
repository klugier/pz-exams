/* Usuwanie poprzednich tabel */
DROP TABLE IF EXISTS `Records`;
DROP TABLE IF EXISTS `Students`;
DROP TABLE IF EXISTS `ExamUnits`;
DROP TABLE IF EXISTS `Exams`;
DROP TABLE IF EXISTS `Subjects`;
DROP TABLE IF EXISTS `UsersSettings`;
DROP TABLE IF EXISTS `Users`;

/* Users */
CREATE TABLE `Users` (
	`ID`               INT                                AUTO_INCREMENT,
	`Email`            VARCHAR (80)                       UNIQUE NOT NULL,
	`Password`         VARCHAR (50)                       NOT NULL,
	`FirstName`        VARCHAR (50)                       NOT NULL,
	`Surname`          VARCHAR (70)                       NOT NULL,
	`Visibility`       ENUM ('private', 'public')         NOT NULL,
	`Rights`           ENUM ('administrator', 'examiner') NOT NULL,
	`Gender`           ENUM ('female', 'male')            NOT NULL,
	`RegistretionDate` DATE                               NOT NULL,
	`University`       VARCHAR(120),
	`Telephone`        VARCHAR(15),
	`WebSite`          VARCHAR(150),
	PRIMARY KEY (`ID`)
) ENGINE=InnoDB;

/* PersonalSettings */
CREATE TABLE `UsersSettings` (
	`ID`     INT AUTO_INCREMENT,
	`UserID` INT,
	PRIMARY KEY (`ID`),
	FOREIGN KEY (`UserID`) REFERENCES `Users` (`ID`),
	INDEX (`UserID`)
) ENGINE=InnoDB;

/* Subject */
CREATE TABLE `Subjects` (
	`ID`          INT            AUTO_INCREMENT,
	`UserID`      INT,
	`Name`        VARCHAR (80)   NOT NULL,
	`Description` VARCHAR (1000),
	PRIMARY KEY (`ID`),
	FOREIGN KEY (`UserID`) REFERENCES `Users` (`ID`),
	INDEX (`UserID`)
) ENGINE=InnoDB;

/* Exam */
CREATE TABLE `Exams` (
	`ID`        INT                                         AUTO_INCREMENT,
	`SubjectID` INT,
	`Year`      YEAR                                        NOT NULL,
	`Term`      ENUM ('I', 'II', 'III', 'IV', 'V', 'other') NOT NULL,
	`Semester`  ENUM ('Z', 'L')                             NOT NULL,
	PRIMARY KEY (`ID`),
	FOREIGN KEY (`SubjectID`) REFERENCES `Subjects` (`ID`),
	INDEX (`SubjectID`)
) ENGINE=InnoDB;

/* ExamUnit */
CREATE TABLE `ExamUnits` (
	`ID`       INT  AUTO_INCREMENT,
	`ExamID`   INT,
	`Day`      DATE NOT NULL,
	`TimeFrom` TIME NOT NULL,
	`TimeTo`   TIME NOT NULL,
	PRIMARY KEY (`ID`),
	FOREIGN KEY (`ExamID`) REFERENCES `Exams` (`ID`),
	INDEX (`ExamID`)
) ENGINE=InnoDB;

/* Students */
CREATE TABLE `Students` (
	`ID`    INT          AUTO_INCREMENT,
	`Email` VARCHAR (80) NOT NULL,
	PRIMARY KEY (`ID`)
) ENGINE=InnoDB;

CREATE TABLE `Records` (
	`ID`         INT          AUTO_INCREMENT,
	`StudentID`  INT,
	`ExamID`     INT,
	`ExamUnitID` INT          NULL,
	`Code`       VARCHAR (25) NOT NULL,
	PRIMARY KEY (`ID`),
	FOREIGN KEY (`StudentID`) REFERENCES `Students` (`ID`),
	FOREIGN KEY (`ExamID`) REFERENCES `Exams` (`ID`)
) ENGINE=InnoDB;
