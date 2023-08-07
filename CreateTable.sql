
CREATE TABLE Persons(
  MedicareCardNumber char(12) NOT NULL,
  FirstName VARCHAR(255),
  LastName VARCHAR(255),
  MedicareExpiryDate date NOT NULL,
  DateOfBirth date,
  TelephoneNumber char(12),
  Citizenship VARCHAR(255),
  PostalCode char(7),
  EmailAddress VARCHAR(255),
  PRIMARY KEY (MedicareCardNumber)
);

CREATE TABLE Facilities(
    FacilityID int NOT NULL AUTO_INCREMENT,
    Name VARCHAR(255),
    WebAddress VARCHAR(255),
    Capacity int,
    PostalCode char(7),
    PhoneNumber char(12),
    PRIMARY KEY (FacilityID)
);

CREATE TABLE Addresses_persons(
    PostalCode char(7) NOT NULL,
    Province VARCHAR(255),
    Address VARCHAR(255),
    City VARCHAR(255),
    CONSTRAINT PK_Addresses_persons PRIMARY KEY (PostalCode)
);

CREATE TABLE Addresses_facilities(
    PostalCode char(7) NOT NULL,
    Province VARCHAR(255),
    Address VARCHAR(255),
    City VARCHAR(255),
    CONSTRAINT PK_Addresses_facilities PRIMARY KEY (PostalCode)
);

CREATE TABLE Students(
    MedicareCardNumber char(12) NOT NULL,
    CurrentLevel VARCHAR(255),
    PRIMARY KEY (MedicareCardNumber)
);

CREATE TABLE Employees(
    MedicareCardNumber char(12) NOT NULL,
    PRIMARY KEY (MedicareCardNumber)
);


CREATE TABLE Teachers(
    MedicareCardNumber char(12) NOT NULL,
    Level VARCHAR(255),
    Specialisation VARCHAR(255),
    PRIMARY KEY (MedicareCardNumber)
);

CREATE TABLE Infections(
    MedicareCardNumber char(12) NOT NULL,
    `Date` Date,
    `Type` VARCHAR(255),
    FOREIGN KEY (MedicareCardNumber) REFERENCES Persons(MedicareCardNumber)
);

CREATE TABLE Vaccinations(
    MedicareCardNumber char(12) NOT NULL,
    `Date` Date,
    `Type` VARCHAR(255),
    DoseNumber int,
    FOREIGN KEY (MedicareCardNumber) REFERENCES Persons(MedicareCardNumber)
);

CREATE TABLE Ministries(
    MinistryID int NOT NULL,
    Name VARCHAR(255),
    PRIMARY KEY (MinistryID)
);

CREATE TABLE Operates(
    FacilityID int NOT NULL,
    MinistryID int,
    PRIMARY KEY (FacilityID),
    FOREIGN KEY (MinistryID) REFERENCES Ministries(MinistryID)
);

CREATE TABLE ManagementFacilities(
    FacilityID int NOT NULL,
    PresidentMedicareNumber char(12) NOT NULL,
    PRIMARY KEY (FacilityID),
    FOREIGN KEY (PresidentMedicareNumber) REFERENCES Employees(MedicareCardNumber)
);

CREATE TABLE HeadOfficeFacilities(
    FacilityID int NOT NULL,
    PRIMARY KEY (FacilityID)
);

CREATE TABLE GeneralManagementFacilities(
    FacilityID int NOT NULL,
    PRIMARY KEY (FacilityID)
);

CREATE TABLE EducationalFacilities(
    FacilityID int NOT NULL,
    PrincipalMedicareNumber char(12) NOT NULL,
    PRIMARY KEY (FacilityID),
    FOREIGN KEY (PrincipalMedicareNumber) REFERENCES Employees(MedicareCardNumber)
);

CREATE TABLE PrimarySchools(
    FacilityID int NOT NULL,
    PRIMARY KEY (FacilityID)
);

CREATE TABLE MiddleSchools(
    FacilityID int NOT NULL,
    PRIMARY KEY (FacilityID)
);

CREATE TABLE HighSchools(
    FacilityID int NOT NULL,
    PRIMARY KEY (FacilityID)
);

CREATE TABLE Works_at(
    MedicareCardNumber char(12) NOT NULL,
    FacilityID int NOT NULL,
    StartDate date,
    EndDate date,
    Role VARCHAR(255),
    CONSTRAINT PK_Works_at PRIMARY KEY (MedicareCardNumber, FacilityID, StartDate)
);

CREATE TABLE Registered_at(
    MedicareCardNumber char(12) NOT NULL,
    FacilityID int NOT NULL,
    StartDate date,
    EndDate date,
    CONSTRAINT PK_Registered_at PRIMARY KEY (MedicareCardNumber, FacilityID, StartDate)
);

CREATE TABLE Schedule(
    ScheduleID int NOT NULL AUTO_INCREMENT,
    `Date` date,
    isCancelled boolean,
    startTime time,
    endTime time,
    PRIMARY KEY (ScheduleID)
);

CREATE TABLE Has_schedule(
    ScheduleID int NOT NULL,
    FacilityID int NOT NULL,
    MedicareCardNumber char(12) NOT NULL,
    CONSTRAINT PK_Has_schedule PRIMARY KEY (ScheduleID,FacilityID, MedicareCardNumber)
);

CREATE TABLE Email_log(
    LogID int NOT NULL AUTO_INCREMENT,
    subject VARCHAR(255),
    sender VARCHAR(255),
    receiver VARCHAR(255),
    `date` date,
    body VARCHAR(255),
    PRIMARY KEY(LogID)
);

CREATE TABLE Email_sent(
    LogID int NOT NULL,
    FacilityID int NOT NULL,
    MedicareCardNumber char(12) NOT NULL,
    CONSTRAINT PK_Has_schedule PRIMARY KEY (LogID,FacilityID, MedicareCardNumber)
);

