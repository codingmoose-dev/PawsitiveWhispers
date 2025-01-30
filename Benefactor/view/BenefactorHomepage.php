<?php
include '../control/HomepageDisplayRequests.php'; 
$homepageController = new HomepageDisplayRequests();
$campaigns = $homepageController->displayOngoingCampaigns();
$animals = $homepageController->showAnimalsUnderCare();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PawsitiveWellbeing - Benefactor</title>
    <link rel="stylesheet" href="../css/Style.css">
    <script src="../js/ShowDetailHomepage.js"></script>

</head>
<body>
    <!-- Header -->
    <header>
    <div>
    <img src="../../Main/images/Icon.png" alt="PawsitiveWellbeing Logo" style="height: 60px;">
        <h1>PawsitiveWellbeing</h1>
    </div>
        <nav>
            <a href="#home">Home</a>
            <a href="#donate">Donate</a>
            <a href="#adoption">Adopt an Animal</a>
            <a href="#impact">Impact & Updates</a>
            <a href="#transparency">Transparency</a>
            <a href="#faq">Frequently Asked Questions</a>
        </nav>
    </header>

    <!-- Home Section -->
    <section id="home">
        <h2>Welcome, Generous Benefactors!</h2>
        <p>Empowering change through compassion. Be a part of our mission to rescue, rehabilitate, and support animals in need.</p>
        <p>Whether you're an individual donor, a corporate sponsor, or an NGO partner, your contributions make a lasting difference!</p>
    </section>
    
    <!-- Donate Section -->
    <section id="donate">
        <h2>Donate to Make a Difference</h2>
        <p>Support our mission by donating to specific animal cases, campaigns, or general funds. Your contributions directly help animals in need.</p>
        <button id="show-more-donate" class="btn">Donate Now</button>

        <!-- Hidden Content -->
        <div id="donate-more-content" style="display: none;">
            <!-- Campaigns Section -->
            <h3>Ongoing Campaigns</h3>
            <p>Choose a campaign to support and make a positive impact on the lives of animals in need.</p>
            <div id="campaigns">
                <?php
                // Check if there are campaigns available
                if (!empty($campaigns)) {
                    // Start the table with proper HTML tags
                    echo "<table border='1' cellpadding='10' cellspacing='0'>";
                    echo "<tr>
                            <th>Campaign ID</th>
                            <th>Campaign Name</th>
                            <th>Description</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Goal Amount</th>
                            <th>Raised Amount</th>
                            <th>Created By</th>
                        </tr>";

                    // Loop through campaigns and display them row by row
                    foreach ($campaigns as $campaign) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($campaign['CampaignID']) . "</td>";
                        echo "<td>" . htmlspecialchars($campaign['CampaignName']) . "</td>";
                        echo "<td>" . htmlspecialchars($campaign['Description']) . "</td>";
                        echo "<td>" . htmlspecialchars($campaign['StartDate']) . "</td>";
                        echo "<td>" . htmlspecialchars($campaign['EndDate']) . "</td>";
                        echo "<td>" . htmlspecialchars($campaign['GoalAmount']) . "</td>";
                        echo "<td>" . htmlspecialchars($campaign['RaisedAmount']) . "</td>";
                        echo "<td>" . htmlspecialchars($campaign['CreatedBy']) . "</td>";
                        echo "</tr>";
                    }

                    // Close the table tag
                    echo "</table>";
                } else {
                    // If no campaigns are available, show this message and dump the raw data
                    echo "<p>No campaigns available.</p>";
                }
                ?>
            </div>
            <label for="campaign-id">Campaign ID:</label>
            <input type="number" id="campaign-id" name="campaign-id">
            <label for="campaign-amount">Amount:</label>
            <input type="number" id="campaign-amount" name="campaign-amount">
            <button class="btn">Donate</button>
            <br>

            <!-- Animal Cases Section -->
            <h3>Support Specific Animals</h3>
            <p>Choose an animal in need and donate directly to their well-being.</p>
            <div id="animals">
                <div class="grid-container">
                    <?php foreach ($animals as $animal): ?>
                        <div class="animal-card">
                            <img src="../../Main/<?php echo $animal['PicturePath']; ?>.jpg" alt="<?php echo $animal['Name']; ?>" class="animal-image">
                            <h4><?php echo $animal['Name']; ?></h4>
                            <p>Species: <?php echo $animal['Species']; ?></p>
                            <p>Breed: <?php echo $animal['Breed']; ?></p>
                            <p>Age: <?php echo $animal['Age']; ?> years</p>
                            <p>Condition: <?php echo $animal['AnimalCondition']; ?></p>


                            <label for="donate-amount-<?php echo $animal['Name']; ?>">Amount:</label>
                            <input type="number" id="donate-amount-<?php echo $animal['Name']; ?>" name="donate-amount">
                            
                            <label for="donate-for-<?php echo $animal['Name']; ?>">Donate For:</label>
                            <select id="donate-for-<?php echo $animal['Name']; ?>" name="donate-for">
                                <option value="food">Animal Food</option>
                                <option value="medicine">Medicine</option>
                                <option value="all">All</option>
                                <option value="clothing">Clothing</option>
                                <option value="transport">Transport</option>
                            </select>
                            
                            <button class="btn">Donate</button>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- General Fund Donation -->
            <h3>General Fund Donations</h3>
            <p>Make a one-time or recurring donation to support all our efforts.</p>
            <div id="general-fund">
                <form id="general-donation-form">
                    <label for="donation-amount">Amount:</label>
                    <input type="number" id="donation-amount" name="donation-amount" >
                    <label for="donation-type">Donation Type:</label>
                    <select id="donation-type" name="donation-type">
                        <option value="One-time">One-time</option>
                        <option value="Monthly">Monthly</option>
                    </select>
                    <button type="submit" class="btn">Submit Donation</button>
                </form>
            </div>
        </div> 
    </section> 

    <!-- Adoption Section -->
    <section id="adoption">
        <h2>Adopt an Animal</h2>
        <p>Give a forever home to a rescued animal. Browse available animals and track your application status seamlessly.</p>
        <a href="../../Main/view/Adoption.php" class="btn">Explore Adoptions</a>
    </section>

    <!-- Impact Section -->
    <section id="impact">
        <h2>See the Impact of Your Donations</h2>
        <p>Stay connected with the causes you support. View updates, success stories, and the outcomes of your generous contributions.</p>
        <a href="DonationImpact.php" class="btn">View Updates</a>
    </section>

    <!-- Transparency Section -->
    <section id="transparency">
        <h2>Financial Transparency (Coming Soon!)</h2>
        <p>We value your trust. Access detailed reports on how your funds are utilized for rescues, treatments, and operations. Transparency is our priority!</p>
        <a href="Transparency.php" class="btn">View Reports</a>
    </section>

    <!-- FAQ Section -->
    <section id="faq">
        <h2>Frequently Asked Questions</h2>
        <div>
            <h3>What is the role of a Benefactor in PawsitiveWellbeing?</h3>
            <p>As a Benefactor, your main role is to contribute financially to the organization's cause. Your generous donations support animal rescues, rehabilitation, and various campaigns aimed at improving the well-being of animals in need.</p>

            <h3>How can I donate to PawsitiveWellbeing?</h3>
            <p>You can donate through our website by choosing to support specific animal cases, campaigns, or contribute to our general fund. Donations can be one-time or monthly.</p>

            <h3>What campaigns can I support as a Benefactor?</h3>
            <p>Our current campaigns include those for specific animal rescues and general rehabilitation efforts. You can view these ongoing campaigns on our homepage and donate directly to any cause you resonate with.</p>

            <h3>How is my donation utilized?</h3>
            <p>Your donations go towards various needs such as medical treatments, shelter, food, and adoption services for animals. You can access detailed financial reports through our Transparency section for full disclosure on fund allocation.</p>

            <h3>Can I choose which animal I want to support with my donation?</h3>
            <p>Yes, you can choose to donate to specific animals in need. The "Support Specific Animals" section on our homepage allows you to view and contribute directly to the well-being of individual animals.</p>

            <h3>Can I become a regular donor?</h3>
            <p>Yes, you can set up recurring monthly donations through the "General Fund Donations" section. This ensures ongoing support for animals in need.</p>

            <h3>What is the impact of my donation?</h3>
            <p>Donations directly contribute to improving the lives of rescued animals. You can view the outcomes of your contributions through our "Impact & Updates" section, where success stories and progress are regularly shared.</p>

            <h3>What are the benefits of donating to specific campaigns or animals?</h3>
            <p>By donating to specific campaigns or animals, you directly influence the success of a particular rescue mission. Your contribution helps in providing the necessary resources to treat and rehabilitate the animals in the campaign.</p>

            <h3>How do I know that my donations are making a difference?</h3>
            <p>We ensure full transparency through detailed reports and updates. Regular updates on the progress of campaigns, animal adoptions, and the overall impact of your donations are shared in the "Impact & Updates" section.</p>

            <h3>Is there a way to track how my donations are spent?</h3>
            <p>Yes, we provide financial transparency in the "Transparency" section, where you can view detailed reports on how the funds raised are being spent. We prioritize openness and accountability to our donors.</p>
        </div>
    </section>


    <!-- Footer -->
    <footer>
        <p>© 2024 PawsitiveWellbeing. All rights reserved.</p>
        <p>Follow us on: 
            <a href="#">Facebook</a> | 
            <a href="#">Twitter</a> | 
            <a href="#">Instagram</a>
        </p>
    </footer>
</body>
</html>
