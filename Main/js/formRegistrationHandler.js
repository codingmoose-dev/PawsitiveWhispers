let currentStep = 1;
let selectedRole = "general";

// Show the specified step and hide others
function goToStep(step) {
  document.querySelectorAll(".step").forEach(s => s.classList.remove("active"));
  const target = document.getElementById("step" + step);
  if (target) target.classList.add("active");
  currentStep = step;
}

// Validate Step 1 inputs before moving on
function validateStep1() {
  const form = document.getElementById('registrationForm');
  const fullName = form.FullName.value.trim();
  const email = form.Email.value.trim();
  const password = form.Password.value;
  const confirmPassword = form.ConfirmPassword.value;

  if (!fullName) {
    alert('Please enter your full name.');
    return false;
  }
  if (!email) {
    alert('Please enter your email.');
    return false;
  }
  if (!/^\S+@\S+\.\S+$/.test(email)) {
    alert('Please enter a valid email address.');
    return false;
  }
  if (!password) {
    alert('Please enter a password.');
    return false;
  }
  if (password !== confirmPassword) {
    alert('Passwords do not match.');
    return false;
  }
  return true;
}

// Step 1 Next button
const step1NextBtn = document.getElementById('step1NextBtn');
step1NextBtn.addEventListener('click', () => {
  if (validateStep1()) {
    goToStep(2);
  }
});

const roleCards = document.querySelectorAll(".flip-card");
const roleNextBtn = document.getElementById("roleNextBtn");
const roleBackBtn = document.getElementById("roleBackBtn");

// Role card selection
roleCards.forEach(card => {
  card.addEventListener("click", () => {
    roleCards.forEach(c => {
      c.classList.remove("selected");
      c.setAttribute("aria-pressed", "false");
    });
    card.classList.add("selected");
    card.setAttribute("aria-pressed", "true");
    selectedRole = card.dataset.role;
    document.getElementById("selectedRoleInput").value = capitalizeFirstLetter(selectedRole);
    roleNextBtn.disabled = false;
  });
});

// On page load - enable continue if default role selected
window.addEventListener("DOMContentLoaded", () => {
  const defaultSelected = document.querySelector(".flip-card.selected");
  if (defaultSelected) {
    selectedRole = defaultSelected.dataset.role;
    if (selectedRole === "general") {
      roleNextBtn.disabled = false;
    }
  }
});

// Step 2 Continue button
roleNextBtn.addEventListener("click", () => {
  if (selectedRole === "general") {
    goToStep(4);
  } else {
    if (!document.getElementById("step3")) {
      const step4 = document.getElementById("step4");
      const step3 = document.createElement("section");
      step3.id = "step3";
      step3.className = "step";
      step3.innerHTML = `
        <h2 id="formTitle">Role Details</h2>
        <div id="roleFormContainer"></div>
        <button type="button" id="step3BackBtn">Back</button>
        <button type="button" id="step3NextBtn">Next</button>
      `;
      step4.parentNode.insertBefore(step3, step4);

      loadRoleForm(selectedRole);

      // Step 3 Back button — RESET role to general and remove step 3
      document.getElementById("step3BackBtn").addEventListener("click", () => {
        const step3 = document.getElementById("step3");
        if (step3) step3.remove();

        // Reset role to default
        selectedRole = "general";
        document.getElementById("selectedRoleInput").value = "General";

        // Visually select general card
        roleCards.forEach(c => {
          c.classList.remove("selected");
          c.setAttribute("aria-pressed", "false");
        });
        const generalCard = document.querySelector('.flip-card[data-role="general"]');
        generalCard.classList.add("selected");
        generalCard.setAttribute("aria-pressed", "true");

        roleNextBtn.disabled = false;
        goToStep(2);
      });

      document.getElementById("step3NextBtn").addEventListener("click", () => goToStep(4));
    } else {
      loadRoleForm(selectedRole);
    }
    goToStep(3);
  }
});

// Step 2 Back button
roleBackBtn.addEventListener("click", () => {
  goToStep(1);
});

// Step 4 Back button
document.getElementById("preferencesBackBtn").addEventListener("click", () => {
  if (selectedRole === "general") {
    goToStep(2);
  } else {
    goToStep(3);
  }
});

// Load role-specific form HTML dynamically
function loadRoleForm(role) {
  const allowedRoles = ["volunteer", "veterinarian", "benefactor"];
  if (!allowedRoles.includes(role)) {
    document.getElementById("roleFormContainer").innerHTML = `<p style="color:red;">Invalid role selected.</p>`;
    return;
  }
  const titles = {
    volunteer: "Volunteer Details",
    veterinarian: "Veterinarian Details",
    benefactor: "Benefactor Details"
  };
  document.getElementById("formTitle").textContent = titles[role] || "Role Details";

  fetch(`RegistrationForms/${role}Form.html`)
    .then(res => {
      if (!res.ok) throw new Error('Network response was not ok');
      return res.text();
    })
    .then(html => {
      document.getElementById("roleFormContainer").innerHTML = html;
    })
    .catch(() => {
      document.getElementById("roleFormContainer").innerHTML = `<p style="color:red;">Error loading form for ${role}</p>`;
    });
}

function capitalizeFirstLetter(role) {
  return role.charAt(0).toUpperCase() + role.slice(1);
}
