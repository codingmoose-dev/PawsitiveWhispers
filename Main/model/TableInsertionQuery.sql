-- Insert General Users
INSERT INTO Users (UserID, FullName, Email, Phone, Password, HomeAddress, CityStateCountry, Role, ProfilePicturePath, SocialMediaLinks, EmailVerified)
VALUES
(100000, 'Rina Chatterjee', 'rina@gmail.com', '01712345678', 'password123', '123 Dhanmondi, Dhaka', 'Dhaka, Bangladesh', 'General', 'profile1.jpg', 'fb.com/rina', TRUE),
(100001, 'Sourav Roy', 'sourav@outlook.com', '01898765432', 'password456', '456 Gulshan, Dhaka', 'Dhaka, Bangladesh', 'General', 'profile2.jpg', 'twitter.com/sourav', FALSE),
(100002, 'Priya Das', 'priya@yahoo.com', '01987654321', 'password789', '789 Banani, Dhaka', 'Dhaka, Bangladesh', 'General', 'profile3.jpg', 'instagram.com/priya', TRUE),
(100003, 'Tanveer Ahmed', 'tanveer@google.com', '01799887766', 'password000', '321 Uttara, Dhaka', 'Dhaka, Bangladesh', 'General', 'profile4.jpg', 'linkedin.com/tanveer', TRUE),
(100004, 'Jhuma Saha', 'jhuma@gmail.com', '01633445566', 'password1234', '22 Old Dhaka', 'Dhaka, Bangladesh', 'General', 'profile5.jpg', 'fb.com/jhuma', FALSE),
(100005, 'Abhijit Ghosh', 'abhijit@outlook.com', '01765432100', 'password5678', '55 Badda, Dhaka', 'Dhaka, Bangladesh', 'General', 'profile6.jpg', 'twitter.com/abhijit', TRUE),
(100006, 'Farhana Islam', 'farhana@yahoo.com', '01812345678', 'password4321', '10 Mirpur, Dhaka', 'Dhaka, Bangladesh', 'General', 'profile7.jpg', 'instagram.com/farhana', TRUE),
(100007, 'Kamal Hossain', 'kamal@google.com', '01911223344', 'password8765', '300 Baridhara, Dhaka', 'Dhaka, Bangladesh', 'General', 'profile8.jpg', 'linkedin.com/kamal', TRUE);

-- Insert GeneralUserPreferences
INSERT INTO GeneralUserPreferences (UserID, LocationEnabled, AdoptionNotifications, DonationCampaignNotifications, NewsletterSubscription)
VALUES
(100000, TRUE, TRUE, TRUE, TRUE),
(100001, FALSE, FALSE, TRUE, TRUE),
(100002, TRUE, TRUE, FALSE, TRUE),
(100003, TRUE, TRUE, TRUE, FALSE),
(100004, TRUE, FALSE, FALSE, TRUE),
(100005, TRUE, TRUE, TRUE, TRUE),
(100006, FALSE, TRUE, TRUE, FALSE),
(100007, TRUE, TRUE, FALSE, TRUE);

-- Insert Volunteers
INSERT INTO Users (UserID, FullName, Email, Phone, Password, HomeAddress, CityStateCountry, Role, ProfilePicturePath, SocialMediaLinks, EmailVerified)
VALUES
(110000, 'Shirin Akter', 'shirin@gmail.com', '01788990000', 'volunteer123', '88 Motijheel, Dhaka', 'Dhaka, Bangladesh', 'Volunteer', NULL, NULL, NULL),
(110001, 'Jamilur Rahman', 'jamilur@outlook.com', '01990001122', 'volunteer456', '120 Puran Dhaka', 'Dhaka, Bangladesh', 'Volunteer', NULL, NULL, NULL),
(110002, 'Rashedul Islam', 'rashedul@yahoo.com', '01866778899', 'volunteer789', '200 New Market, Dhaka', 'Dhaka, Bangladesh', 'Volunteer', NULL, NULL, NULL),
(110003, 'Meherun Nahar', 'meherun@google.com', '01722334455', 'volunteer000', '35 Sadarghat, Dhaka', 'Dhaka, Bangladesh', 'Volunteer', NULL, NULL, NULL),
(110004, 'Abdul Mannan', 'abdul@outlook.com', '01988553322', 'volunteer1234', '74 Mirpur, Dhaka', 'Dhaka, Bangladesh', 'Volunteer', NULL, NULL, NULL),
(110005, 'Sabrina Sultana', 'sabrina@yahoo.com', '01854556677', 'volunteer5678', '55 Kolabagan, Dhaka', 'Dhaka, Bangladesh', 'Volunteer', NULL, NULL, NULL),
(110006, 'Sajib Ahmed', 'sajib@google.com', '01733445566', 'volunteer4321', '120 Badda, Dhaka', 'Dhaka, Bangladesh', 'Volunteer', NULL, NULL, NULL),
(110007, 'Nazrul Islam', 'nazrul@outlook.com', '01922334455', 'volunteer8765', '88 Hazaribagh, Dhaka', 'Dhaka, Bangladesh', 'Volunteer', NULL, NULL, NULL);

