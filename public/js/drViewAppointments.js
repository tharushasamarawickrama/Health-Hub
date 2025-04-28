document.addEventListener("DOMContentLoaded", () => {
  const datePicker = document.getElementById("datePicker");
  const todayRadio = document.getElementById("today");
  const upcomingRadio = document.getElementById("upcoming");

  const handleDateChange = () => {
    if (datePicker.value) {
      todayRadio.checked = false;
      upcomingRadio.checked = false;
      todayRadio.disabled = true;
      upcomingRadio.disabled = true;
    } else {
      todayRadio.disabled = false;
      upcomingRadio.disabled = false;
    }
  };

  datePicker.addEventListener("change", handleDateChange);
  handleDateChange();

  // Tab switching logic for status tabs
  document.querySelectorAll(".status-tab-btn").forEach((btn) => {
    btn.addEventListener("click", () => {
      const selectedStatus = btn.dataset.status;
      const slotIndex =
        document
          .querySelector(".slot-tab-btn.active")
          ?.dataset.slot?.split("-")[1] || 0;
      const url = new URL(window.location.href);
      url.searchParams.set("slotindex", slotIndex);
      url.searchParams.set("slotpage", "1");
      url.searchParams.set("statusTab", selectedStatus);
      window.location.href = url.toString();
    });
  });

  // Mark appointment as completed
  document.querySelectorAll(".mark-status").forEach((link) => {
    link.onclick = (e) => {
      e.preventDefault();
      const id = link.dataset.id;
      const currentStatus = link.dataset.status;

      // Toggle status
      const newStatus = currentStatus === "new" ? "completed" : "new";

      fetch(
        "http://localhost/Health-Hub/public/drViewAppointments/markCompleted",
        {
          method: "POST",
          headers: { "Content-Type": "application/x-www-form-urlencoded" },
          body:
            "appointmentId=" +
            encodeURIComponent(id) +
            "&appointmentStatus=" +
            encodeURIComponent(newStatus),
        }
      )
        .then((r) => r.json())
        .then((data) => {
          if (data.status === "success") {
            link.closest(".view-appointment-card")?.remove();
            let toastMsg = "";
            if(newStatus === "completed") {
              localStorage.removeItem("ongoingAppointment");
              document.getElementById("ongoing-appointment").style.display = "none";
              toastMsg = "Appointment marked as completed!";
            }
            else{
              toastMsg = "Appointment marked as new!";
            }
            showToast(toastMsg);
          } else {
            alert("Error: " + (data.message || "Update failed"));
          }
        })
        .catch((err) => {
          alert("Request failed");
          console.error(err);
        });
    };
  });

  function showToast(message) {
    const toast = document.getElementById("toast");
    document.getElementById("toast-text").textContent = message;
    toast.classList.add("show");
    setTimeout(() => toast.classList.remove("show"), 3000);
  }

  // ONGOING APPOINTMENT BANNER LOGIC
  const ongoingBanner = document.getElementById("ongoing-appointment");
  const ongoingIdSpan = document.getElementById("ongoing-id");
  const ongoingNameSpan = document.getElementById("ongoing-name");

  function showOngoingAppointment(no, name) {
    ongoingBanner.style.display = "flex";
    ongoingIdSpan.textContent = `Ongoing Appointment: #${no}`;
    ongoingNameSpan.textContent = `${name}`;
  }

  const ongoingAppointment = localStorage.getItem("ongoingAppointment");
  if (ongoingAppointment) {
    const { no, name } = JSON.parse(ongoingAppointment);
    showOngoingAppointment(no, name);
  }

  document
    .querySelectorAll(".view-appointment-card .card-link")
    .forEach((link) => {
      link.addEventListener("click", function (e) {
        const card = this.closest(".view-appointment-card");
        const no = card.getAttribute("data-no");
        const name =
          card.querySelector(".appointment-name")?.textContent || "Unknown";
        localStorage.setItem(
          "ongoingAppointment",
          JSON.stringify({ no, name })
        );
      });
    });
});
