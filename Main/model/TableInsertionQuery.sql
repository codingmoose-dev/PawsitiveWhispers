INSERT INTO GeneralUsers (FullName, Email, Phone, Password, Address, CityStateCountry, LocationEnabled, AdoptionNotifications, DonationCampaignNotifications, NewsletterSubscription, ProfilePicturePath, SocialMediaLinks, EmailVerified)
VALUES
('Rina Chatterjee', 'rina@gmail.com', '01712345678', 'password123', '123 Dhanmondi, Dhaka', 'Dhaka, Bangladesh', TRUE, TRUE, TRUE, TRUE, 'profile1.jpg', 'fb.com/rina', TRUE),
('Sourav Roy', 'sourav@outlook.com', '01898765432', 'password456', '456 Gulshan, Dhaka', 'Dhaka, Bangladesh', FALSE, FALSE, TRUE, TRUE, 'profile2.jpg', 'twitter.com/sourav', FALSE),
('Priya Das', 'priya@yahoo.com', '01987654321', 'password789', '789 Banani, Dhaka', 'Dhaka, Bangladesh', TRUE, TRUE, FALSE, TRUE, 'profile3.jpg', 'instagram.com/priya', TRUE),
('Tanveer Ahmed', 'tanveer@google.com', '01799887766', 'password000', '321 Uttara, Dhaka', 'Dhaka, Bangladesh', TRUE, TRUE, TRUE, FALSE, 'profile4.jpg', 'linkedin.com/tanveer', TRUE),
('Jhuma Saha', 'jhuma@gmail.com', '01633445566', 'password1234', '22 Old Dhaka', 'Dhaka, Bangladesh', TRUE, FALSE, FALSE, TRUE, 'profile5.jpg', 'fb.com/jhuma', FALSE),
('Abhijit Ghosh', 'abhijit@outlook.com', '01765432100', 'password5678', '55 Badda, Dhaka', 'Dhaka, Bangladesh', TRUE, TRUE, TRUE, TRUE, 'profile6.jpg', 'twitter.com/abhijit', TRUE),
('Farhana Islam', 'farhana@yahoo.com', '01812345678', 'password4321', '10 Mirpur, Dhaka', 'Dhaka, Bangladesh', FALSE, TRUE, TRUE, FALSE, 'profile7.jpg', 'instagram.com/farhana', TRUE),
('Kamal Hossain', 'kamal@google.com', '01911223344', 'password8765', '300 Baridhara, Dhaka', 'Dhaka, Bangladesh', TRUE, TRUE, FALSE, TRUE, 'profile8.jpg', 'linkedin.com/kamal', TRUE);

INSERT INTO Volunteers (FullName, Email, Phone, Password, HomeAddress, CityStateCountry, LocationEnabled, EmergencyRescue, OrganizeCampaigns, ManageAdoption, Skills, ExperienceYears, Availability)
VALUES
('Shirin Akter', 'shirin@gmail.com', '01788990000', 'volunteer123', '88 Motijheel, Dhaka', 'Dhaka, Bangladesh', TRUE, TRUE, TRUE, FALSE, 'Animal Care, Event Management', 5, 'Weekends'),
('Jamilur Rahman', 'jamilur@outlook.com', '01990001122', 'volunteer456', '120 Puran Dhaka', 'Dhaka, Bangladesh', TRUE, TRUE, FALSE, TRUE, 'Campaign Management, Fundraising', 2, 'Weekdays'),
('Rashedul Islam', 'rashedul@yahoo.com', '01866778899', 'volunteer789', '200 New Market, Dhaka', 'Dhaka, Bangladesh', FALSE, FALSE, TRUE, TRUE, 'Animal Rescue, Outreach', 3, 'Evening'),
('Meherun Nahar', 'meherun@google.com', '01722334455', 'volunteer000', '35 Sadarghat, Dhaka', 'Dhaka, Bangladesh', TRUE, TRUE, TRUE, FALSE, 'Education, Community Outreach', 7, 'Anytime'),
('Abdul Mannan', 'abdul@outlook.com', '01988553322', 'volunteer1234', '74 Mirpur, Dhaka', 'Dhaka, Bangladesh', TRUE, TRUE, FALSE, TRUE, 'Fundraising, Event Planning', 4, 'Morning'),
('Sabrina Sultana', 'sabrina@yahoo.com', '01854556677', 'volunteer5678', '55 Kolabagan, Dhaka', 'Dhaka, Bangladesh', FALSE, TRUE, TRUE, FALSE, 'Animal Welfare, Volunteering', 6, 'Afternoon'),
('Sajib Ahmed', 'sajib@google.com', '01733445566', 'volunteer4321', '120 Badda, Dhaka', 'Dhaka, Bangladesh', TRUE, TRUE, TRUE, TRUE, 'Project Management, Animal Rescue', 2, 'Weekdays'),
('Nazrul Islam', 'nazrul@outlook.com', '01922334455', 'volunteer8765', '88 Hazaribagh, Dhaka', 'Dhaka, Bangladesh', TRUE, FALSE, TRUE, TRUE, 'Fundraising, Public Relations', 1, 'Weekends');