-- Insert VolunteerDetails
INSERT INTO VolunteerDetails (UserID, LocationEnabled, EmergencyRescue, OrganizeCampaigns, ManageAdoption, Skills, ExperienceYears, Availability)
VALUES
(110000, TRUE, TRUE, TRUE, FALSE, 'Animal Care, Event Management', 5, 'Weekends'),
(110001, TRUE, TRUE, FALSE, TRUE, 'Campaign Management, Fundraising', 2, 'Weekdays'),
(110002, FALSE, FALSE, TRUE, TRUE, 'Animal Rescue, Outreach', 3, 'Evening'),
(110003, TRUE, TRUE, TRUE, FALSE, 'Education, Community Outreach', 7, 'Anytime'),
(110004, TRUE, TRUE, FALSE, TRUE, 'Fundraising, Event Planning', 4, 'Morning'),
(110005, FALSE, TRUE, TRUE, FALSE, 'Animal Welfare, Volunteering', 6, 'Afternoon'),
(110006, TRUE, TRUE, TRUE, TRUE, 'Project Management, Animal Rescue', 2, 'Weekdays'),
(110007, TRUE, FALSE, TRUE, TRUE, 'Fundraising, Public Relations', 1, 'Weekends');

-- Insert Veterinarians
INSERT INTO Users (UserID, FullName, Email, Phone, Password, HomeAddress, CityStateCountry, Role, ProfilePicturePath, SocialMediaLinks, EmailVerified)
VALUES
(120000, 'Dr. Nilufa Yasmin', 'nilufa@vet.com', '01711111111', 'vetpass1', 'House 1, Mymensingh', 'Mymensingh, Bangladesh', 'Veterinarian', NULL, NULL, NULL),
(120001, 'Dr. Reza Karim', 'reza@vet.com', '01712222222', 'vetpass2', 'House 2, Khulna', 'Khulna, Bangladesh', 'Veterinarian', NULL, NULL, NULL),
(120002, 'Dr. Anika Rahman', 'anika@vet.com', '01713333333', 'vetpass3', 'House 3, Rajshahi', 'Rajshahi, Bangladesh', 'Veterinarian', NULL, NULL, NULL),
(120003, 'Dr. Tanvir Hassan', 'tanvir@vet.com', '01714444444', 'vetpass4', 'House 4, Chattogram', 'Chattogram, Bangladesh', 'Veterinarian', NULL, NULL, NULL),
(120004, 'Dr. Jahanara Begum', 'jahanara@vet.com', '01715555555', 'vetpass5', 'House 5, Barisal', 'Barisal, Bangladesh', 'Veterinarian', NULL, NULL, NULL),
(120005, 'Dr. Emran Hossain', 'emran@vet.com', '01716666666', 'vetpass6', 'House 6, Sylhet', 'Sylhet, Bangladesh', 'Veterinarian', NULL, NULL, NULL),
(120006, 'Dr. Fahima Khatun', 'fahima@vet.com', '01717777777', 'vetpass7', 'House 7, Comilla', 'Comilla, Bangladesh', 'Veterinarian', NULL, NULL, NULL),
(120007, 'Dr. Mahmud Sadi', 'mahmud@vet.com', '01718888888', 'vetpass8', 'House 8, Narayanganj', 'Narayanganj, Bangladesh', 'Veterinarian', NULL, NULL, NULL),
(120008, 'Dr. Suraiya Islam', 'suraiya@vet.com', '01719999999', 'vetpass9', 'House 9, Gazipur', 'Gazipur, Bangladesh', 'Veterinarian', NULL, NULL, NULL),
(120009, 'Dr. Omar Faruq', 'omar@vet.com', '01710000000', 'vetpass10', 'House 10, Rangpur', 'Rangpur, Bangladesh', 'Veterinarian', NULL, NULL, NULL);

