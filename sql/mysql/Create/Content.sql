-- Skrypt wstawia do bazy danych przykładowe dane

INSERT INTO Users (Email, Password, Activated, FirstName , Surname, Visibility , Rights , Gender , RegistrationDate) VALUES ('test@uj.edu.pl','test1','TRUE','Marisz','Testowicz', 'private', 'examiner','male' , '2014/03/28');

INSERT INTO Exams (UserID, Name, Duration) VALUES ('1', 'dase', '1:00:00');
INSERT INTO Exams (UserID, Name, Duration) VALUES ('1', 'fewa', '1:20:00');
INSERT INTO Exams (UserID, Name, Duration) VALUES ('1', 'gzds', '00:15:00');
INSERT INTO Exams (UserID, Name, Duration) VALUES ('1', 'wwrq', '00:49:00');
INSERT INTO Exams (UserID, Name, Duration) VALUES ('1', 'gasf', '2:00:00');