INSERT INTO Veterinarians (FullName, Email, Phone, Password, ClinicAddress, LocationEnabled, License, ClinicName, Speciality, Services, WorkingHours, VetLicensePath, GovIDPath, TrainingMaterialsPath, HostTraining)
VALUES
('Dr. Anwar Hossain', 'anwarvet@gmail.com', '01735698765', 'vet123', '100 Shantinagar, Dhaka', TRUE, 3456789123, 'Shanti Vet Clinic', 'General Medicine', 'Consultation, Surgery', '9AM - 5PM', 'anwar_license.jpg', 'anwar_id.jpg', 'anwar_training.jpg', 'yes'),
('Dr. Rina Islam', 'rina.vet@outlook.com', '01855667788', 'vet456', '150 Dhanmondi, Dhaka', TRUE, 2345678912, 'Dhanmondi Animal Care', 'Dermatology', 'Vaccination, Treatment', '9AM - 6PM', 'rina_license.jpg', 'rina_id.jpg', 'rina_training.jpg', 'no'),
('Dr. Saiful Islam', 'saifulvet@yahoo.com', '01722334455', 'vet789', '88 Mirpur, Dhaka', TRUE, 5678912345, 'Mirpur Animal Hospital', 'Orthopedics', 'X-ray, Surgery', '8AM - 4PM', 'saiful_license.jpg', 'saiful_id.jpg', 'saiful_training.jpg', 'yes'),
('Dr. Zubaida Begum', 'zubaidavet@google.com', '01833445566', 'vet000', '35 Gulshan, Dhaka', TRUE, 4567890123, 'Gulshan Pet Clinic', 'Cardiology', 'Heart Checkups, ECG', '10AM - 5PM', 'zubaida_license.jpg', 'zubaida_id.jpg', 'zubaida_training.jpg', 'no'),
('Dr. Mahbubur Rahman', 'mahbubvet@outlook.com', '01766778899', 'vet1234', '45 Uttara, Dhaka', TRUE, 6789012345, 'Uttara Pet Care', 'Neurology', 'MRI, Treatment', '9AM - 7PM', 'mahbub_license.jpg', 'mahbub_id.jpg', 'mahbub_training.jpg', 'yes'),
('Dr. Parveen Begum', 'parveenvet@yahoo.com', '01955667788', 'vet5678', '23 Banani, Dhaka', TRUE, 7890123456, 'Banani Vet Clinic', 'Surgery', 'Neutering, Spaying', '8AM - 6PM', 'parveen_license.jpg', 'parveen_id.jpg', 'parveen_training.jpg', 'yes'),
('Dr. Noor Islam', 'noorvet@google.com', '01711223344', 'vet4321', '88 Baridhara, Dhaka', TRUE, 9012345678, 'Baridhara Animal Clinic', 'Dentistry', 'Teeth Cleaning, Extraction', '10AM - 4PM', 'noor_license.jpg', 'noor_id.jpg', 'noor_training.jpg', 'no'),
('Dr. Fahim Ahmed', 'fahimvet@outlook.com', '01866554433', 'vet8765', '75 Old Dhaka', TRUE, 1234567890, 'Old Dhaka Pet Clinic', 'Gastroenterology', 'Digestion, Gastro Issues', '9AM - 6PM', 'fahim_license.jpg', 'fahim_id.jpg', 'fahim_training.jpg', 'yes');

