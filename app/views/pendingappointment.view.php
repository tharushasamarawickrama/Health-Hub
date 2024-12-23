<?php require APPROOT . '/views/Components/header.php' ?>
<?php require APPROOT . '/views/Components/Navbar.php' ?>

<div class="pt-pending-maindiv">
    <div class="pt-pending-div1">
        <p class="pt-pending-div1-h1 pt-thick-underline">Pending Appointments</p>
    </div>
    <div class="pt-pending-div1">
        <p class="pt-pending-div1-h1">Past Appointments</p>
    </div>
</div>

<div>
    <!-- Pending Appointments -->
    <div class="pt-pending-div2-main">
        <div class="pt-pending-div2">
            <span>Dr.Abewardhne</span>
            <span>Cardiologist</span>
            <span>12/12/2021</span>
            <button class="pt-pending-viewbutton">View</button>
            <button>Cancel</button>
            <div class="pt-pending-div2-upload">
                <button>Upload Document</button>
            </div>
        </div>
    </div>
</div>

<div>
    <!-- Past Appointments -->
    <div class="pt-pending-div3-main"> 
        <div class="pt-pending-div2">
            <span>Dr.Abewardhne</span>
            <span>Cardiologist</span>
            <span>12/12/2021</span>
            <button>View</button>
            <div class="pt-pending-div2-upload">
                <button>Upload Document</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const sections = document.querySelectorAll(".pt-pending-div1");
        const pendingDiv = document.querySelector(".pt-pending-div2-main");
        const pastDiv = document.querySelector(".pt-pending-div3-main");

        // Default visibility
        pendingDiv.style.display = "flex";
        pastDiv.style.display = "none";

        sections.forEach((section) => {
            section.addEventListener("click", function () {
                // Remove thick underline from all sections
                sections.forEach((sec) => {
                    sec.querySelector(".pt-pending-div1-h1").classList.remove("pt-thick-underline");
                });

                // Add thick underline to the clicked section
                this.querySelector(".pt-pending-div1-h1").classList.add("pt-thick-underline");

                // Show or hide content based on clicked section
                if (this.querySelector(".pt-pending-div1-h1").textContent.trim() === "Pending Appointments") {
                    pendingDiv.style.display = "flex";
                    pastDiv.style.display = "none";
                } else if (this.querySelector(".pt-pending-div1-h1").textContent.trim() === "Past Appointments") {
                    pendingDiv.style.display = "none";
                    pastDiv.style.display = "flex";
                }
            });
        });
    });
</script>
