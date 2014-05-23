-- Skrypt wstawia do bazy danych przykładowe dane

INSERT INTO Users (Email, Password, Activated, FirstName , Surname, Visibility , Rights , Gender , RegistrationDate) VALUES ('test@uj.edu.pl','b444ac06613fc8d63795be9ad0beaf55011936ac',True,'Mariusz','Testowicz', 'private', 'examiner','male' , '2014/03/28');
INSERT INTO Users (Email, Password, Activated, FirstName , Surname, Visibility , Rights , Gender , RegistrationDate) VALUES ('antek.egzaminator@uj.edu.pl','b444ac06613fc8d63795be9ad0beaf55011936ac',True,'Antek','Egzaminator', 'private', 'examiner','male' , '2014/03/28');
INSERT INTO Users (Email, Password, Activated, FirstName , Surname, Visibility , Rights , Gender , RegistrationDate) VALUES ('admin@uj.edu.pl', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, 'Admin', 'Nerd', 'private', 'administrator', 'male', '2014-03-28');
INSERT INTO Exams (UserID, Name, Duration, Activated, EmailsPosted) VALUES ('1', 'Metody Numeryczne I - Egzamin I termin', '0:30:00', True, False);
INSERT INTO Exams (UserID, Name, Duration, Activated, EmailsPosted) VALUES ('1', 'Metody Numeryczne I - Egzamin II termin', '0:15:00', False, False);
INSERT INTO Exams (UserID, Name, Duration, Activated, EmailsPosted) VALUES ('1', 'Język C++ - Egzamin I termin', '00:15:00', True, False);
INSERT INTO Exams (UserID, Name, Duration, Activated, EmailsPosted) VALUES ('1', 'Język C++ - Egzamin II termin', '00:20:00', False, False);
INSERT INTO Exams (UserID, Name, Duration, Activated, EmailsPosted) VALUES ('1', 'Język C - Egzamin I termin', '0:05:00', True, False);
INSERT INTO Exams (UserID, Name, Duration, Activated, EmailsPosted) VALUES ('1', 'Język C - Egzamin II termin', '0:10:00', False, False);
INSERT INTO Exams (UserID, Name, Duration, Activated, EmailsPosted) VALUES ('1', 'Areonautyka - Egzamin I termin', '0:10:00', True, False);
INSERT INTO Exams (UserID, Name, Duration, Activated, EmailsPosted) VALUES ('1', 'Buddologia - Egzamin I termin', '0:20:00', False, False);
INSERT INTO Exams (UserID, Name, Duration, Activated, EmailsPosted) VALUES ('1', 'Programowanie mikrokontrolerów - Egzamin sesja poprawkowa', '0:30:00', False, False);
INSERT INTO Exams (UserID, Name, Duration, Activated, EmailsPosted) VALUES ('2', 'Przedmiot nie do zdania - Egzamin I termin', '1:00:00', False, False);
INSERT INTO Exams (UserID, Name, Duration, Activated, EmailsPosted) VALUES ('1', 'Stary egzamin - Egzamin I termin', '0:30:00', True, False);

INSERT INTO ExamUnits (ExamID, Day, TimeFrom, TimeTo, State) VALUES('1', '2014-04-16', '08:00:00', '08:30:00', 'unlocked');
INSERT INTO ExamUnits (ExamID, Day, TimeFrom, TimeTo, State) VALUES('1', '2014-06-16', '08:30:00', '09:00:00', 'unlocked');
INSERT INTO ExamUnits (ExamID, Day, TimeFrom, TimeTo, State) VALUES('1', '2014-06-16', '09:00:00', '09:30:00', 'unlocked');
INSERT INTO ExamUnits (ExamID, Day, TimeFrom, TimeTo, State) VALUES('1', '2014-06-16', '09:30:00', '10:00:00', 'unlocked');
INSERT INTO ExamUnits (ExamID, Day, TimeFrom, TimeTo, State) VALUES('2', '2014-09-01', '08:00:00', '08:30:00', 'unlocked');
INSERT INTO ExamUnits (ExamID, Day, TimeFrom, TimeTo, State) VALUES('3', '2014-06-17', '08:00:00', '08:15:00', 'locked');
INSERT INTO ExamUnits (ExamID, Day, TimeFrom, TimeTo, State) VALUES('3', '2014-06-17', '08:15:00', '08:30:00', 'unlocked');
INSERT INTO ExamUnits (ExamID, Day, TimeFrom, TimeTo, State) VALUES('3', '2014-06-18', '10:00:00', '10:15:00', 'unlocked');
INSERT INTO ExamUnits (ExamID, Day, TimeFrom, TimeTo, State) VALUES('3', '2014-06-18', '10:15:00', '10:30:00', 'unlocked');
INSERT INTO ExamUnits (ExamID, Day, TimeFrom, TimeTo, State) VALUES('7', '2015-06-18', '08:00:00', '08:10:00', 'locked');
INSERT INTO ExamUnits (ExamID, Day, TimeFrom, TimeTo, State) VALUES('7', '2015-06-18', '08:20:00', '08:30:00', 'locked');
INSERT INTO ExamUnits (ExamID, Day, TimeFrom, TimeTo, State) VALUES('8', '2015-06-18', '08:00:00', '08:20:00', 'unlocked');
INSERT INTO ExamUnits (ExamID, Day, TimeFrom, TimeTo, State) VALUES('9', '2014-06-19', '09:00:00', '09:30:00', 'unlocked');
INSERT INTO ExamUnits (ExamID, Day, TimeFrom, TimeTo, State) VALUES('9', '2014-06-20', '09:00:00', '09:30:00', 'unlocked');
INSERT INTO ExamUnits (ExamID, Day, TimeFrom, TimeTo, State) VALUES('10', '2013-06-23', '09:00:00', '10:00:00', 'unlocked');
INSERT INTO ExamUnits (ExamID, Day, TimeFrom, TimeTo, State) VALUES('11', '2013-02-20', '09:00:00', '10:00:00', 'unlocked');

INSERT INTO Students (Email, Code, FirstName, Surname) VALUES ('a@uj.edu.pl', '123', 'Adam', 'Test');
INSERT INTO Students (Email, Code, FirstName, Surname) VALUES ('b@uj.edu.pl', 'abc', 'Ewa', 'Testowa');
INSERT INTO Students (Email, Code, FirstName, Surname) VALUES ('c@uj.edu.pl', 'qwerty', 'Zbigniew', 'Pachel');

INSERT INTO Records (StudentID, ExamID) VALUES (1, 1);
INSERT INTO Records (StudentID, ExamID) VALUES (1, 2);
INSERT INTO Records (StudentID, ExamID) VALUES (1, 3);
INSERT INTO Records (StudentID, ExamID) VALUES (1, 4);
INSERT INTO Records (StudentID, ExamID) VALUES (1, 7);
INSERT INTO Records (StudentID, ExamID) VALUES (1, 11);
INSERT INTO Records (StudentID, ExamID) VALUES (2, 1);
INSERT INTO Records (StudentID, ExamID, ExamUnitID) VALUES (2, 3, 6);
INSERT INTO Records (StudentID, ExamID) VALUES (2, 11);
INSERT INTO Records (StudentID, ExamID, ExamUnitID) VALUES (2, 7, 10);
INSERT INTO Records (StudentID, ExamID, ExamUnitID) VALUES (3, 7, 11);