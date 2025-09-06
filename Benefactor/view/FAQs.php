<?php
session_start();
$activePage = 'faq';
include '../includes/navbar.php';

// The complete list of your FAQs
$faqs = [
    [
        'question' => 'What is the role of a Benefactor in Pawsitive Whispers?',
        'answer'   => "As a Benefactor, your main role is to contribute financially to the organization's cause. Your generous donations support animal rescues, rehabilitation, and various campaigns aimed at improving the well-being of animals in need."
    ],
    [
        'question' => 'How can I donate to Pawsitive Whispers?',
        'answer'   => 'You can donate through our website by choosing to support specific animal cases, campaigns, or contribute to our general fund. Donations can be one-time or monthly.'
    ],
    [
        'question' => 'What campaigns can I support as a Benefactor?',
        'answer'   => 'Our current campaigns include those for specific animal rescues and general rehabilitation efforts. You can view these ongoing campaigns on our homepage and donate directly to any cause you resonate with.'
    ],
    [
        'question' => 'How is my donation utilized?',
        'answer'   => 'Your donations go towards various needs such as medical treatments, shelter, food, and adoption services for animals. You can access detailed financial reports through our Transparency section for full disclosure on fund allocation.'
    ],
    [
        'question' => 'Can I choose which animal I want to support with my donation?',
        'answer'   => 'Yes, you can choose to donate to specific animals in need. The "Sponsor an Animal in Need" section on our Donate page allows you to view and contribute directly to the well-being of individual animals.'
    ],
    [
        'question' => 'Can I become a regular donor?',
        'answer'   => 'Yes, you can set up recurring monthly donations through the "General Fund Donations" section. This ensures ongoing support for animals in need.'
    ],
    [
        'question' => 'What is the impact of my donation?',
        'answer'   => 'Donations directly contribute to improving the lives of rescued animals. You can view the outcomes of your contributions through our "Impact & Updates" section, where success stories and progress are regularly shared.'
    ],
    [
        'question' => 'What are the benefits of donating to specific campaigns or animals?',
        'answer'   => 'By donating to specific campaigns or animals, you directly influence the success of a particular rescue mission. Your contribution helps in providing the necessary resources to treat and rehabilitate the animals in the campaign.'
    ],
    [
        'question' => 'How do I know that my donations are making a difference?',
        'answer'   => 'We ensure full transparency through detailed reports and updates. Regular updates on the progress of campaigns, animal adoptions, and the overall impact of your donations are shared in the "Impact & Updates" section.'
    ],
    [
        'question' => 'Is there a way to track how my donations are spent?',
        'answer'   => 'Yes, we provide financial transparency in the "Transparency" section, where you can view detailed reports on how the funds raised are being spent. We prioritize openness and accountability to our donors.'
    ]
];
?>

<main>
<section id="faq" class="faq-section">
    <div class="container py-4">

        <div class="row align-items-start">
            
            <div class="col-lg-7">
                <h2 class="mb-5">Frequently Asked Questions</h2>

                <div class="accordion" id="faqAccordion">
                    <?php foreach ($faqs as $key => $faq): ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-<?= $key; ?>">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?= $key; ?>" aria-expanded="false" aria-controls="collapse-<?= $key; ?>">
                                    <?= htmlspecialchars($faq['question']); ?>
                                </button>
                            </h2>
                            <div id="collapse-<?= $key; ?>" class="accordion-collapse collapse" aria-labelledby="heading-<?= $key; ?>" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    <?= htmlspecialchars($faq['answer']); ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="col-lg-5 faq-logo-column pt-5">
                <img src="../../Main/images/PrimaryLogo.png" alt="PawsitiveWhispers Logo" class="faq-logo">
            </div>

        </div>

    </div>
</section>
</main>

<?php include '../includes/footer.php'; ?>