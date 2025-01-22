<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/Navbar.php' ?>

<div class="pt-history-maindiv">
    <div class="pt-history-div1">
        <p class="pt-history-div1-h1 pt-thick-underline">Prescription</p>
    </div>
    <div class="pt-history-div1">
        <p class="pt-history-div1-h1">Lab Reports</p>
    </div>
    <div class="pt-history-div1">
        <p class="pt-history-div1-h1">Others</p>
    </div>
</div>

<div id="prescriptionContent" class="content-section">
<div>
    
    <div class="pt-history-div2-main">
        <div class="pt-history-div2">
            <span class="pt-history-span">Prescription-1</span>
            <span class="pt-history-span">Appo:1</span>
            <button class="pt-history-button">View</button>
            <button class="pt-history-button">Download</button>
            
        </div>
    </div>
</div>
</div>
<div id="labReportsContent" class="content-section" style="display: none;">
<div>
    
    <div class="pt-history-div2-main">
        <div class="pt-history-div2">
            <span class="pt-history-span">Lab Report-1</span>
            <span class="pt-history-span">Appo:1</span>
            <button class="pt-history-button">View</button>
            <button class="pt-history-button">Download</button>
            
        </div>
    </div>
</div>
</div>
<div id="otherContent" class="content-section" style="display: none;">
    Other
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const sections = document.querySelectorAll(".pt-history-div1");
        const prescriptionContent = document.getElementById("prescriptionContent");
        const labReportsContent = document.getElementById("labReportsContent");
        const otherContent = document.getElementById("otherContent");

        // Add click event listener to each section
        sections.forEach((section) => {
            section.addEventListener("click", function () {
                // Remove the thick underline from all sections
                sections.forEach((sec) => {
                    sec.querySelector(".pt-history-div1-h1").classList.remove("pt-thick-underline");
                });

                // Add the thick underline to the clicked section
                this.querySelector(".pt-history-div1-h1").classList.add("pt-thick-underline");

                // Hide all content sections
                prescriptionContent.style.display = "none";
                labReportsContent.style.display = "none";
                otherContent.style.display = "none";

                // Show the corresponding content based on the clicked section
                if (this.querySelector(".pt-history-div1-h1").textContent.trim() === "Prescription") {
                    prescriptionContent.style.display = "block";
                } else if (this.querySelector(".pt-history-div1-h1").textContent.trim() === "Lab Reports") {
                    labReportsContent.style.display = "block";
                } else if (this.querySelector(".pt-history-div1-h1").textContent.trim() === "Others") {
                    otherContent.style.display = "block";
                }
            });
        });
    });
</script>