-- Insert VeterinarianDetails
INSERT INTO VeterinarianDetails (UserID, ClinicName, ClinicAddress, LocationEnabled, License, Speciality, Services, WorkingHours, VetLicensePath, GovIDPath, HostTraining, TrainingMaterialsPath)
VALUES
(120000, 'PawsCare', '123 Mymensingh Road', TRUE, 1234567890, 'Surgery', 'Vaccination, Neutering', '9AM-5PM', 'docs/vet1_license.pdf', 'docs/vet1_id.pdf', 'Yes', 'docs/training1.pdf'),
(120001, 'Khulna Vet Center', '45 Khulna Lane', TRUE, 1234567891, 'Dermatology', 'Skin Treatment, Grooming', '10AM-6PM', 'docs/vet2_license.pdf', 'docs/vet2_id.pdf', 'No', NULL),
(120002, 'PetWell Rajshahi', '78 Rajshahi Avenue', TRUE, 1234567892, 'General Health', 'Consultation, Medicine', '8AM-4PM', 'docs/vet3_license.pdf', 'docs/vet3_id.pdf', 'Yes', 'docs/training3.pdf'),
(120003, 'Chattogram Pet Aid', '56 Port Road', TRUE, 1234567893, 'Orthopedics', 'Fractures, Surgery', '9AM-5PM', 'docs/vet4_license.pdf', 'docs/vet4_id.pdf', 'Yes', 'docs/training4.pdf'),
(120004, 'Barisal Pet Clinic', '33 River View', TRUE, 1234567894, 'Dentistry', 'Tooth Cleaning, Surgery', '10AM-4PM', 'docs/vet5_license.pdf', 'docs/vet5_id.pdf', 'No', NULL),
(120005, 'Sylhet Vet Center', 'Sylhet Main Road', TRUE, 1234567895, 'Nutrition', 'Diet Plans, Checkups', '8AM-2PM', 'docs/vet6_license.pdf', 'docs/vet6_id.pdf', 'Yes', 'docs/training6.pdf'),
(120006, 'Comilla Pet Medics', '22 Comilla Circle', TRUE, 1234567896, 'General', 'Basic Treatment', '11AM-7PM', 'docs/vet7_license.pdf', 'docs/vet7_id.pdf', 'No', NULL),
(120007, 'Narayanganj Pet House', '100 N Tower', TRUE, 1234567897, 'Neurology', 'Seizures, Nerve Treatment', '10AM-5PM', 'docs/vet8_license.pdf', 'docs/vet8_id.pdf', 'Yes', 'docs/training8.pdf'),
(120008, 'Gazipur Vet Lab', 'Gazipur City Center', TRUE, 1234567898, 'Lab Testing', 'Diagnostics', '9AM-3PM', 'docs/vet9_license.pdf', 'docs/vet9_id.pdf', 'No', NULL),
(120009, 'Rangpur Pet Doctors', 'North Town, Rangpur', TRUE, 1234567899, 'Emergency', 'ICU, Trauma', '24/7', 'docs/vet10_license.pdf', 'docs/vet10_id.pdf', 'Yes', 'docs/training10.pdf');

