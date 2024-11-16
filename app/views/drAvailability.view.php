<?php
require APPROOT . '/views/Components/header.php';
require APPROOT . '/views/Components/drNavbar.php';

// Sample availability data to simulate fetched entries from a database
$availabilityData = [
    ["date" => "2024-10-14", "startTime" => "08:00", "endTime" => "10:00"],
    ["date" => "2024-10-24", "startTime" => "09:00", "endTime" => "11:00"],
    ["date" => "2024-11-05", "startTime" => "10:00", "endTime" => "12:00"]
];
?>

    <div class="dr-availability-container">
        <a href="./dr-dashboard.php" class="back-arrow"><img src="<?php echo URLROOT; ?>/assets/images/arrow-back.png" alt="Back"></a>
        <div class="availability-container">
            <!-- Date and Time Selection Section -->
            <div class="date-time-picker">
                <h2>Select Unavailable Dates/Times</h2>
                <label>All Day</label>
                <label class="switch">
                    <input type="checkbox" id="allDayToggle" onchange="toggleAllDay()">
                    <span class="slider round"></span>
                </label>
                
                <div class="calendar">
                    <h3>Starts</h3>
                    <input type="date" id="startDate" onchange="autoSetAllDay()">
                    <input type="time" id="startTime" value="08:00">
                </div>
                
                <div class="calendar">
                    <h3>Ends</h3>
                    <input type="date" id="endDate" onchange="autoSetAllDay()">
                    <input type="time" id="endTime" value="10:00">
                </div>

                <button onclick="clearInputs()">Clear</button>
                <button onclick="addAvailability()">Add</button>
            </div>

            <!-- Selected Dates List Section -->
            <div class="dates-list">
                <h3>Selected Dates/Times</h3>
                <ul id="availabilityList"></ul>
                <button onclick="saveAvailability()">Save</button>
            </div>
        </div>
    </div>

    <script>
        const initialAvailabilityData = <?php echo json_encode($availabilityData); ?>;
        
        document.addEventListener("DOMContentLoaded", () => {
            initialAvailabilityData.forEach(item => addAvailabilityToList(item.date, item.startTime, item.endTime));
        });

        function toggleAllDay() {
            const allDay = document.getElementById("allDayToggle").checked;
            if (allDay) {
                autoSetAllDay();
            }
        }

        function autoSetAllDay() {
            const allDay = document.getElementById("allDayToggle").checked;
            const startDate = document.getElementById("startDate");
            const endDate = document.getElementById("endDate");
            if (allDay && startDate.value) {
                document.getElementById("startTime").value = "00:00";
                document.getElementById("endTime").value = "23:59";
                endDate.value = startDate.value;
            }
        }

        function addAvailability() {
            const startDate = document.getElementById("startDate").value;
            const startTime = document.getElementById("startTime").value;
            const endDate = document.getElementById("endDate").value;
            const endTime = document.getElementById("endTime").value;
            if (startDate && endDate) {
                addAvailabilityToList(startDate, startTime, endTime);
            }
        }

        function addAvailabilityToList(date, startTime, endTime) {
            const list = document.getElementById("availabilityList");
            const li = document.createElement("li");
            li.innerHTML = `${date} ${startTime} - ${endTime}
                <span onclick="removeAvailability(this)">
                    <img src="<?php echo URLROOT; ?>/assets/images/delete.png" alt="delete">    
                </span>`;
            list.appendChild(li);
        }

        function removeAvailability(element) {
            element.parentElement.remove();
        }

        function clearInputs() {
            document.getElementById("startDate").value = "";
            document.getElementById("endDate").value = "";
            document.getElementById("startTime").value = "08:00";
            document.getElementById("endTime").value = "10:00";
            document.getElementById("allDayToggle").checked = false;
        }

        function saveAvailability() {
            const listItems = Array.from(document.querySelectorAll("#availabilityList li")).map(item => {
                const [date, timeRange] = item.textContent.split(" ");
                const [startTime, endTime] = timeRange.split(" - ");
                return { date, startTime, endTime };
            });
            console.log("Saving:", listItems);
        }
    </script>

<?php require APPROOT . '/views/Components/footer.php' ?>