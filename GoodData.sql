-- Ministry of Education - Quebec
INSERT INTO Ministries (MinistryID, Name) VALUES (3, 'Ministry of Education - Quebec');

-- Ministry of Education - Quebec Facilities
INSERT INTO Facilities (Name, WebAddress, Capacity, PostalCode, PhoneNumber) VALUES
('Quebec Education Headquarters', 'www.educationquebec.gouv.qc.ca', 500, 'H2Y 1T1', '514-555-1111');
INSERT INTO HeadOfficeFacilities (FacilityID) VALUES (LAST_INSERT_ID());

INSERT INTO Facilities (Name, WebAddress, Capacity, PostalCode, PhoneNumber) VALUES
('General Management Facility 1 - Quebec', 'www.gmf1-quebec.ca', 200, 'H2Y 2S1', '514-555-2222'),
('General Management Facility 2 - Quebec', 'www.gmf2-quebec.ca', 180, 'H2Y 3T1', '514-555-3333');
INSERT INTO GeneralManagementFacilities (FacilityID) VALUES (LAST_INSERT_ID() - 1), (LAST_INSERT_ID());

INSERT INTO Facilities (Name, WebAddress, Capacity, PostalCode, PhoneNumber) VALUES
('John Renny High School - Quebec', 'www.johnrennyhigh-quebec.ca', 800, 'H3A 1T1', '514-555-4444'),
('Quebec Elementary School - Quebec', 'www.quebecele-quebec.ca', 500, 'H3B 2T2', '514-555-5555'),
('Maplewood Middle School - Quebec', 'www.maplewoodmiddle-quebec.ca', 600, 'H3C 1T3', '514-555-6666'),
('Westminster Primary School - Quebec', 'www.westminsterprimary-quebec.ca', 400, 'H3A 1W1', '514-555-7777'),
('Rosehill Secondary School - Quebec', 'www.rosehillsecondary-quebec.ca', 700, 'H3B 2W2', '514-555-8888'),
('Quebec High School - Quebec', 'www.quebechigh-quebec.ca', 900, 'H3C 1W3', '514-555-9999'),
('Greenwood Middle School - Quebec', 'www.greenwoodmiddle-quebec.ca', 600, 'H3A 1X1', '514-555-0000'),
('Hilltop Elementary School - Quebec', 'www.hilltopelem-quebec.ca', 550, 'H3B 2X2', '514-555-1010'),
('Northview Secondary School - Quebec', 'www.northviewsecondary-quebec.ca', 750, 'H3C 1X3', '514-555-2020'),
('Quebec East High School - Quebec', 'www.quebeceasthigh-quebec.ca', 800, 'H3A 1Y1', '514-555-3030');
INSERT INTO EducationalFacilities (FacilityID) VALUES 
(LAST_INSERT_ID() - 9), (LAST_INSERT_ID() - 8), (LAST_INSERT_ID() - 7), (LAST_INSERT_ID() - 6), (LAST_INSERT_ID() - 5),
(LAST_INSERT_ID() - 4), (LAST_INSERT_ID() - 3), (LAST_INSERT_ID() - 2), (LAST_INSERT_ID() - 1), LAST_INSERT_ID());

-- Ministry of Education - Quebec Postal Codes
INSERT INTO Addresses_facilities (PostalCode, Province, Address, City) VALUES
('H2Y 1T1', 'Quebec', '1234 St-Laurent Blvd', 'Montreal'),
('H2Y 2S1', 'Quebec', '5678 Sherbrooke St', 'Montreal'),
('H2Y 3T1', 'Quebec', '9101 St-Catherine St', 'Laval'),
('H3A 1T1', 'Quebec', '2222 University St', 'Laval'),
('H3B 2T2', 'Quebec', '3333 Drummond St', 'Quebec City'),
('H3C 1T3', 'Quebec', '4444 Peel St', 'Quebec City'),
('H3A 1W1', 'Quebec', '5555 Park Ave', 'Quebec City'),
('H3B 2W2', 'Quebec', '6666 Bishop St', 'Quebec City'),
('H3C 1W3', 'Quebec', '7777 Guy St', 'Gatineau'),
('H3A 1X1', 'Quebec', '8888 Mont-Royal Ave', 'Gatineau'),
('H3B 2X2', 'Quebec', '9999 St-Denis St', 'Sherbrooke'),
('H3C 1X3', 'Quebec', '1010 Maisonneuve St', 'Sherbrooke'),
('H3A 1Y1', 'Quebec', '1212 Peel St', 'Trois-Rivières');

-- Ministry of Education - Quebec Operates
INSERT INTO Operates (FacilityID, MinistryID) VALUES
(43, 3),
(44, 3),
(45, 3),
(46, 3),
(47, 3),
(48, 3),
(49, 3),
(50, 3),
(51, 3),
(52, 3),
(53, 3),
(54, 3),
(55, 3),
(56, 3),
(57, 3),
(58, 3),
(59, 3),
(60, 3),
(61, 3),
(62, 3),
(63, 3);