-- Insert Benefactors
INSERT INTO Users (UserID, FullName, Email, Phone, Password, HomeAddress, CityStateCountry, Role, ProfilePicturePath, SocialMediaLinks, EmailVerified)
VALUES
(130000, 'Ali Rahman', 'ali@donor.com', '01810000001', 'donorpass1', '1, Banani', 'Dhaka, Bangladesh', 'Benefactor', NULL, NULL, NULL),
(130001, 'Nusrat Jahan', 'nusrat@donor.com', '01810000002', 'donorpass2', '2, Gulshan', 'Dhaka, Bangladesh', 'Benefactor', NULL, NULL, NULL),
(130002, 'Md. Hasan', 'hasan@ngo.com', '01810000003', 'donorpass3', '3, Uttara', 'Dhaka, Bangladesh', 'Benefactor', NULL, NULL, NULL),
(130003, 'Farzana Akter', 'farzana@corp.com', '01810000004', 'donorpass4', '4, Dhanmondi', 'Dhaka, Bangladesh', 'Benefactor', NULL, NULL, NULL),
(130004, 'Rafiul Islam', 'rafiul@donor.com', '01810000005', 'donorpass5', '5, Tejgaon', 'Dhaka, Bangladesh', 'Benefactor', NULL, NULL, NULL),
(130005, 'Tanzina Begum', 'tanzina@donor.com', '01810000006', 'donorpass6', '6, Mirpur', 'Dhaka, Bangladesh', 'Benefactor', NULL, NULL, NULL),
(130006, 'Zia Uddin', 'zia@corp.com', '01810000007', 'donorpass7', '7, Shyamoli', 'Dhaka, Bangladesh', 'Benefactor', NULL, NULL, NULL),
(130007, 'Marzan Karim', 'marzan@ngo.com', '01810000008', 'donorpass8', '8, Azimpur', 'Dhaka, Bangladesh', 'Benefactor', NULL, NULL, NULL),
(130008, 'Fatema Sultana', 'fatema@ngo.com', '01810000009', 'donorpass9', '9, Banasree', 'Dhaka, Bangladesh', 'Benefactor', NULL, NULL, NULL),
(130009, 'Ayman Chowdhury', 'ayman@donor.com', '01810000010', 'donorpass10', '10, Mohammadpur', 'Dhaka, Bangladesh', 'Benefactor', NULL, NULL, NULL);

-- Insert BenefactorDetails
INSERT INTO BenefactorDetails (UserID, OrganizationType, DonationType, PreferredCampaign, Availability, PaymentMethod, SavePayment, SponsorEvents, NgoPartnership, AdditionalNotes)
VALUES
(130000, 'IndividualDonor', 'Monthly', 'Street Animal Feed', 'Weekends', 'Paypal', 'Yes', 'Yes', 'No', 'Helps monthly'),
(130001, 'IndividualDonor', 'One-time', 'Medical Aid', 'Weekdays', 'Credit-Card', 'No', 'No', 'No', 'One-time gift'),
(130002, 'NgoPartner', 'Monthly', 'Adoption Drives', 'Anytime', 'Other', 'Yes', 'Yes', 'Yes', 'NGO tie-up'),
(130003, 'CorporateSponsor', 'One-time', 'Shelter Support', 'Weekdays', 'Paypal', 'Yes', 'Yes', 'No', 'Corporate CSR'),
(130004, 'IndividualDonor', 'Monthly', 'Animal Rescue', 'Weekends', 'Credit-Card', 'No', 'Yes', 'No', 'Active contributor'),
(130005, 'NgoPartner', 'Monthly', 'Awareness', 'Anytime', 'Paypal', 'Yes', 'Yes', 'Yes', 'Collaborates closely'),
(130006, 'CorporateSponsor', 'One-time', 'Animal Health', 'Morning', 'Other', 'No', 'No', 'No', 'One-time CSR'),
(130007, 'NgoPartner', 'Monthly', 'Volunteer Training', 'Evening', 'Paypal', 'Yes', 'Yes', 'Yes', 'Supports logistics'),
(130008, 'IndividualDonor', 'One-time', 'Vet Support', 'Anytime', 'Credit-Card', 'No', 'No', 'No', 'Occasional donor'),
(130009, 'CorporateSponsor', 'Monthly', 'All Campaigns', 'Weekdays', 'Other', 'Yes', 'Yes', 'Yes', 'Major donor');

-- Shelter Table Data
INSERT INTO Shelter (ShelterName, Address, CityStateCountry, ContactNumber, Email, ShelterType)
VALUES
('Hope Shelter', '12A, Banani', 'Dhaka, Bangladesh', '01711122233', 'hope@paws.org', 'NGO'),
('Safe Haven', '54, Chittagong Road', 'Chattogram, Bangladesh', '01844455566', 'safe@paws.org', 'Private'),
('Pet Rescue Center', '21 Jessore Road', 'Khulna, Bangladesh', '01999988877', 'rescue@paws.org', 'Government'),
('Animal Love Shelter', '9, Rangpur Bypass', 'Rangpur, Bangladesh', '01799922211', 'love@paws.org', 'NGO'),
('Companion Shelter', 'House 22, Rajshahi', 'Rajshahi, Bangladesh', '01811123344', 'companion@paws.org', 'Private'),
('Shelter for Strays', 'Hillview Area', 'Sylhet, Bangladesh', '01933445566', 'strays@paws.org', 'NGO'),
('Happy Tails', 'Zone-5, Barisal City', 'Barisal, Bangladesh', '01766778899', 'happy@paws.org', 'Government'),
('Animal Aid', 'Block C, Narayanganj', 'Narayanganj, Bangladesh', '01899887766', 'aid@paws.org', 'NGO'),
('Paw Palace', 'Sector 10, Gazipur', 'Gazipur, Bangladesh', '01777665544', 'palace@paws.org', 'Private'),
('New Life Shelter', 'Comilla Central Road', 'Comilla, Bangladesh', '01955667788', 'newlife@paws.org', 'NGO');