INSERT INTO Benefactors (FullName, Email, Phone, Password, Address, OrganizationType, DonationType, PreferredCampaign, Availability, PaymentMethod, SavePayment, SponsorEvents, NgoPartnership, AdditionalNotes)
VALUES
('Shafiqul Alam', 'shafiq@gmail.com', '01987456321', 'password123', '20 Gulsan, Dhaka', 'IndividualDonor', 'One-time', 'Animal Welfare', 'Weekends', 'credit-card', 'yes', 'yes', 'no', 'Donor for animal treatment'),
('Aminul Haque', 'aminul@outlook.com', '01755667788', 'securePass456', '45 Shyamoli, Dhaka', 'CorporateSponsor', 'Monthly', 'Pet Shelter', 'Weekdays', 'paypal', 'no', 'yes', 'yes', 'Sponsor for food and supplies'),
('Tariq Zaman', 'tariq@yahoo.com', '01922334455', 'Zaman789!', '10 Banani, Dhaka', 'NGOPartner', 'Quarterly', 'Medical Supplies', 'Weekdays', 'bank-transfer', 'yes', 'yes', 'no', 'Partners with clinics'),
('Sadia Ahmed', 'sadia@google.com', '01755667799', 'Ahmed@567', '30 Mirpur, Dhaka', 'IndividualDonor', 'Recurring', 'Rescue Operations', 'Weekends', 'debit-card', 'yes', 'no', 'yes', 'Supports in emergency rescues'),
('Kazi Shahed', 'shahed@outlook.com', '01998887766', 'Shahed!123', '100 Uttara, Dhaka', 'CorporateSponsor', 'One-time', 'Education', 'Weekdays', 'credit-card', 'no', 'yes', 'no', 'Donor for awareness programs'),
('Nadia Akter', 'nadia@yahoo.com', '01822334455', 'Akter#2023', '150 New Market, Dhaka', 'IndividualDonor', 'Monthly', 'Adoption Drives', 'Weekends', 'paypal', 'yes', 'no', 'yes', 'Supports in adoption events'),
('Imran Chowdhury', 'imran@google.com', '01744556677', 'ImranPass!45', '60 Old Dhaka', 'CorporateSponsor', 'Quarterly', 'Animal Rescue', 'Weekdays', 'bank-transfer', 'no', 'yes', 'yes', 'Provides resources for rescues'),
('Fariha Nahar', 'fariha@outlook.com', '01966554433', 'Fariha#78', '200 Badda, Dhaka', 'NGOPartner', 'One-time', 'Medical Assistance', 'Weekends', 'credit-card', 'yes', 'no', 'no', 'Assists with medical equipment');

INSERT INTO Shelter (ShelterName, Address, CityStateCountry, ContactNumber, Email, ShelterType)
VALUES
('Shanti Animal Shelter', '88 Shantinagar, Dhaka', 'Dhaka, Bangladesh', '01712345678', 'shanti@gmail.com', 'NGO'),
('Hope Animal Rescue', '56 New Market, Dhaka', 'Dhaka, Bangladesh', '01876543210', 'hope@outlook.com', 'Private'),
('Pet Care Foundation', '34 Banani, Dhaka', 'Dhaka, Bangladesh', '01799887766', 'petcare@yahoo.com', 'NGO'),
('Rescue and Care Center', '120 Uttara, Dhaka', 'Dhaka, Bangladesh', '01922334455', 'rescue@google.com', 'Government'),
('Animal Welfare Hub', '80 Gulshan, Dhaka', 'Dhaka, Bangladesh', '01833445566', 'welfare@outlook.com', 'NGO'),
('Banani Animal Shelter', '110 Banani, Dhaka', 'Dhaka, Bangladesh', '01722334455', 'banani@yahoo.com', 'Private'),
('Adopt a Pet Foundation', '250 Mirpur, Dhaka', 'Dhaka, Bangladesh', '01922334455', 'adoptpet@google.com', 'NGO'),
('Uttara Animal Home', '75 Uttara, Dhaka', 'Dhaka, Bangladesh', '01766554433', 'uttara@outlook.com', 'Government');

