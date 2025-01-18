CREATE DATABASE PawsitiveWellbeing;

USE PawsitiveWellbeing;

-- General Users Table
CREATE TABLE GeneralUsers (
    GeneralUserID INT PRIMARY KEY AUTO_INCREMENT,
    FullName VARCHAR(255) NOT NULL,
    Email VARCHAR(255) UNIQUE NOT NULL,
    Phone VARCHAR(15),
    Password VARCHAR(255) NOT NULL,  
    Address TEXT,
    CityStateCountry VARCHAR(255),
    LocationEnabled BOOLEAN DEFAULT FALSE,
    AdoptionNotifications BOOLEAN DEFAULT FALSE,
    DonationCampaignNotifications BOOLEAN DEFAULT FALSE,
    NewsletterSubscription BOOLEAN DEFAULT FALSE,
    ProfilePicturePath VARCHAR(255),
    SocialMediaLinks TEXT,
    EmailVerified BOOLEAN DEFAULT FALSE
) ENGINE = InnoDB AUTO_INCREMENT = 100000;

-- Volunteers Table
CREATE TABLE Volunteers (
    VolunteerID INT PRIMARY KEY AUTO_INCREMENT,
    FullName VARCHAR(100) NOT NULL,
    Email VARCHAR(255) NOT NULL UNIQUE,
    Phone VARCHAR(15) NOT NULL,
    Password VARCHAR(255) NOT NULL, 
    HomeAddress TEXT NOT NULL,
    CityStateCountry VARCHAR(255) NOT NULL,
    LocationEnabled BOOLEAN DEFAULT FALSE,
    EmergencyRescue BOOLEAN DEFAULT FALSE,
    OrganizeCampaigns BOOLEAN DEFAULT FALSE,
    ManageAdoption BOOLEAN DEFAULT FALSE,
    Skills TEXT,
    ExperienceYears INT CHECK (ExperienceYears >= 0),
    Availability BOOLEAN DEFAULT TRUE
) ENGINE = InnoDB AUTO_INCREMENT = 110000;

-- Veterinarians Table
CREATE TABLE Veterinarians (
    VeterinarianID INT PRIMARY KEY AUTO_INCREMENT,
    FullName VARCHAR(100) NOT NULL,
    Email VARCHAR(255) UNIQUE NOT NULL,
    Phone VARCHAR(15) NOT NULL,
    Password VARCHAR(255) NOT NULL,  
    ClinicAddress TEXT,
    LocationEnabled BOOLEAN DEFAULT TRUE,
    License BIGINT NOT NULL,
    ClinicName VARCHAR(100),
    Speciality VARCHAR(50),
    Services TEXT,
    WorkingHours VARCHAR(50),
    VetLicensePath VARCHAR(255),
    GovIDPath VARCHAR(255),
    TrainingMaterialsPath VARCHAR(255),
    HostTraining ENUM('yes', 'no') DEFAULT 'no'
) ENGINE = InnoDB AUTO_INCREMENT = 120000;

-- Benefactors Table
CREATE TABLE Benefactors (
    BenefactorID INT PRIMARY KEY AUTO_INCREMENT,
    FullName VARCHAR(255) NOT NULL,
    Email VARCHAR(255) UNIQUE NOT NULL,
    Phone VARCHAR(15) NOT NULL,
    Address TEXT NOT NULL,
    OrganizationType ENUM('IndividualDonor', 'CorporateSponsor', 'NgoPartner') DEFAULT 'IndividualDonor',
    DonationType ENUM('One-time', 'Monthly') NOT NULL,
    PreferredCampaign VARCHAR(100),
    Availability VARCHAR(100),
    PaymentMethod ENUM('credit-card', 'paypal', 'other'),
    SavePayment ENUM('yes', 'no') DEFAULT 'no',
    SponsorEvents ENUM('yes', 'no') DEFAULT 'no',
    NgoPartnership ENUM('yes', 'no') DEFAULT 'no',
    AdditionalNotes TEXT
) ENGINE = InnoDB AUTO_INCREMENT = 130000;

-- Shelter Table
CREATE TABLE Shelter (
    ShelterID INT PRIMARY KEY AUTO_INCREMENT,
    ShelterName VARCHAR(255) NOT NULL,
    Address TEXT NOT NULL,
    CityStateCountry VARCHAR(255),
    ContactNumber VARCHAR(20),
    Email VARCHAR(255) UNIQUE NOT NULL,
    ShelterType ENUM('Private', 'Government', 'NGO') DEFAULT 'NGO'
) ENGINE = InnoDB;

-- Campaigns Table
CREATE TABLE Campaigns (
    CampaignID INT PRIMARY KEY AUTO_INCREMENT,
    CampaignName VARCHAR(100) NOT NULL,
    Description TEXT,
    StartDate DATE NOT NULL,
    EndDate DATE,
    GoalAmount DECIMAL(10, 2),
    RaisedAmount DECIMAL(10, 2) DEFAULT 0.00,
    CreatedBy INT NOT NULL,
    FOREIGN KEY (CreatedBy) REFERENCES Volunteers(VolunteerID) ON DELETE CASCADE
) ENGINE = InnoDB;

-- Donations Table
CREATE TABLE Donations (
    DonationID INT PRIMARY KEY AUTO_INCREMENT,
    CampaignID INT NOT NULL,
    BenefactorID INT NOT NULL,
    DonationAmount DECIMAL(10, 2) NOT NULL,
    DonationDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (CampaignID) REFERENCES Campaigns(CampaignID) ON DELETE CASCADE,
    FOREIGN KEY (BenefactorID) REFERENCES Benefactors(BenefactorID) ON DELETE CASCADE
) ENGINE = InnoDB;

-- Animals Table
CREATE TABLE Animal (
    AnimalID INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(50) NOT NULL,
    Species VARCHAR(50) NOT NULL,
    Breed VARCHAR(50),
    Age INT,
    Gender ENUM('Male', 'Female', 'Unknown'),
    AnimalCondition VARCHAR(255),
    RescueDate DATE,
    AdoptionStatus ENUM('Available', 'Adopted', 'Pending', 'UnderCare'),
    ShelterID INT,
    FOREIGN KEY (ShelterID) REFERENCES Shelter(ShelterID) ON DELETE SET NULL
) ENGINE = InnoDB;

-- Rescue Missions Table
CREATE TABLE RescueMissions (
    MissionID INT PRIMARY KEY AUTO_INCREMENT,
    MissionName VARCHAR(100) NOT NULL,
    Description TEXT,
    ReportedBy INT NOT NULL,  -- Not allowing NULL
    AssignedTo INT,
    Location TEXT NOT NULL,
    Status ENUM('Pending', 'In Progress', 'Completed', 'Cancelled', 'Resolved') DEFAULT 'Pending',
    PriorityLevel ENUM('Low', 'Medium', 'High') DEFAULT 'Medium',
    RegisteredDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ReportedBy) REFERENCES GeneralUsers(GeneralUserID) ON DELETE CASCADE,  
    FOREIGN KEY (AssignedTo) REFERENCES Volunteers(VolunteerID) ON DELETE CASCADE
) ENGINE = InnoDB;