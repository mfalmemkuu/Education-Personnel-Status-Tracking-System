
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
    PRIMARY KEY (ScheduleID),
	CONSTRAINT check_time CHECK(startTime<endTime)
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




-- Triggers


-- Prevents an employee that is not vaccinated in the last 6 months from being assigned a schedule
delimiter //
CREATE TRIGGER EmployeeHasVaccineTrigger
BEFORE insert ON has_schedule 
FOR EACH ROW
begin 
	if 0 = (select count(*) from Vaccinations v where v.MedicareCardNumber = new.MedicareCardNumber and v.`Date` >= date_sub((select s.`Date` from schedule s where s.ScheduleID = new.ScheduleID), interval  6 month))
	then 
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = "Employee has not been vaccinated in the last 6 months.";
	end if;
end
//


-- When a teacher becomes infected, an email is sent to the principal and its assigned schedules are cancelled.
delimiter //
CREATE TRIGGER TeacherInfectionsTrigger
AFTER insert ON infections 
for each row
begin 
	declare facility_id int;
	declare principal_email varchar(255);
	declare teacher_name varchar(255);
	
	if 0<(select count(*) from teachers t where t.MedicareCardNumber = new.MedicareCardNumber)
	then
		update schedule 
		set isCancelled = true 
		where ScheduleID in (Select s.ScheduleID from Has_schedule hs join schedule s on hs.ScheduleID = s.ScheduleID
		where hs.MedicareCardNumber = new.MedicareCardNumber and s.`Date` <= date_add(curdate(), interval 2 week)
		and s.`Date` >= curdate() 
		and hs.MedicareCardNumber in (select t.MedicareCardNumber from teachers t));

	set @facility_id := (select wa.FacilityID from works_at wa where wa.MedicareCardNumber = new.MedicareCardNumber and wa.EndDate is null limit 1);
	set @principal_email := (select p.EmailAddress from educationalfacilities e join persons p on e.PrincipalMedicareNumber = p.MedicareCardNumber where e.FacilityID = facility_id);	
	set @teacher_name := (select concat(concat(p.FirstName ," "),p.LastName) from persons p where p.MedicareCardNumber=new.MedicareCardNumber);


	insert into email_log(subject,sender,receiver,`date`,body) values("Warning",(select f.Name from facilities f where f.FacilityID=facility_id),(select @principal_email),current_date(),LEFT(concat((select @teacher_name), concat(" who teaches in your school has been infected with ",concat(new.`type`,concat(" on ",concat(dayofmonth(new.`Date`) ,concat(", ",concat(monthname(new.`Date`) ,concat(", ",year(new.`Date`))))))))),80));
	
	insert into email_sent(LogID, FacilityID, MedicareCardNumber) values((select LAST_INSERT_ID()), (select @facility_id), new.MedicareCardNumber);
end if;
end
//

-- When an employee is given a schedule that causes a conflict (less than one hour between schedules), it will be denied.
delimiter //
CREATE TRIGGER ScheduleConflictTrigger
BEFORE insert ON has_schedule 
FOR EACH row
begin 
	declare start_time time;
	declare end_time time;
	declare new_date date;	

	set @start_time := (select s.startTime from schedule s where s.ScheduleID = new.ScheduleID);
	set @end_time := (select s.endTime from schedule s where s.ScheduleID = new.ScheduleID);
	set @new_date := (select s.`Date`  from schedule s where s.ScheduleID = new.ScheduleID);
	
	if (select count(*) from schedule s join has_schedule hs on hs.ScheduleID =s.ScheduleID 
where hs.MedicareCardNumber = new.MedicareCardNumber
and s.`Date` = (select @new_date)) 
<> 
(select count(*) from schedule s join has_schedule hs on hs.ScheduleID =s.ScheduleID 
where hs.MedicareCardNumber = new.MedicareCardNumber
and s.`Date` = (select @new_date)
and ((timediff((select @start_time),s.endTime)>='01:00:00') or (timediff(s.startTime,(select @end_time))>='01:00:00')))
	then
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = "Not enough time allowed between Schedules. A minimum of 1 hour is needed.";
	end if;
	
end
//
