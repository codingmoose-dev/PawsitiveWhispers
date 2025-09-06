-- Create Database
CREATE DATABASE PawsitiveWhispers;
USE PawsitiveWhispers;

-- 1. Unified Users Table
CREATE TABLE Users (
    UserID INT PRIMARY KEY AUTO_INCREMENT,
    FullName VARCHAR(255) NOT NULL,
    Email VARCHAR(255) UNIQUE NOT NULL,
    Phone VARCHAR(15),
    Password VARCHAR(255) NOT NULL,
    HomeAddress TEXT,
    CityStateCountry VARCHAR(255),
    Role ENUM('General', 'Volunteer', 'Veterinarian', 'Benefactor') NOT NULL,
    ProfilePicturePath VARCHAR(255),
    SocialMediaLinks TEXT,
    EmailVerified BOOLEAN DEFAULT FALSE
) ENGINE = InnoDB AUTO_INCREMENT = 100000;

-- 2. Role-Specific Details
CREATE TABLE VolunteerDetails (
    UserID INT PRIMARY KEY,
    LocationEnabled BOOLEAN DEFAULT FALSE,
    EmergencyRescue BOOLEAN DEFAULT FALSE,
    OrganizeCampaigns BOOLEAN DEFAULT FALSE,
    ManageAdoption BOOLEAN DEFAULT FALSE,
    Skills TEXT,
    ExperienceYears INT CHECK (ExperienceYears >= 0),
    Availability ENUM('Weekends', 'Weekdays', 'Morning', 'Afternoon', 'Evening', 'Anytime') DEFAULT 'Anytime',
    FOREIGN KEY (UserID) REFERENCES Users(UserID) ON DELETE CASCADE
);

CREATE TABLE VeterinarianDetails (
    UserID INT PRIMARY KEY,
    ClinicName VARCHAR(100),
    ClinicAddress TEXT,
    LocationEnabled BOOLEAN DEFAULT TRUE,
    License BIGINT NOT NULL,
    Speciality VARCHAR(50),
    Services TEXT,
    WorkingHours VARCHAR(50),
    VetLicensePath VARCHAR(255),
    GovIDPath VARCHAR(255),
    HostTraining ENUM('Yes', 'No') DEFAULT 'No',
    TrainingMaterialsPath VARCHAR(255),
    FOREIGN KEY (UserID) REFERENCES Users(UserID) ON DELETE CASCADE
);

CREATE TABLE BenefactorDetails (
    UserID INT PRIMARY KEY,
    OrganizationType ENUM('IndividualDonor', 'CorporateSponsor', 'NgoPartner') DEFAULT 'IndividualDonor',
    DonationType ENUM('One-time', 'Monthly'),
    PreferredCampaign VARCHAR(100),
    Availability VARCHAR(100),
    PaymentMethod ENUM('Credit-Card', 'Paypal', 'Other'),
    SavePayment ENUM('Yes', 'No') DEFAULT 'No',
    SponsorEvents ENUM('Yes', 'No') DEFAULT 'No',
    NgoPartnership ENUM('Yes', 'No') DEFAULT 'No',
    AdditionalNotes TEXT,
    FOREIGN KEY (UserID) REFERENCES Users(UserID) ON DELETE CASCADE
);

-- 3. General User Preferences
CREATE TABLE GeneralUserPreferences (
    UserID INT PRIMARY KEY,
    LocationEnabled BOOLEAN DEFAULT FALSE,
    AdoptionNotifications BOOLEAN DEFAULT FALSE,
    DonationCampaignNotifications BOOLEAN DEFAULT FALSE,
    NewsletterSubscription BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (UserID) REFERENCES Users(UserID) ON DELETE CASCADE
);

-- 4. Shelter Table
CREATE TABLE Shelter (
    ShelterID INT PRIMARY KEY AUTO_INCREMENT,
    ShelterName VARCHAR(255) NOT NULL,
    Address TEXT NOT NULL,
    CityStateCountry VARCHAR(255),
    ContactNumber VARCHAR(20),
    Email VARCHAR(255) UNIQUE NOT NULL,
    ShelterType ENUM('Private', 'Government', 'NGO') DEFAULT 'NGO'
);

-- 5. Animals Table
CREATE TABLE Animals (
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
    PicturePath VARCHAR(255),
    FOREIGN KEY (ShelterID) REFERENCES Shelter(ShelterID) ON DELETE SET NULL
);