-- Animals Table Data
INSERT INTO Animals (Name, Species, Breed, Age, Gender, AnimalCondition, RescueDate, AdoptionStatus, ShelterID, PicturePath)
VALUES
('Bruno', 'Dog', 'Labrador', 4, 'Male', 'Healthy', '2025-01-10', 'Available', 1, 'images/animal_images/bruno.jpg'),
('Mimi', 'Cat', 'Persian', 2, 'Female', 'Minor cold', '2025-02-01', 'UnderCare', 2, 'images/animal_images/mimi.jpg'),
('Rex', 'Dog', 'Beagle', 3, 'Male', 'Leg injury', '2025-01-22', 'Adopted', 3, 'images/animal_images/rex.jpg'),
('Sundori', 'Cow', 'Local', 6, 'Female', 'Rescued from abuse', '2025-03-03', 'Available', 4, 'images/animal_images/sundori.jpg'),
('Tiger', 'Dog', 'German Shepherd', 5, 'Male', 'Recovering', '2025-01-30', 'Pending', 5, 'images/animal_images/tiger.jpg'),
('Puchki', 'Cat', 'Bengal', 1, 'Female', 'Eye infection', '2025-02-15', 'Available', 6, 'images/animal_images/puchki.jpg'),
('Tommy', 'Dog', 'Pug', 2, 'Male', 'Severe malnutrition', '2025-03-05', 'Available', 7, 'images/animal_images/tommy.jpg'),
('Laila', 'Goat', 'Black Bengal', 3, 'Female', 'Healthy', '2025-01-18', 'Adopted', 8, 'images/animal_images/laila.jpg'),
('Snowy', 'Dog', 'Husky', 4, 'Male', 'Healthy', '2025-02-20', 'Available', 9, 'images/animal_images/snowy.jpg'),
('Milo', 'Cat', 'Siamese', 2, 'Male', 'Recovering', '2025-03-10', 'Pending', 10, 'images/animal_images/milo.jpg');

-- Rescue Missions Table Data
INSERT INTO RescueMissions (
    MissionName, Description, ReportedBy, AssignedVolunteer, AssignedVet, Location, Status, PriorityLevel, RegisteredDate
)
VALUES
('Injured Street Dog in Mirpur',
 'A limping dog reported near Mirpur 10. Possible fracture.',
 100001, 110000, 120003, 'Mirpur 10, Dhaka', 'In Progress', 'High', '2025-03-01'),
('Stray Cat Stuck on Tree',
 'Local children reported a cat stuck on a tall tree for two days.',
 100003, 110001, 120002, 'Dhanmondi 27, Dhaka', 'Pending', 'Medium', '2025-03-03'),
('Hit-and-Run Victim (Puppy)',
 'Puppy hit by a rickshaw, bleeding and unconscious.',
 100005, 110002, 120000, 'Tejgaon Rail Crossing', 'In Progress', 'High', '2025-03-05'),
('Abandoned Pet at Gulshan Lake Park',
 'Leashed dog found alone for 3 hours near the park bench.',
 100004, 110003, 120002, 'Gulshan Lake Park, Dhaka', 'Resolved', 'Medium', '2025-03-06'),
('Cat with Broken Leg',
 'Shopkeeper reports cat limping with open wound.',
 100002, 110004, 120001, 'Karwan Bazar, Dhaka', 'Completed', 'High', '2025-03-08'),
('Neglected Calf Near Slaughterhouse',
 'Weak and underfed calf left tied outside for days.',
 100006, 110005, 120004, 'Postogola Slaughterhouse, Old Dhaka', 'Pending', 'High', '2025-03-09'),
