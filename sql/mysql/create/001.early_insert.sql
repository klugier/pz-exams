INSERT INTO `new_database`.`users` (`ID`, `Email`, `Password`, `FirstName`, `Surname`, `Visibility`, `Rights`, `Gender`, `RegistretionDate`, `University`) VALUES (5, 'a@b.com', 'a', 'A', 'B', 'public', 'examiner', 'female', '2014-03-20', 'UJ');

INSERT INTO `new_database`.`users` (`ID`, `Email`, `Password`, `FirstName`, `Surname`, `Visibility`, `Rights`, `Gender`, `RegistretionDate`, `University`) VALUES (666, 'admin@b.com', 'admin', 'admin', 'qwerty', 'private', 'administrator', 'female', '2014-02-10', 'UJ');

INSERT INTO `new_database`.`exams` (`ID`, `UserID`, `Year`, `Term`, `Semester`, `Name`) VALUES (4, 5, 2014, 'I', 'L', 'ZGK');

INSERT INTO `new_database`.`exams` (`ID`, `UserID`, `Year`, `Term`, `Semester`, `Name`) VALUES (5, 5, 2014, 'I', 'L', 'ZIG');

INSERT INTO `new_database`.`examunits` (`ID`, `ExamID`, `Day`, `TimeFrom`, `TimeTo`, `State`) VALUES (1, 4, '2014-06-01', '11:00:00', '11:30:00', 'unlocked');

INSERT INTO `new_database`.`examunits` (`ID`, `ExamID`, `Day`, `TimeFrom`, `TimeTo`, `State`) VALUES (2, 5, '2014-06-01', '12:00:00', '12:30:00', 'unlocked');

INSERT INTO `new_database`.`userssettings` (`ID`, `UserID`) VALUES (1, 5);

INSERT INTO `new_database`.`userssettings` (`ID`, `UserID`) VALUES (2, 666);

INSERT INTO `new_database`.`students` (`ID`, `Email`) VALUES (1, 'student1@gmail.com');

INSERT INTO `new_database`.`students` (`ID`, `Email`) VALUES (2, 'student2@gmail.com');

INSERT INTO `new_database`.`records` (`ID`, `StudentID`, `ExamID`, `ExamUnitID`, `Code`) VALUES (1, 1, 4, 1, 'xtrope');

INSERT INTO `new_database`.`records` (`ID`, `StudentID`, `ExamID`, `ExamUnitID`, `Code`) VALUES (2, 2, 5, 2, 'saveme');

