-- Skrypt wstawia do bazy danych przykładowe dane

INSERT INTO Users (Email, Password, Activated, FirstName , Surname, Visibility , Rights , Gender , RegistrationDate) VALUES ('test@uj.edu.pl','b444ac06613fc8d63795be9ad0beaf55011936ac','TRUE','Marisz','Testowicz', 'private', 'examiner','male' , '2014/03/28');

INSERT INTO Exams (UserID, Name, Duration, Activated, EmailsPosted) VALUES ('1', 'Metody Numeryczne I - Egzamin I termin', '0:30:00', False, False);
INSERT INTO Exams (UserID, Name, Duration, Activated, EmailsPosted) VALUES ('1', 'Metody Numeryczne I - Egzamin II termin', '0:15:00', False, False);
INSERT INTO Exams (UserID, Name, Duration, Activated, EmailsPosted) VALUES ('1', 'Język C++ - Egzamin I termin', '00:15:00', False, False);
INSERT INTO Exams (UserID, Name, Duration, Activated, EmailsPosted) VALUES ('1', 'Język C++ - Egzamin II termin', '00:20:00', False, False);
INSERT INTO Exams (UserID, Name, Duration, Activated, EmailsPosted) VALUES ('1', 'Język C - Egzamin I termin', '0:05:00', False, False);
INSERT INTO Exams (UserID, Name, Duration, Activated, EmailsPosted) VALUES ('1', 'Język C - Egzamin II termin', '0:10:00', False, False);
INSERT INTO Exams (UserID, Name, Duration, Activated, EmailsPosted) VALUES ('1', 'Areonautyka - Egzamin I termin', '0:10:00', False, False);
INSERT INTO Exams (UserID, Name, Duration, Activated, EmailsPosted) VALUES ('1', 'Buddologia - Egzamin I termin', '0:20:00', False, False);

INSERT INTO ExamUnits (ExamID, Day, TimeFrom, TimeTo, State) VALUES('2', '2014-03-01', '08:00:00', '08:30:00', 'unlocked');
INSERT INTO ExamUnits (ExamID, Day, TimeFrom, TimeTo, State) VALUES('2', '2014-10-01', '08:00:00', '08:30:00', 'unlocked');

INSERT INTO ExamUnits (ExamID, Day, TimeFrom, TimeTo, State) VALUES('3', '2014-03-15', '08:00:00', '08:10:00', 'unlocked');

INSERT INTO ExamUnits (ExamID, Day, TimeFrom, TimeTo, State) VALUES('8', '2015-03-15', '08:00:00', '08:20:00', 'unlocked');