INSERT INTO Campaigns (CampaignName, Description, StartDate, EndDate, GoalAmount, RaisedAmount, CreatedBy)
VALUES
('Save the Strays', 'A campaign to provide medical assistance to stray animals.', '2025-02-01', '2025-03-01', 5000.00, 1000.00, 110000), 
('Adopt a Pet', 'Helping abandoned pets find new homes.', '2025-03-15', '2025-04-15', 8000.00, 3000.00, 110001),  
('Food Drive for Animals', 'Raising funds to provide food for stray animals.', '2025-04-01', '2025-04-30', 4000.00, 2000.00, 110002), 
('Medical Support for Shelter Animals', 'Funding medical treatments for shelter animals.', '2025-05-01', '2025-06-01', 6000.00, 1500.00, 110003),  
('Wildlife Protection Fund', 'Raising funds for the protection of endangered species.', '2025-06-01', '2025-07-01', 10000.00, 3500.00, 110004), 
('Emergency Rescue Operations', 'Funding for emergency rescue missions for animals.', '2025-07-01', '2025-08-01', 7000.00, 5000.00, 110005), 
('Animal Shelter Expansion', 'Building new facilities for animal sheltering.', '2025-08-01', '2025-09-01', 12000.00, 8000.00, 110006),  
('Spay and Neuter Campaign', 'Promoting spaying and neutering to control animal population.', '2025-09-01', '2025-10-01', 2000.00, 1200.00, 110007); 

INSERT INTO Donations (CampaignID, BenefactorID, DonationAmount, DonationDate)
VALUES
(1, 130000, 200.00, '2025-02-05 10:00:00'), 
(1, 130001, 300.00, '2025-02-07 11:30:00'), 
(2, 130002, 150.00, '2025-03-18 09:00:00'), 
(3, 130003, 500.00, '2025-04-10 14:45:00'),  
(4, 130004, 250.00, '2025-05-05 16:00:00'),  
(5, 130005, 1000.00, '2025-06-10 17:30:00'), 
(6, 130006, 750.00, '2025-07-15 13:00:00'), 
(7, 130007, 600.00, '2025-08-12 15:30:00');  

INSERT INTO Animal (Name, Species, Breed, Age, Gender, AnimalCondition, RescueDate, AdoptionStatus, ShelterID)
VALUES
('Rex', 'Dog', 'Labrador', 3, 'Male', 'Healthy', '2025-01-10', 'Available', 1),
('Mittens', 'Cat', 'Persian', 2, 'Female', 'Injured', '2025-01-12', 'UnderCare', 2),
('Bella', 'Dog', 'Golden Retriever', 4, 'Female', 'Healthy', '2025-01-15', 'Adopted', 3),
('Shadow', 'Cat', 'Bengal', 1, 'Male', 'Healthy', '2025-01-20', 'Available', 4),
('Tommy', 'Dog', 'Poodle', 5, 'Male', 'Injured', '2025-01-22', 'Pending', 5),
('Simba', 'Cat', 'Maine Coon', 3, 'Female', 'Healthy', '2025-01-25', 'Available', 6),
('Charlie', 'Dog', 'Beagle', 2, 'Male', 'Healthy', '2025-01-30', 'Adopted', 7),
('Luna', 'Cat', 'Siamese', 1, 'Female', 'Healthy', '2025-02-01', 'UnderCare', 8);

INSERT INTO RescueMissions (MissionName, Description, ReportedBy, AssignedTo, Location, Status, PriorityLevel)
VALUES
('Dhaka Street Rescue', 'Rescuing a stray dog found on the streets of Dhaka.', 100000, 110000, 'Dhaka, Bangladesh', 'In Progress', 'High'),
('Gulshan Area Rescue', 'Rescuing a cat in distress in the Gulshan area.', 100001, 110003, 'Dhaka, Bangladesh', 'Pending', 'Medium'),
('Banani Rescue Mission', 'Rescuing abandoned puppies in Banani.', 100002, 110002, 'Dhaka, Bangladesh', 'Completed', 'Low'),
('Uttara Animal Rescue', 'Assisting with an injured animal in Uttara.', 100003, 110006, 'Dhaka, Bangladesh', 'In Progress', 'High'),
('Old Dhaka Stray Rescue', 'Helping a stray animal in Old Dhaka.', 100004, 110005, 'Dhaka, Bangladesh', 'Resolved', 'Medium'),
('Mirpur Rescue Operation', 'Rescue mission for a lost animal in Mirpur.', 100005, 110007, 'Dhaka, Bangladesh', 'In Progress', 'Low'),
('Baridhara Stray Rescue', 'Rescuing an injured animal in the Baridhara area.', 100007, 110001, 'Dhaka, Bangladesh', 'Completed', 'Medium');
