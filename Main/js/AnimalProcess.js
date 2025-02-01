document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".adopt-btn").forEach(button => {
        button.addEventListener("click", function () {
            let animalId = this.getAttribute("data-id");

            fetch("../control/AdoptionController.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `adopt_id=${animalId}`
            })
            .then(response => response.text())
            .then(data => {
                let statusMessage = document.getElementById("status-message");

                if (data.trim() === "success") {
                    this.style.backgroundColor = "green";
                    this.style.color = "white";
                    this.innerText = "Pending";
                    this.disabled = true;
                    
                    statusMessage.innerHTML = "<p>Adoption status updated to Pending!</p>";
                    statusMessage.style.color = "green";
                } else {
                    statusMessage.innerHTML = "<p>Failed to update adoption status. Please try again.</p>";
                    statusMessage.style.color = "red";
                }
            })
            .catch(error => {
                let statusMessage = document.getElementById("status-message");
                statusMessage.innerHTML = "<p>Error occurred while processing the request. Please try again.</p>";
                statusMessage.style.color = "red";
                console.error("Error:", error);
            });
        });
    });
});