('Dog Chained to Pole in Rain',
 'Video received of a chained dog left without shelter in storm.',
 100007, 110006, 120005, 'Rampura, Dhaka', 'In Progress', 'High', '2025-03-10'),
('Stray Cat Colony Illness Report',
 '3 cats in a colony showing signs of infection.',
 100000, 110002, 120006, 'Agargaon, Dhaka', 'Pending', 'Medium', '2025-03-12'),
('Sick Puppy in Market',
 'Small puppy vomiting and weak in a roadside vegetable market.',
 100001, 110001, 120007, 'Mohakhali Kitchen Market', 'Completed', 'High', '2025-03-13'),
('Bird Rescue from Drain',
 'Crow fell into drain during rainfall, wing possibly broken.',
 100003, 110000, 120006, 'Shyamoli Bus Stand, Dhaka', 'Cancelled', 'Low', '2025-03-14');

-- Insert into MedicalRecords
INSERT INTO MedicalRecords (AnimalID, TreatedBy, TreatmentDate, Diagnosis, Treatment, Notes)
VALUES
(2, 120001, '2025-01-14', 'Fractured paw', 'Bandage, antibiotics', 'Scheduled follow-up in 2 weeks'),
(5, 120003, '2025-01-23', 'Leg wound', 'Stitches, painkillers', 'Healed well'),
(8, 120002, '2025-02-03', 'Eye infection', 'Eye drops', 'Responding well to medication');

-- Insert into AdoptionApplications
INSERT INTO AdoptionApplications (
    AnimalID, ApplicantID, HomeDetails, FamilyDetails, ApplicationStatus, AssignedVolunteer, ApplicationDate, Notes
)
VALUES
(3, 100002, '2-bedroom flat in Dhanmondi with balcony', 'Lives with spouse and one child, both animal lovers', 'Approved', 110002, '2025-02-20', 'Adopted after full house checkup'),
(7, 100004, 'Large independent house in Gulshan', 'Family of 5, all supportive', 'Approved', 110004, '2025-03-01', 'Beagle adopted by a family in Gulshan'),
(5, 100001, 'Apartment in Bashundhara, has rooftop access', 'Living alone but with prior pet experience', 'Pending', 110000, '2025-03-10', 'Application submitted; awaiting interview'),
(2, 100003, 'Ground floor with garden access in Uttara', 'Lives with spouse and elderly parent', 'Rejected', 110001, '2025-02-25', 'Rejected due to safety concerns in the building'),
(9, 100006, 'Modern apartment in Mirpur DOHS', 'Couple with no children, both work from home', 'Approved', 110005, '2025-03-12', 'Approved after quick home visit'),
(1, 100005, 'Flat near Tejgaon College, moderate ventilation', 'Family of 4, all supportive but long working hours', 'Pending', 110006, '2025-03-14', 'Pending volunteer assignment'),
(6, 100007, 'Corner house in Baridhara with enclosed yard', 'Larger family with a history of pet adoption', 'Approved', 110006, '2025-03-18', 'Excellent environment for animal care'),
(4, 100000, 'Single-bedroom bachelor pad', 'Living alone with long working hours', 'Rejected', 110003, '2025-02-28', 'Rejected: not enough time to care for the pet');

-- Campaigns Table Data
INSERT INTO Campaigns (CampaignName, Description, StartDate, EndDate, GoalAmount, RaisedAmount, CreatedBy)
VALUES
('Feed the Strays', 'Provide food to stray animals across cities.', '2025-01-01', '2025-04-01', 50000.00, 12000.00, 130000),
('Vaccination Drive', 'Free rabies and general vaccination for strays.', '2025-02-01', '2025-05-01', 70000.00, 25000.00, 130001),
('Build New Shelter', 'Create safe spaces in Barisal.', '2025-01-20', '2025-06-30', 150000.00, 90000.00, 130002),
('Rescue Operation Rangpur', 'Rescue and treat injured animals.', '2025-03-01', NULL, 30000.00, 8000.00, 130003),
('Street Awareness', 'Run public awareness campaigns.', '2025-01-15', '2025-03-15', 20000.00, 15000.00, 130004),
('Shelter Upgrades', 'Upgrade vet facilities in existing shelters.', '2025-02-10', '2025-05-10', 40000.00, 10000.00, 130005),
('Volunteer Kit Supplies', 'Provide gear and supplies to volunteers.', '2025-01-25', '2025-04-25', 30000.00, 7000.00, 130006),
('Animal Adoption Fest', 'Organize mass adoption events.', '2025-03-10', '2025-03-20', 10000.00, 5000.00, 130007),
('Street Vet Clinics', 'Mobile vet clinics for rural areas.', '2025-02-05', '2025-06-05', 60000.00, 20000.00, 130008),
('Educational Workshops', 'Teach school kids about animal care.', '2025-01-28', '2025-02-28', 15000.00, 6000.00, 130009);

