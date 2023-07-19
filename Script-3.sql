CREATE TABLE Ministries(
ministryId int NOT NULL,
PRIMARY KEY(ministryId));

CREATE TABLE Facilities(
facilityId int NOT NULL,
ministryId int NOT NULL,
facilityName varchar(255),
address varchar(255),
city varchar(255),
province varchar(255),
postalCode varchar(255),
phoneNumber int,
webAddress varchar(255),
capacity int,
PRIMARY KEY(facilityId, ministryId));

CREATE TABLE Managment_facilities(
facilityId int NOT NULL,
ministryId int NOT NULL,
presidentEmployeeId int ,
maFacilityType varchar(255),
PRIMARY KEY(facilityId, ministryId));

CREATE TABLE Educational_facilities(
facilityId int NOT NULL,
ministryId int NOT NULL,
prinicipalEmployeeId int NOT NULL,
eduFacilityType varchar(255),
PRIMARY KEY(facilityId, ministryId));

CREATE TABLE Employees(
employeeId int NOT NULL,
medicareNumber int NOT NULL,
jobPosition varchar(255),
PRIMARY KEY(employeeId, medicareNumber));

CREATE TABLE Teacher(
employeeId int NOT NULL,
medicareNumber int NOT NULL,
teacherType varchar(255),
subjectSpecialization varchar(255),
additionalJobPosition varchar(255),
PRIMARY KEY(employeeId, medicareNumber));

CREATE TABLE Students(
studentId int NOT NULL,
medicareNumber int NOT NULL,
gradeLevel varchar(255),
PRIMARY KEY(studentId,medicareNumber));

CREATE TABLE Works_at(
facilityId int NOT NULL,
ministryId int NOT NULL,
employeeId int NOT NULL,
medicareNumber int NOT NULL,
startDate date NOT NULL,
endDate date,
FOREIGN KEY (facilityId) REFERENCES Facilities(facilityId),
FOREIGN KEY (ministryId) REFERENCES Ministries(ministryId),
FOREIGN KEY (employeeId,medicareNumber) REFERENCES Employees(employeeId,medicareNumber),
PRIMARY KEY(facilityId,ministryId,employeeId,medicareNumber,startDate,endDate));

CREATE TABLE Registered_at(
facilityId int NOT NULL,
ministryId int NOT NULL,
studentId int NOT NULL,
medicareNumber int NOT NULL,
startDate date NOT NULL,
endDate date,
FOREIGN KEY (facilityId) REFERENCES Facilities(facilityId),
FOREIGN KEY (ministryId) REFERENCES Ministries(ministryId),
FOREIGN KEY (studentId,medicareNumber) REFERENCES Students(studentId,medicareNumber),
PRIMARY KEY(facilityId,ministryId,studentId,medicareNumber,startDate,endDate));

CREATE TABLE People(
medicareNumber int NOT NULL,
firstName varchar(255),
lastName varchar(255),
dateOfBirth date,
medicareExpiryDate date NOT NULL,
telephoneNumber int,
address varchar(255),
city varchar(255),
province varchar(255),
postalCode varchar(255),
email varchar(255),
PRIMARY KEY(medicareNumber));

CREATE TABLE Infections(
infectionId int NOT NULL,
personId int NOT NULL,
`date` date,
`type` varchar(255),
PRIMARY KEY(infectionId, personId));

CREATE TABLE Vaccinations(
vaccinationId int NOT NULL,
personId int NOT NULL,
`date` date,
`type` varchar(255),
doseNumber int,
PRIMARY KEY(vaccinationId, personId));