-- 6. Rescue Missions
CREATE TABLE RescueMissions (
    MissionID INT PRIMARY KEY AUTO_INCREMENT,
    MissionName VARCHAR(100) NOT NULL,
    Description TEXT,
    ReportedBy INT NOT NULL,
    AssignedVolunteer INT,
    AssignedVet INT,
    Location TEXT NOT NULL,
    Status ENUM('Pending', 'In Progress', 'Completed', 'Cancelled', 'Resolved') DEFAULT 'Pending',
    PriorityLevel ENUM('Low', 'Medium', 'High') DEFAULT 'Medium',
    RegisteredDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ReportedBy) REFERENCES Users(UserID),
    FOREIGN KEY (AssignedVolunteer) REFERENCES Users(UserID),
    FOREIGN KEY (AssignedVet) REFERENCES Users(UserID)
);

-- 7. Medical Records
CREATE TABLE MedicalRecords (
    RecordID INT PRIMARY KEY AUTO_INCREMENT,
    AnimalID INT NOT NULL,
    TreatedBy INT NOT NULL,
    Diagnosis TEXT,
    Treatment TEXT,
    TreatmentDate DATE,
    Notes TEXT,
    FOREIGN KEY (AnimalID) REFERENCES Animals(AnimalID) ON DELETE CASCADE,
    FOREIGN KEY (TreatedBy) REFERENCES Users(UserID) ON DELETE CASCADE
);

-- 8. Adoption Applications
CREATE TABLE AdoptionApplications (
    ApplicationID INT PRIMARY KEY AUTO_INCREMENT,
    AnimalID INT NOT NULL,
    ApplicantID INT NOT NULL,
    HomeDetails TEXT,
    FamilyDetails TEXT,
    ApplicationStatus ENUM('Pending', 'Approved', 'Rejected') DEFAULT 'Pending',
    AssignedVolunteer INT NULL,
    ApplicationDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    Notes TEXT,
    FOREIGN KEY (AnimalID) REFERENCES Animals(AnimalID),
    FOREIGN KEY (ApplicantID) REFERENCES Users(UserID),
    FOREIGN KEY (AssignedVolunteer) REFERENCES Users(UserID)
);

-- 9. Campaigns
CREATE TABLE Campaigns (
    CampaignID INT PRIMARY KEY AUTO_INCREMENT,
    CampaignName VARCHAR(100) NOT NULL,
    Description TEXT,
    StartDate DATE NOT NULL,
    EndDate DATE,
    GoalAmount DECIMAL(10, 2),
    RaisedAmount DECIMAL(10, 2) DEFAULT 0.00,
    CreatedBy INT NOT NULL,
    FOREIGN KEY (CreatedBy) REFERENCES Users(UserID) ON DELETE CASCADE
);

-- 10. Donations
CREATE TABLE Donations (
    DonationID INT PRIMARY KEY AUTO_INCREMENT,
    DonorID INT NOT NULL,
    CampaignID INT,
    AnimalID INT,
    DonationAmount DECIMAL(10, 2) NOT NULL,
    DonationDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (DonorID) REFERENCES Users(UserID) ON DELETE CASCADE,
    FOREIGN KEY (CampaignID) REFERENCES Campaigns(CampaignID) ON DELETE SET NULL,
    FOREIGN KEY (AnimalID) REFERENCES Animals(AnimalID) ON DELETE SET NULL
);

ALTER TABLE Donations
ADD COLUMN Purpose VARCHAR(255) NULL;
ALTER TABLE Donations 
MODIFY COLUMN Purpose ENUM('Animal Food', 'Medicine', 'Clothing', 'Transport', 'Shelter Support', 'General Care');

-- 11. Fund Usage Tracking
CREATE TABLE FundUsage (
    UsageID INT PRIMARY KEY AUTO_INCREMENT,
    DonationID INT,
    UsedBy INT,
    Purpose TEXT,
    AmountUsed DECIMAL(10, 2),
    DateUsed DATE,
    Notes TEXT,
    FOREIGN KEY (DonationID) REFERENCES Donations(DonationID),
    FOREIGN KEY (UsedBy) REFERENCES Users(UserID)
);

-- 12. Educational Content
CREATE TABLE EducationalContent (
    ContentID INT PRIMARY KEY AUTO_INCREMENT,
    UploadedBy INT NOT NULL,
    Title VARCHAR(255) NOT NULL,
    Description TEXT,
    VideoPath VARCHAR(255),
    UploadDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ContentType ENUM('VetTraining', 'VolunteerStory'),
    FOREIGN KEY (UploadedBy) REFERENCES Users(UserID) ON DELETE CASCADE
);

CREATE TABLE ContentLikes (
    LikeID INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT,
    ContentID INT,
    FOREIGN KEY (UserID) REFERENCES Users(UserID),
    FOREIGN KEY (ContentID) REFERENCES EducationalContent(ContentID)
);

CREATE TABLE ContentComments (
    CommentID INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT,
    ContentID INT,
    Comment TEXT,
    CommentDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (UserID) REFERENCES Users(UserID),
    FOREIGN KEY (ContentID) REFERENCES EducationalContent(ContentID)
);