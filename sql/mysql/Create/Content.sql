-- Skrypt wstawia do bazy danych przykładowe dane

INSERT INTO Users (Email, Password, Activated, FirstName , Surname, Visibility , Rights , Gender , RegistrationDate) VALUES ('test@uj.edu.pl','b444ac06613fc8d63795be9ad0beaf55011936ac','TRUE','Marisz','Testowicz', 'private', 'examiner','male' , '2014/03/28');

INSERT INTO Exams (UserID, Name, Duration, Activated, EmailsPosted) VALUES ('1', 'Metody Numeryczne I - Egzamin I termin', '0:30:00', False, False);
INSERT INTO Exams (UserID, Name, Duration, Activated, EmailsPosted) VALUES ('1', 'Metody Numeryczne I - Egzamin II termin', '0:15:00', False, False);
INSERT INTO Exams (UserID, Name, Duration, Activated, EmailsPosted) VALUES ('1', 'Język C++ - Egzamin I termin', '00:15:00', False, False);
INSERT INTO Exams (UserID, Name, Duration, Activated, EmailsPosted) VALUES ('1', 'Język C++ - Egzamin II termin', '00:20:00', False, False);
INSERT INTO Exams (UserID, Name, Duration, Activated, EmailsPosted) VALUES ('1', 'Język C - Egzamin I termin', '0:05:00', False, False);
INSERT INTO Exams (UserID, Name, Duration, Activated, EmailsPosted) VALUES ('1', 'Język C - Egzamin II termin', '0:10:00', False, False);