-- Donations Table Data
INSERT INTO Donations (DonorID, CampaignID, AnimalID, DonationAmount, Purpose)
VALUES
(130000, 1, NULL, 3000.00, 'Animal Food'),       
(130001, 2, NULL, 5000.00, 'Medicine'),           
(130002, 4, NULL, 20000.00, 'Shelter Support'),   
(130003, 4, NULL, 4000.00, 'Transport'),          
(130005, 6, NULL, 3500.00, 'Shelter Support'),    
(130007, 8, NULL, 1800.00, 'General Care'),   
(130008, 5, NULL, 2500.00, 'Medicine'),     
(130009, 10, NULL, 3000.00, 'General Care'),
(130004, 5, 1, 1500.00, 'Animal Food'), 
(130006, 7, 5, 1200.00, 'Medicine'),
(130008, 9, 2, 2500.00, 'General Care');

-- FundUsage Table Data
INSERT INTO FundUsage (DonationID, UsedBy, Purpose, AmountUsed, DateUsed, Notes)
VALUES
(1, 110000, 'Bought 50kg of dog food', 2000.00, '2025-01-05', 'Distributed in Banani'),
(2, 110001, 'Rabies vaccines', 4500.00, '2025-02-10', 'Used in Chattogram'),
(3, 110002, 'Shelter construction material', 15000.00, '2025-02-20', 'Bricks, Cement'),
(4, 110003, 'Animal transport van rental', 2500.00, '2025-03-02', 'Rescue mission Rangpur'),
(5, 110004, 'Street posters and flyers', 1000.00, '2025-01-20', 'Awareness phase 1'),
(6, 110005, 'New stethoscope', 1500.00, '2025-02-15', 'Used by vet in Sylhet'),
(7, 110006, 'Volunteer gloves and kits', 1000.00, '2025-03-01', 'Shipped to Mirpur'),
(8, 110007, 'Event booth setup', 1200.00, '2025-03-10', 'Adoption fest in Dhanmondi'),
(9, 110001, 'Vet medicines for Mimi', 2000.00, '2025-02-25', 'Used for cat care'),
(10, 110002, 'Printed books for school kids', 1500.00, '2025-01-30', 'Delivered in Gazipur');

-- Insert into EducationalContent
INSERT INTO EducationalContent (UploadedBy, Title, Description, VideoPath, UploadDate, ContentType)
VALUES
(120000, 'How to Bandage a Pet', 'Basic first aid for animals', 'videos/bandage_tutorial.mp4', '2025-01-15', 'VetTraining'),
(120002, 'Vaccination Process for Cats', 'Vaccination steps explained by vet', 'videos/cat_vaccination.mp4', '2025-02-01', 'VetTraining'),
(110001, 'Rescue Story of Mittens', 'Journey of a rescued Persian cat', 'videos/mittens_story.mp4', '2025-02-05', 'VolunteerStory'),
(110004, 'Feeding Street Animals', 'Tips on feeding and care', 'videos/feeding_streets.mp4', '2025-02-10', 'VolunteerStory');

-- Insert into ContentComments
INSERT INTO ContentComments (ContentID, UserID, Comment, CommentDate)
VALUES
(1, 100001, 'This was really helpful, thank you!', '2025-01-16'),
(3, 100004, 'Mittens is so brave. Great work!', '2025-02-06'),
(2, 100003, 'I followed this and vaccinated my cat.', '2025-02-02'),
(4, 100005, 'Very inspiring, I want to help more.', '2025-02-11');

-- Insert into ContentLikes
INSERT INTO ContentLikes (ContentID, UserID)
VALUES
(1, 100001),
(2, 100002),
(3, 100004),
(4, 100006);